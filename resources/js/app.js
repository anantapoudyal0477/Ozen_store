import './bootstrap';

// jQuery via npm and global
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// Your scripts (order matters!)
import './Navigation.js';
import './cart-ajax.js';
import './Messages/ErrorMessage.js';
import './Messages/SuccessMessage.js';
import './Admin/AdminNavigation.js';
import './Day_and_Night.js';

// FontAwesome
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';

//tailwind
