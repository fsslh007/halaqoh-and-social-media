<div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-12 lg:w-2/5 lg:mx-auto">
    <div class="bg-white shadow-md rounded-3xl p-4">
        <div class="flex-none">
            <div class="text-center mb-4">
                <h1 class="text-lg font-bold">Invite Link</h1>
            </div>
            <div class="border border-gray-300 rounded-md p-4 flex flex-col items-center">
                <p id="inviteLink" class="text-blue-500 break-all">{{ $inviteLink }}</p>
                <button onclick="copyInviteLink()" class="mt-4" style="background-color: green; color: white; padding: 8px 12px; border-radius: 4px;">Copy Invite Link</button>
            </div>
        </div>
    </div>

    <!-- Add free space at the bottom -->
    <div class="mb-6"></div>

    <!-- Section for showing the list member of Halaqah -->
    <div class="bg-white shadow-md rounded-3xl p-4">
        <div class="flex-none">
            <div class="text-center mb-4">
                <h1 class="text-lg font-bold">Member of Halaqah - {{ $classroomName }}</h1>
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-red-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-red-500 uppercase tracking-wider">Username</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-red-500 uppercase tracking-wider">Property</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $index => $member)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{ $member->user->username }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{ $member->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<script>
    function copyInviteLink() {
        var copyText = document.createElement('textarea');
        copyText.value = '{{ $inviteLink }}';
        document.body.appendChild(copyText);
        copyText.select();
        document.execCommand('copy');
        document.body.removeChild(copyText);
        alert('Invite link copied to clipboard!');
    }
</script>
