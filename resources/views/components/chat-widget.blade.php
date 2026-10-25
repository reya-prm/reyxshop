<!-- Floating Chat Widget -->
<div id="chat-widget" class="fixed bottom-6 right-6 z-50">
    <!-- Toggle Button -->
    <button id="chat-toggle" class="flex items-center gap-2 px-4 py-3 bg-coral hover:bg-coral-hover text-white rounded-full shadow-lg transition-all hover:scale-105">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        <span class="text-sm font-bold">Chat Admin</span>
    </button>

    <!-- Chat Box (hidden by default) -->
    <div id="chat-box" class="hidden absolute bottom-20 right-0 w-80 h-96 bg-white rounded-lg shadow-2xl flex flex-col border border-border overflow-hidden">
        <!-- Header -->
        <div class="bg-coral text-white px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-white text-coral flex items-center justify-center font-bold text-sm">A</div>
                <div>
                    <div class="font-bold text-sm">Admin ReyxShop</div>
                    <div class="text-xs opacity-90">Online</div>
                </div>
            </div>
            <button id="chat-close" class="hover:bg-coral-hover p-1 rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Messages Container -->
        <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-ash">
            <div class="text-center text-xs text-slate">Memuat pesan...</div>
        </div>

        <!-- Input Area -->
        <div class="p-3 bg-white border-t border-border">
            <form id="chat-form" class="flex gap-2">
                <input 
                    type="text" 
                    id="chat-input" 
                    placeholder="Ketik pesan..." 
                    class="flex-1 px-3 py-2 text-sm rounded-lg border border-border focus:outline-none focus:ring-2 focus:ring-coral"
                    maxlength="1000"
                >
                <button type="submit" class="px-4 py-2 bg-coral hover:bg-coral-hover text-white rounded-lg font-bold text-sm transition">
                    Kirim
                </button>
            </form>
        </div>
    </div>
</div>

<script>
(function(){
    const chatToggle = document.getElementById('chat-toggle');
    const chatBox = document.getElementById('chat-box');
    const chatClose = document.getElementById('chat-close');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');
    
    let conversationId = null;
    let isOpen = false;
    let pollInterval = null;

    // Toggle chat box
    chatToggle.addEventListener('click', function(){
        isOpen = !isOpen;
        chatBox.classList.toggle('hidden', !isOpen);
        if(isOpen){
            loadMessages();
            startPolling();
        } else {
            stopPolling();
        }
    });

    chatClose.addEventListener('click', function(){
        isOpen = false;
        chatBox.classList.add('hidden');
        stopPolling();
    });

    // Load messages
    function loadMessages(){
        fetch('{{ route('chat.messages') }}')
            .then(res => res.json())
            .then(data => {
                conversationId = data.conversation_id;
                renderMessages(data.messages);
            })
            .catch(err => {
                chatMessages.innerHTML = '<div class="text-center text-xs text-red-500">Gagal memuat pesan.</div>';
            });
    }

    // Render messages
    function renderMessages(messages){
        if(messages.length === 0){
            chatMessages.innerHTML = '<div class="text-center text-xs text-slate">Belum ada pesan. Mulai chat dengan admin!</div>';
            return;
        }

        chatMessages.innerHTML = messages.map(msg => {
            const isUser = msg.sender === 'user' || msg.sender_type === 'customer';
            return `
                <div class="flex ${isUser ? 'justify-end' : 'justify-start'}">
                    <div class="max-w-[70%] ${isUser ? 'bg-coral text-white' : 'bg-white text-charcoal border border-border'} px-3 py-2 rounded-lg text-xs">
                        ${!isUser ? '<div class="font-bold text-[10px] text-coral mb-1">Admin</div>' : ''}
                        <div>${escapeHtml(msg.message)}</div>
                        <div class="text-[10px] mt-1 opacity-70">${msg.created_at}</div>
                    </div>
                </div>
            `;
        }).join('');
        
        scrollToBottom();
    }

    // Send message
    chatForm.addEventListener('submit', function(e){
        e.preventDefault();
        const message = chatInput.value.trim();
        if(!message) return;

        fetch('{{ route('chat.send') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message })
        })
        .then(res => res.json())
        .then(data => {
            chatInput.value = '';
            loadMessages();
        })
        .catch(err => {
            alert('Gagal mengirim pesan. Coba lagi.');
        });
    });

    // Polling for new messages
    function startPolling(){
        pollInterval = setInterval(loadMessages, 3000); // every 3s
    }

    function stopPolling(){
        if(pollInterval){
            clearInterval(pollInterval);
            pollInterval = null;
        }
    }

    function scrollToBottom(){
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function escapeHtml(text){
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
})();
</script>
