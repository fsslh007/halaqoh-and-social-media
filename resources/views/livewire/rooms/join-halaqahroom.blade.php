<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Page Title</title>

    <!-- Your additional CSS styles -->
    <style>
        /* Add your custom styles here */
        body {
            font-family: 'Nunito Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f3f4f6;
        }

        .container {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        /* Styles for the buttons */
        button {
            margin-top: 15px;
            padding: 15px 30px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: bold;
            transition: transform 0.3s ease-in-out;
        }

        /* Additional custom styles */
        button:hover {
            transform: scale(1.05) rotate(-10deg);
        }
    </style>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @livewireStyles

    <!-- Additional CSS files -->
    <!-- Include other CSS files as needed -->
</head>
<body>

<div class="container">
    <div class="text-center mb-4">
        <h1 class="text-lg font-bold">You've been invited to join Halaqah {{ $classroomName }}</h1>
    </div>
    <div class="border border-gray-300 rounded-md p-4 flex flex-col items-center">
        <button wire:click="acceptInvitation" class="bg-green-500 text-gray-100 rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:border-green-300">Accept</button>
        <!-- Your HTML content -->
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Rest of your content -->

        <button onclick="cancelInvitation()" class="mt-2 bg-red-500 text-gray-100 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300 button-right">Cancel</button>
    </div>
</div>

<!-- Your JavaScript -->
<script>
    function cancelInvitation() {
        // Implement logic to cancel invitation using Ajax or Livewire
        alert('Invitation canceled');
    }
</script>
@livewireScripts

</body>
</html>
