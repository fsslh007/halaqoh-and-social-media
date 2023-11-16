<x-jet-dialog-modal wire:model="isOpenCreatePostModal">
    <x-slot name="title">
        {{ __('Create Post') }}
    </x-slot>

    <x-slot name="content">
        <x-jet-validation-errors class="mb-4" />

        <form id="createPostForm" wire:submit.prevent="submit" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 mb-2 w-full" type="text" wire:model.lazy="title" />
            </div>

            <div>
                <x-jet-label for="location" value="{{ __('Location') }}" />
                <x-jet-input id="location" class="block mt-1 w-full" type="text" wire:model.lazy="location" />
            </div>

            <div class="mt-4">
                <x-jet-label for="body" value="{{ __('Description') }}" />
                <textarea rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow" wire:model.lazy="body"> </textarea>
            </div>

            @if($file)
            <div class="mt-4">
                <x-jet-label value="{{ __('Preview :') }}" />

                @if(in_array($file->extension(), $this->imageFormats))
                <img class="p-3 h-32" src="{{ $file->temporaryUrl() }}" oncontextmenu="return false;">
                @elseif(in_array($file->extension(), $this->videoFormats))
                <video controls crossorigin playsinline oncontextmenu="return false;" controlsList="nodownload" class="rounded-lg filter">
                    <!-- Video files -->
                    <source src="{{ $file->temporaryUrl() }}" type="video/{{ $file->extension() }}" size="576">

                    <!-- Fallback for browsers that don't support the <video> element -->
                    <a href="{{ $file->temporaryUrl() }}" download>Download</a>
                </video>
                @else

                <p class="text-red-700 text-sm my-3">Invalid File selected. You can only upload {{ implode(', ',  array_merge($this->imageFormats, $this->videoFormats)) }} file types. </p>

                @endif
            </div>
            @endif

            <div x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <div class="mt-4">
                    <x-jet-label for="body" value="{{ __('Media') }}" />
                    <input type="file" wire:model="file">
                </div>

                <div wire:loading class="my-3" wire:target="file">Uploading...</div>

                <!-- Progress Bar -->
                <div x-show="isUploading" class="my-2">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <div class="flex items-center justify-end mt-4">
            <x-jet-secondary-button wire:click="$set('isOpenCreatePostModal', false)">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button type="submit" form="createPostForm" class="ml-4">
                {{ __('Create Post') }}
            </x-jet-button>
        </div>
    </x-slot>
</x-jet-dialog-modal>
