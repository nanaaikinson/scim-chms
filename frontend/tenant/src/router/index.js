import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import NProgress from "nprogress";
import "nprogress/nprogress.css";
import store from "../store";

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
    if (!token) {
      next({ name: "Home" });
    }
    if (!hasAccess(to.name)) {
      next({ name: "Home" });
    }
    next();
  } else {
    next();
  }
});

//check permissions
function hasAccess(name) {
  const permissions = store.state.user.permissions || [];
  switch (name) {
    case "Home":
      return true;

    case "users":
      return permissions.includes("read-user");

    case "role":
      return permissions.includes("read-role");

    case "groups":
      return permissions.includes("read-group");

    case "people":
      return permissions.includes("read-person");

    case "family":
      return permissions.includes("read-family");

    case "family":
      return permissions.includes("read-family");

    case "FollowUp":
      return permissions.includes("read-follow-up");

    case "attendance":
      return permissions.includes("read-attendance");

    case "Contributions":
      return permissions.includes("read-contribution");

    case "expenses":
      return permissions.includes("read-expenses");

    default:
      return false;
  }
}

router.beforeEach((to, from, next) => {
  NProgress.start();
  next();
});

router.afterEach((to, from) => {
  NProgress.done();
});

export default router;
