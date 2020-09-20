export default [
  {
    path: "expenses",
    name: "expenses",
    component: () => import("@views/expenses/Index.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "expenses/add",
    name: "expensesadd",
    component: () => import("@views/expenses/Add.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "expenses/edit/:mask",
    name: "expensesedit",
    component: () => import("@views/expenses/Edit.vue"),
    meta: {
      requiresAuth: true
    }
  }
];
