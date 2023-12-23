<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a class="flex items-center space-x-2">
                <button class="px-1 py-2 bg-orange-200 rounded-sm text-sm text-gray-600 hover:text-gray-900 focus:outline-none flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                    </svg>
                </button>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __($classroomName) }}
                </h2>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </a>
            <div class="flex items-center">
                @can('update', $room)
                <span class="flex items-center">
                    <!-- Create Meet -->
                    <a href="{{ route('rooms.createMeet', ['room' => $id, 'classroomName' => $classroomName]) }}" 
                        :active="request()->routeIs('rooms.createMeet', ['room' => $id, 'classroomName' => $classroomName])'"
                        class="px-2 py-2 bg-green-400 rounded-lg text-sm text-gray-600 hover:text-gray-900 focus:outline-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                        </svg>
                        <span>{{__('Meet')}}</span>   
                    </a>
                    
                    <!-- Add some space -->
                    <div class="w-2"></div>

                    <!-- member --> 
                    <a href="{{ route('rooms.member', ['room' => $id, 'classroomName' => $classroomName]) }}" 
                        :active="request()->routeIs('rooms.member', ['room' => $id, 'classroomName' => $classroomName])'"
                        class="px-2 py-2 bg-yellow-400 rounded-lg text-sm text-gray-600 hover:text-gray-900 focus:outline-none flex items-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M11 5a3 3 0 11-6 0 3 3 0 016 0zM2.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 018 18a9.953 9.953 0 01-5.385-1.572zM16.25 5.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
                        </svg>
                        <span>{{__('Member')}}</span>
                    </a>

                    <!-- Add some space -->
                    <div class="w-6"></div>

                    <!-- setting -->
                    <a href="{{ route('rooms.edit', ['room' => $id]) }}" 
                        :active="request()->routeIs('rooms.edit', ['room' => $id])'" 
                        class="px-2 py-2 bg-gray-400 rounded-lg text-sm text-gray-600 hover:text-gray-900 focus:outline-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </span>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="bg-gray-100">
        <style>
            /* Move these styles to your CSS file for better organization */
            input, textarea, button, select, a { -webkit-tap-highlight-color: rgba(0,0,0,0); }
            button:focus{ outline:0 !important; } 
        </style>

        <livewire:rooms.halaqahroom :roomId="$id" :classroomName="$classroomName" />
    </div>
</x-app-layout>
