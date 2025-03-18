<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex justify-center items-center h-screen">

    <div class="fixed bottom-4 right-4">
        <!-- Chat Head (Visible by Default) -->
        <button id="chatHead" class="bg-blue-500 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg"
            onclick="document.getElementById('chatHead').classList.add('hidden'); document.getElementById('chatBox').classList.remove('hidden');">
            💬
        </button>

        <!-- Chat Box -->
        <div id="chatBox" class="hidden w-96 bg-white text-black rounded-lg shadow-lg">
            <!-- Clickable Header to Minimize -->
            <div class="bg-blue-500 text-white p-3 font-bold cursor-pointer"
                onclick="document.getElementById('chatHead').classList.remove('hidden'); document.getElementById('chatBox').classList.add('hidden');">
                Chat
            </div>

            <div class="p-3">
                <p class="text-gray-500">Select a person to chat with:</p>
                <ul class="mt-2 space-y-2">
                    @foreach ($users as $user)
                        <li class="p-2 bg-gray-100 hover:bg-gray-200 rounded">
                            <button type="button" class="w-full text-left"
                                onclick="selectUser({{ $user->id }}, '{{ $user->fname }}', '{{ $user->lname }}')">
                                {{ $user->fname }} {{ $user->lname }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Chat Box (Initially Hidden) -->
            <div id="chatContainer" class="hidden p-3">
                <a href="#" class="text-blue-500" onclick="closeChat()">← Back</a>
                <h3 id="chatUserName" class="font-bold text-lg mt-2"></h3>

                <div class="h-60 overflow-y-auto border p-2 bg-gray-50 rounded mt-2">
                    <p id="noMessages" class="text-gray-500">No messages yet...</p>
                </div>

                <form action="{{ route('send-message') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="receiver_id" id="chatReceiverId">
                    <input type="text" name="message" placeholder="Type a message..." required
                        class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 mt-2 rounded">Send</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function selectUser(id, fname, lname) {
            document.getElementById('chatContainer').classList.remove('hidden');
            document.getElementById('chatUserName').innerText = fname + ' ' + lname;
            document.getElementById('chatReceiverId').value = id;
        }

        function closeChat() {
            document.getElementById('chatContainer').classList.add('hidden');
        }
    </script>


</body>
</html>
