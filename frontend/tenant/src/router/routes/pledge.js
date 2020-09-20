export default [
  {
    path: "pledge",
    name: "pledge",
    component: () => import("@views/pledge/Index.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "pledge/add",
    name: "pledgeadd",
    component: () => import("@views/pledge/Add.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "pledge/edit/:mask",
    name: "pledgeedit",
    component: () => import("@views/pledge/Edit.vue"),
    meta: {
      requiresAuth: true
    }
  }
];
