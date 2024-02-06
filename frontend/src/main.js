import { createApp } from "vue";
import { createWebHistory, createRouter } from "vue-router";
import { createStore } from "vuex";



// Import your Vuex module
import authModule from "@/store/auth";
import albums from "@/store/albums";
import profile from "@/store/profile";

// styles

import "@fortawesome/fontawesome-free/css/all.min.css";
import "@/assets/styles/tailwind.css";

// mouting point for the whole app

import App from "@/App.vue";

// layouts

import Admin from "@/layouts/Admin.vue";
import Auth from "@/layouts/Auth.vue";

// views for Admin layout

import Dashboard from "@/views/admin/Dashboard.vue";
import Settings from "@/views/admin/Settings.vue";
import Tables from "@/views/admin/Tables.vue";
import Maps from "@/views/admin/Maps.vue";

// views for Auth layout

import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";

// views without layouts

import Landing from "@/views/Landing.vue";
import Profile from "@/views/Profile.vue";
//import Index from "@/views/Index.vue";

// routes

const routes = [
  {
    path: "/admin",
    redirect: "/admin/dashboard",
    component: Admin,
    children: [
      {
        path: "/admin/dashboard",
        component: Dashboard,
      },
      {
        path: "/admin/settings",
        component: Settings,
      },
      {
        path: "/admin/tables",
        component: Tables,
      },
      {
        path: "/admin/maps",
        component: Maps,
      },
    ],
  },
  {
    path: "/",
    redirect: "/auth/login",
    component: Auth,
    children: [
      {
        path: "/auth/login",
        component: Login,
      },
      {
        path: "/auth/register",
        component: Register,
      },
    ],
  },
  {
    path: "/landing",
    component: Landing,
  },
  {
    path: "/profile",
    component: Profile,
  },
  { path: "/:pathMatch(.*)*", redirect: "/" },
];

// Navigation guard to check authentication before each route navigation

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Navigation guard to check authentication before each route navigation
router.beforeEach((to, from, next) => {
  const isLoggedIn = store.getters['isLoggedIn'];

  if (to.path.startsWith('/auth') && isLoggedIn) {
    // If user is logged in and trying to access login or register page, redirect to admin dashboard
    next('/profile');
  } else if (to.path.startsWith('/auth') && !isLoggedIn) {
    // If user is not logged in and trying to access pages other than login or register, redirect to login
    next();
  } else if (!isLoggedIn && to.path.startsWith('/profile')) {
    // If user is not logged in and trying to access admin pages, redirect to login
    next('/auth/login');
  } else {
    next(); // Continue navigation
  }
});

const store = createStore({
  modules: {
    auth: authModule,
    albums: {...albums, namespaced: true},
    profile: {...profile, namespaced: true}
  },

});

// Mount the Vue app
createApp(App)
  .use(router)
  .use(store)
  .mount("#app");