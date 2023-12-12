import "./assets/main.css";

import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import { createPinia } from "pinia";

import App from "./App.vue";
import TodoHello from "./components/TodoHello.vue";
import TodoHome from "./components/TodoHome.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", component: TodoHome },
    { path: "/hello", component: TodoHello },
  ],
});

const pinia = createPinia();

const app = createApp(App);
// Make sure to _use_ the router instance to make the
// whole app router-aware.
app.use(router);
app.use(pinia);

app.mount("#app");
