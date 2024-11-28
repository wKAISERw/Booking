import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from 'axios';

window.Pusher = Pusher;

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (typeof window.userId !== 'undefined') {
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
        forceTLS: true,
    });

    window.Echo.private(`chat.${window.userId}`)
        .listen('MessageSent', (event) => {
            const messageDiv = document.createElement('div');
            messageDiv.innerHTML = `<strong>${event.user.name}:</strong> ${event.message}`;
            const messagesContainer = document.getElementById('messages');
            messagesContainer.appendChild(messageDiv);

            // Автоскрол до останнього повідомлення
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        });
}
 else {
    console.error('User ID is not defined. Ensure you are authenticated.');
}
