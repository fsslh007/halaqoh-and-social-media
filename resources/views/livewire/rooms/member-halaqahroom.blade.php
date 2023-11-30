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
