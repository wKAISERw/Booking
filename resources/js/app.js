import './bootstrap';

// Логіка для відправки повідомлення
document.getElementById('send-message').addEventListener('click', function () {
    const message = document.getElementById('message-input').value;
    const receiverId = document.getElementById('receiver-id').value;
    
    axios.post('/chat/send', { message: message, receiver_id: receiverId })
        .then(() => {
            const messageDiv = document.createElement('div');
            messageDiv.innerHTML = `<strong>Ви:</strong> ${message}`;
            const messagesContainer = document.getElementById('messages');
            messagesContainer.appendChild(messageDiv);
    
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        })
        .catch((error) => {
            console.error('Error sending message:', error);
        });
    
    document.getElementById('message-input').value = '';
});
