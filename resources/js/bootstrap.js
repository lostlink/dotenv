import Swal from 'sweetalert2';
import Alpine from 'alpinejs';
import Autosize from '@marcreichel/alpine-autosize';
import ClipboardJS from 'clipboard';

Alpine.plugin(Autosize);

window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Alpine = Alpine;
window.Swal = Swal;
window.Vapor = require('laravel-vapor');
window.tippy = require('tippy.js').default;
window.ClipboardJS = new ClipboardJS('.clipboard-btn');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
