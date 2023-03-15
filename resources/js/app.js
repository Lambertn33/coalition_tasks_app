import './bootstrap';

import { createApp } from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';

import Modal from "vue-bs-modal";

import App from './components/App.vue';

import TheNavbar from './components/reusable/nav/TheNavbar.vue';

import TheHeader from './components/reusable/TheHeader.vue';

import TheSpinner from './components/reusable/TheSpinner.vue';

import router from './router';

import store from './store';

import "bootstrap/dist/css/bootstrap.min.css";

import 'bootstrap/dist/js/bootstrap.bundle';

import 'sweetalert2/dist/sweetalert2.min.css';


const app = createApp(App);

app.component('the-navbar', TheNavbar);

app.component('the-header', TheHeader);

app.component('the-spinner', TheSpinner);

app.use(router);

app.use(store);

app.use(VueSweetalert2);

app.use(Modal);

app.mount('#app');