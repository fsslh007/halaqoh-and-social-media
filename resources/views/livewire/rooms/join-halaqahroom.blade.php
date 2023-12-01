<div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-12 lg:w-2/5 lg:mx-auto">
    <div class="bg-white shadow-md rounded-3xl p-4">
        <div class="flex-none">
            <div class="text-center mb-4">
                <h1 class="text-lg font-bold">You've been invited to join Halaqah "{{ $classroomName }}"</h1>
            </div>
            <div class="border border-gray-300 rounded-md p-4 flex flex-col items-center">
                <div class="flex justify-center space-x-4"> <!-- Adjusted flex container -->
                    <button wire:click="acceptInvitation" class="bg-green-500 text-gray-100 rounded-md focus:outline-none focus:ring focus:border-green-300 transition duration-300 hover:bg-green-600 hover:text-white px-4 py-2">Accept</button>
                    <button onclick="cancelInvitation()" class="bg-red-500 text-gray-100 py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300 transition-all duration-300">Cancel</button>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-success text-center mt-4">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function cancelInvitation() {
        // Implement logic to cancel invitation using Ajax or Livewire
        alert('Invitation canceled');
    }
</script>
