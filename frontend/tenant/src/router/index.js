import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import NProgress from "nprogress";
import "nprogress/nprogress.css";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: process.env.NODE_ENV === "production" ? "hash" : "history",
  base: process.env.NODE_ENV === "production" ? "/" : process.env.BASE_URL,
  routes: [...routes]
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("_chms_token") || null;
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

  if (requiresAuth) {
    if (token) {
      next();
    } else {
      next({ name: "Home" });
    }
  } else {
    next();
  }
});

router.beforeEach((to, from, next) => {
  NProgress.start();
  next();
});

router.afterEach((to, from) => {
  NProgress.done();
});

export default router;
