export default [
  {
    path: "branches",
    name: "branches",
    component: () => import("@views/branches/Index.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "branches/add",
    name: "branchesadd",
    component: () => import("@views/branches/Add.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "branches/edit/:mask",
    name: "branchesedit",
    component: () => import("@views/branches/Edit.vue"),
    meta: {
      requiresAuth: true
    }
  }
];
