<?php

namespace App\Http\Livewire\Posts;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Media;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Stevebauman\Location\Facades\Location;

class View extends Component
{
    use WithPagination, WithFileUploads;

    public $file;
    public $comments = [];
    public $comment;
    public $type;
    public $queryType;
    public $postId;
    public $deletePostId;
    public $isOpenCommentModal = false;
    public $isOpenDeletePostModal = false;
    public $isOpenCreatePostModal = false;

    public $title;
    public $body;
    public $location;
    public $imageFormats = ['jpg', 'png', 'gif', 'jpeg'];
    public $videoFormats = ['mp4', '3gp'];

    public function mount($type = null)
    {
        $this->queryType = $type;
        $ipAddress = $this->getIp();
        $position = Location::get($ipAddress);

        if ($position) {
            $this->location = $position->cityName . '/' . $position->regionCode;
        } else {
            $this->location = null;
        }
    }

    public function showCreatePostModal()
    {
        $this->isOpenCreatePostModal = true;
        //dd('Modal opened'); // Add this for debug
    }


    public function updatedFile()
    {
        $this->validate([
            'file' => 'mimes:' . implode(',', array_merge($this->imageFormats, $this->videoFormats)) . '|max:2000000',
        ]);
    }

    public function submit()
    {
        $data = $this->validate([
            'title' => 'required|max:50',
            'location' => 'nullable|string|max:60',
            'body' => 'required|max:1000',
            'file' => 'nullable|mimes:' . implode(',', array_merge($this->imageFormats, $this->videoFormats)) . '|max:2000000',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'location' => $data['location'],
            'body' => $data['body'],
        ]);

        if (!empty($this->file)) {
            $path = $this->file->store('post-photos', 'public');
            $isImage = preg_match('/^.*\.(png|jpg|gif)$/i', $path);
            Media::create([
                'post_id' => $post->id,
                'path' => $path,
                'is_image' => $isImage,
            ]);
        }

        session()->flash('success', 'Post created successfully');
        return redirect('home');
    }

    public function incrementLike(Post $post)
    {
        $like = Like::where('user_id', Auth::id())
            ->where('post_id', $post->id);

        if (! $like->count()) {
            $new = Like::create([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
            ]);

            return true;
        }
        $like->delete();
    }

    public function comments($post)
    {
        $post = Post::with(['comments.user' => function ($query) {
            $query->select('id', 'name');
        },
        ])->find($post);
        $this->postId = $post->id;
        $this->resetValidation('comment');
        $this->isOpenCommentModal = true;
        $this->setComments($post);
        return true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function createComment(Post $post)
    {
        $validatedData = Validator::make(
            ['comment' => $this->comment],
            ['comment' => 'required|max:5000']
        )->validate();

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'comment' => $validatedData['comment'],
        ]);

        session()->flash('comment.success', 'Comment created successfully');

        $this->setComments($post);
        $this->comment = '';

        //$this->isOpenCommentModal = false;
        return redirect()->back();
    }

    public function setComments($post)
    {
        $this->comments = $post->comments;
        return true;
    }

    public function showDeletePostModal(Post $post)
    {
        $this->deletePostId = $post->id;
        $this->isOpenDeletePostModal = true;
    }

    public function deletePost(Post $post)
    {
        $response = Gate::inspect('delete', $post);

        if ($response->allowed()) {
            try {
                $post->delete();
                session()->flash('success', 'Post deleted successfully');
            } catch (Exception $e) {
                session()->flash('error', 'Cannot delete post');
            }
        } else {
            session()->flash('error', $response->message());
        }
        $this->isOpenDeletePostModal = false;
        return redirect()->back();
    }

    public function deleteComment(Post $post, Comment $comment)
    {
        $response = Gate::inspect('delete', [$comment, $post]);

        if ($response->allowed()) {
            $comment->delete();
            $this->isOpenCommentModal = false;
            session()->flash('success', 'Comment deleted successfully');
        } else {
            session()->flash('comment.error', $response->message());
        }

        return redirect()->back();
    }

    private function storeFiles($post)
    {
        if (empty($this->file)) {
            return true;
        }

        $path = $this->file->store('post-photos', 'public');

        $isImage = preg_match('/^.*\.(png|jpg|gif)$/i', $path);

        Media::create([
            'post_id' => $post->id,
            'path' => $path,
            'is_image' => $isImage,
        ]);
    }

    private function getIp(): ?string
    {
        foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    public function render()
    {
        $posts = $this->setQuery();
        $user = Auth::user(); // Retrieve authenticated user
    
        return view('livewire.posts.view', [
            'posts' => $posts,
            'user' => $user, // Pass the user data to the view
        ]);
    }

    private function setQuery()
    {
        if (! empty($this->queryType) && $this->queryType === 'me') {
            $posts = Post::withCount(['likes', 'comments'])->where('user_id', Auth::id())->with(['userLikes', 'postImages', 'user' => function ($query) {
                $query->select(['id', 'name', 'username', 'profile_photo_path']);
            },
            ])->latest()->paginate(10);
        } elseif (! empty($this->queryType) && $this->queryType === 'followers') {
            $userIds = Auth::user()->followings()->pluck('follower_id');
            $userIds[] = Auth::id();
            $posts = Post::withCount(['likes', 'comments'])->whereIn('user_id', $userIds)->with(['userLikes', 'postImages', 'user' => function ($query) {
                $query->select(['id', 'name', 'username', 'profile_photo_path']);
            },
            ])->latest()->paginate(10);
        } else if (! empty($this->queryType) && $this->queryType === 'profile') {
            // Fetch posts for the specific user based on the username
            $username = request()->route()->parameter('username');
    
            $user = User::where('username', $username)->firstOrFail();
    
            $posts = Post::withCount(['likes', 'comments'])
                ->where('user_id', $user->id)
                ->with(['userLikes', 'postImages', 'user' => function ($query) {
                    $query->select(['id', 'name', 'username', 'profile_photo_path']);
                },
                ])->latest()->paginate(10);   
        } else {
            $posts = Post::withCount(['likes', 'comments'])->with(['userLikes', 'postImages', 'user' => function ($query) {
                $query->select(['id', 'name', 'username', 'profile_photo_path']);
            },
            ])->latest()->paginate(10);
        }

        return $posts;
    }
}
