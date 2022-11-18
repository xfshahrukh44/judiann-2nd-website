window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');
// window.io = require('socket.io-client');

// if (typeof io !== 'undefined') {
//     window.Echo = new Echo({
//         namespace: 'App.Events',
//         broadcaster: 'socket.io',
//         host: window.location.hostname + ':6001',
//         withCredentials: true
//     });
// }
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    authEndpoint: process.env.MIX_BASE_URL + "/broadcasting/auth",
    wsHost: window.location.hostname,
    wsPort: 6002,
    wssPort: 6002,
    encrypted: process.env.NODE_ENV === 'production',
    forceTLS: process.env.NODE_ENV === 'production',
    disableStats: true,
    enabledTransports: ['ws', 'wss']
});


// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
