<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatting System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center">

    <!-- Chat Container -->
    <div class="fixed bottom-6 right-6">
        <!-- Chat Head -->
        <button id="chatHead" class="w-14 h-14 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-blue-600 transition">
            💬
        </button>

        <!-- Chat Box (Hidden by Default) -->
        <div id="chatBox" class="hidden w-80 h-96 bg-white shadow-lg rounded-lg flex flex-col">
            <!-- Chat Header (Click to Minimize) -->
            <div id="chatHeader" class="bg-blue-500 text-white p-3 flex justify-between items-center rounded-t-lg cursor-pointer">
                <span>Chat</span>
            </div>
            <!-- Chat Messages -->
            <div class="flex-1 p-3 overflow-y-auto">
                <p class="text-gray-700 text-sm">No messages yet...</p>
            </div>
            <!-- Chat Input -->
            <div class="p-3 border-t">
                <input type="text" placeholder="Type a message..." class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>

    <script>
        const chatHead = document.getElementById('chatHead');
        const chatBox = document.getElementById('chatBox');
        const chatHeader = document.getElementById('chatHeader');

        chatHead.addEventListener('click', () => {
            chatBox.classList.remove('hidden'); // Show chat box
            chatHead.classList.add('hidden'); // Hide chat head
        });

        chatHeader.addEventListener('click', () => {
            chatBox.classList.add('hidden'); // Hide chat box
            chatHead.classList.remove('hidden'); // Show chat head again
        });
    </script>

</body>
</html>
