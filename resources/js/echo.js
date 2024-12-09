import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

const chatRoomId = 1; // Example chat room ID

window.Echo.private(`chat-room.${chatRoomId}`)
    .listen('.message.sent', (e) => {
        console.log("New message received:", e.message);
    });


// window.Echo.private('chat-room.1').listen('MessageEvent', function (val) {
//     console.log('private:')
//     console.log(val)
// })