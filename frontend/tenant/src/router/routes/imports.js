export default [
  {
    path: "expense-import",
    name: "expenseimport",
    component: () => import("@views/tools/expense/ExpenseImport.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "contributions-import",
    name: "contributionsimport",
    component: () => import("@views/tools/contribution/ContributionImport.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "people-import",
    name: "peopleimport",
    component: () => import("@views/tools/people/PeopleImport.vue"),
    meta: {
      requiresAuth: true
    }
  }
];
