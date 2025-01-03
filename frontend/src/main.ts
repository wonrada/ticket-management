import { createApp } from 'vue'
import './style.css'
import App from './app/App.vue'
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import router from './app/router';

createApp(App).use(router).mount('#app');
