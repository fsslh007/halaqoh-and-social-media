<div>
    @section('styles')
    <link rel='stylesheet' href='https://cdn.plyr.io/3.4.6/plyr.css'>
    <style>
        .plyr {
            border-radius: 0.5rem;
            margin-bottom: 15px;
        }
    </style>
    @endsection

    @if(session()->has('success'))
    <div class="bg-green-100 border my-3 border-green-400 text-green-700 dark:bg-green-700 dark:border-green-600 dark:text-green-100 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline text-center">{{ session()->get('success') }}</span>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="bg-red-100 border my-3 border-red-400 text-red-700 dark:bg-red-700 dark:border-red-600 dark:text-red-100 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline text-center">{{ session()->get('error') }}</span>
    </div>
    @endif

    <div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-12 lg:w-2/5 lg:mx-auto">
        <div class="bg-white shadow-md rounded-3xl p-4 justify-center">
            <div class="flex-none">
                <div class="flex items-center justify-between" wire:offline.class.remove="text-blue-700" wire:offline.class="text-gray-400">
                    <div class="flex items-center text-xs text-blue-700 font-medium">
                        <a href="{{ route('profile', ['username' => $user->username]) }}">
                            <img class="inline-block object-cover w-8 h-8 mr-4 text-white rounded-full shadow-sm cursor-pointer" wire:offline.class="filter grayscale" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                        </a>
                    </div>

                    <div class="flex-grow ml-4 w-full">
                        <button id="create_post" wire:click="showCreatePostModal" class="w-full bg-gray-200 font-bold py-2 px-4 rounded-full">
                            {{ __('Create Post ...') }}
                        </button>
                    </div>

                    @include('livewire.posts.create-post-modal')
                </div>
            </div>
        </div>
    </div>









    @forelse($posts as $post)
    @include('elements.post')
    @empty
    <div class="flex flex-col mx-2 my-12 md:mx-32 lg:my-28 lg:mx-60">
        <div class="bg-white shadow-md rounded-3xl p-4">
            <div class="flex-none">
                <div class=" h-full w-full mb-3">
                    <img src="{{ asset('images/no-posts.png') }}" alt="Just a flower" class="w-full object-scale-down md:object-cover lg:object-cover  rounded-2xl">
                </div>
                <div class="flex-auto ml-3 justify-evenly py-2">
                    <div class="flex flex-wrap ">
                        <h2 class="flex-auto text-lg text-center font-medium">{{ __('No Posts found..!!!') }}</h2>
                    </div>
                    <p class="mt-3"></p>
                </div>
            </div>
        </div>
    </div>
    @endforelse



    @include('elements.comments-post-modal')
    @include('elements.delete-post-modal')

    @section('scripts')



    <script src='https://cdn.plyr.io/3.4.6/plyr.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
  // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
  const player = Plyr.setup('video', { captions: {active: true}, tooltips: {controls: true, seek: true} });

  // Expose
  window.player = player;

  for (var i in player) {
     player[i].on('play', function (instance) {
       var source = instance.detail.plyr.source;
       for (var x in player) {
         if (player[x].source != source) {
          player[x].pause();
         }
       }
     });
    }

  // Bind event listener
  function on(selector, type, callback) {
    document.querySelector(selector).addEventListener(type, callback, false);
  }

  // Play
  on('.js-play', 'click', () => {
    player.play();
  });

  // Pause
  on('.js-pause', 'click', () => {
    player.pause();
  });

  // Stop
  on('.js-stop', 'click', () => {
    player.stop();
  });

  // Rewind
  on('.js-rewind', 'click', () => {
    player.rewind();
  });

  // Forward
  on('.js-forward', 'click', () => {
    player.forward();
  });
});
    </script>
    @endsection
</div>
