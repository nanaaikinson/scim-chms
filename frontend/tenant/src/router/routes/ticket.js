export default [
  {
    path: "tickets",
    name: "tickets",
    component: () => import("@views/ticketing/Index.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "tickets/add",
    name: "ticketsadd",
    component: () => import("@views/ticketing/Add.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "tickets/edit/:mask",
    name: "ticketsedit",
    component: () => import("@views/ticketing/Edit.vue"),
    meta: {
      requiresAuth: true
    }
  }
];
