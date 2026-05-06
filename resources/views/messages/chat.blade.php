@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm overflow-hidden">
                <!-- Шапка чату -->
                <div class="card-header bg-white border-bottom p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{ auth()->user()->hasRole('admin') ? route('admin.messages') : route('user.messages') }}" class="btn btn-sm btn-light me-3">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-2" style="width: 40px; height: 40px;">
                            {{ substr($chatUser->name, 0, 1) }}
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{ $chatUser->name }}</h5>
                            {{-- Зроби так (за замовчуванням ставимо Offline, JS сам змінить на Online, якщо треба) --}}
                            <small id="user-status" class="text-muted status-text">
                                <i class="bi bi-circle" style="font-size: 8px;"></i> Offline
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Зона повідомлень -->
                <div class="card-body" id="messages" style="height: 500px; overflow-y: auto; background-color: #f0f2f5;">
                    @forelse($messages as $message)
                        @if($message->sender_id === auth()->id())
                            <!-- Моє повідомлення (Справа) -->
                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-primary text-white rounded-3 py-2 px-3 shadow-sm" style="max-width: 75%; border-bottom-right-radius: 4px !important;">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @else
                            <!-- Повідомлення співрозмовника (Зліва) -->
                            <div class="d-flex justify-content-start mb-3">
                                <div class="bg-white text-dark border rounded-3 py-2 px-3 shadow-sm" style="max-width: 75%; border-bottom-left-radius: 4px !important;">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-muted mt-5">
                            <i class="bi bi-chat-square-text display-4 opacity-25 mb-3"></i>
                            <p>No messages yet. Say hello!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Форма вводу -->
                <div class="card-footer bg-white border-top p-3">
                    <form id="chat-form">
                        <input type="hidden" id="receiver-id" value="{{ $chatUser->id }}">
                        <div class="input-group input-group-lg">
                            <input type="text" id="message-input" placeholder="Type a message..." class="form-control border-end-0 bg-light" autocomplete="off">                            <button type="submit" id="send-message" class="btn btn-primary px-4">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        const receiverId = {{ $chatUser->id }};

        document.addEventListener("DOMContentLoaded", function() {
            const messagesDiv = document.getElementById("messages");
            const messageInput = document.getElementById("message-input"); // Повернули змінну!

            messagesDiv.scrollTo({ top: messagesDiv.scrollHeight, behavior: 'smooth' });
            // Перехоплюємо стандартну відправку форми (клік або Enter)
            document.getElementById('chat-form').addEventListener('submit', function(e) {
                e.preventDefault(); // Блокуємо перезавантаження сторінки!
                sendMessage();
            });

            // Функція для відправки повідомлення
            function sendMessage() {
                const messageText = messageInput.value.trim();
                if (messageText === '') return;

                // Відправляємо запит на сервер за допомогою Axios (він автоматично додає CSRF токен)
                axios.post('/chat/send', {
                    message: messageText,
                    receiver_id: receiverId
                })
                    .then(response => {
                        // Якщо успішно, додаємо своє повідомлення на екран
                        const msgHtml = `
                    <div class="d-flex justify-content-end mb-3">
                        <div class="bg-primary text-white rounded-3 py-2 px-3 shadow-sm" style="max-width: 75%; border-bottom-right-radius: 4px !important;">
                            ${messageText}
                        </div>
                    </div>
                `;
                        // Якщо була плашка "No messages yet", прибираємо її
                        if(messagesDiv.innerHTML.includes('No messages yet')) {
                            messagesDiv.innerHTML = '';
                        }
                        messagesDiv.insertAdjacentHTML('beforeend', msgHtml);
                        messagesDiv.scrollTop = messagesDiv.scrollHeight;
                        messageInput.value = ''; // Очищаємо поле
                    })
                    .catch(error => {
                        console.error("Помилка відправки:", error);
                    });
            }

            const statusElement = document.getElementById('user-status');

            function updateStatusUI() {
                if (!statusElement) return;

                // Перевіряємо, чи є наш співрозмовник у глобальному списку онлайн-користувачів
                const isOnline = window.onlineUsers.some(u => Number(u.id) === Number(receiverId));

                if (isOnline) {
                    statusElement.innerHTML = '<i class="bi bi-circle-fill" style="font-size: 8px;"></i> Online';
                    statusElement.className = 'text-success status-text';
                } else {
                    statusElement.innerHTML = '<i class="bi bi-circle" style="font-size: 8px;"></i> Offline';
                    statusElement.className = 'text-muted status-text';
                }
            }

// 1. Слухаємо подію, яку відправляє app.blade.php
            window.addEventListener('presence-updated', updateStatusUI);

// 2. Викликаємо функцію відразу при завантаженні сторінки
            updateStatusUI();

            // Слухаємо нові повідомлення через Laravel Echo (Pusher)
            window.Echo.private(`chat.${window.userId}`)
                .listen('.message.sent', (e) => {
                    console.log("🎉 Отримано нове повідомлення:", e);
                    // Якщо повідомлення від того, з ким ми зараз в чаті
                    if(e.user.id === receiverId) {
                        const msgHtml = `
                    <div class="d-flex justify-content-start mb-3">
                        <div class="bg-white text-dark border rounded-3 py-2 px-3 shadow-sm" style="max-width: 75%; border-bottom-left-radius: 4px !important;">
                            ${e.message}
                        </div>
                    </div>
                `;
                        if(messagesDiv.innerHTML.includes('No messages yet')) {
                            messagesDiv.innerHTML = '';
                        }
                        messagesDiv.insertAdjacentHTML('beforeend', msgHtml);
                        messagesDiv.scrollTop = messagesDiv.scrollHeight;
                    }
                });
        });
    </script>
@endsection
