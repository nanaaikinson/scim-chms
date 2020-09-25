import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import NProgress from "nprogress";
import "nprogress/nprogress.css";
import hasAccess from "./views/utils/hasaccess";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: process.env.NODE_ENV === "production" ? "hash" : "history",
  base: process.env.NODE_ENV === "production" ? "/" : process.env.BASE_URL,
  routes: [...routes]
});

router.beforeEach((to, from, next) => {
  NProgress.start();
  const persistenceKey = window.location.pathname || "chms";
  const token = localStorage.getItem(`_${persistenceKey}_token`) || null;
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  if (requiresAuth) {
    if (!token) {
      next({ name: "Home" });
    } else if (!hasAccess(to.name)) {
      next({ name: "Unauthorized" });
    }
    next();
  } else {
    next();
  }
});

/* router.beforeEach((to, from, next) => {
  NProgress.start();
  next();
}); */

router.afterEach((to, from) => {
  NProgress.done();
});

export default router;
