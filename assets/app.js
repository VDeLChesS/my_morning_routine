import './bootstrap.js';
import './js/navbar.js';
import './js/flash-messages.js';
import './js/confirm-delete.js';
import './js/confirm-leave.js';
import 'jquery';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './styles/app.scss';


const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');
// import 'bootstrap';
const navbar = document.getElementById('navbar');
const navbarToggle = document.getElementById('navbar-toggle');
const navbarClose = document.getElementById('navbar-close');

navbarToggle.addEventListener('click', () => {
    navbar.classList.toggle('hidden');
    });
navbarClose.addEventListener('click', () => {
    navbar.classList.add('hidden');
    }
);


