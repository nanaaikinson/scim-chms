export default [
  {
    path: "branches",
    name: "branches",
    component: () => import("@views/branches/Index.vue")
  },
  {
    path: "branches/add",
    name: "branchesadd",
    component: () => import("@views/branches/Add.vue")
  },
  {
    path: "branches/edit/:mask",
    name: "branchesedit",
    component: () => import("@views/branches/Edit.vue")
  }
];
