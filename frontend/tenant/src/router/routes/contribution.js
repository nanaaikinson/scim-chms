export default [
  {
    path: "contributions",
    component: () => import("@layouts/Finance.vue"),
    children: [
      {
        path: "/",
        name: "Contributions",
        component: () => import("@views/contribution/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "covenant-partner/add",
        name: "covenantadd",
        component: () => import("@views/contribution/covenant/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "covenant-partner/:mask",
        name: "covenantedit",
        component: () => import("@views/contribution/covenant/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "busing/add",
        name: "busingadd",
        component: () => import("@views/contribution/busing/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "busing/:mask",
        name: "busingedit",
        component: () => import("@views/contribution/busing/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "tithe/add",
        name: "TitheAdd",
        component: () => import("@views/contribution/tithe/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "tithe/:mask",
        name: "TitheEdit",
        component: () => import("@views/contribution/tithe/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "group/add",
        name: "addgroup",
        component: () => import("@views/contribution/groups/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "group/:mask",
        name: "groupEdit",
        component: () => import("@views/contribution/groups/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "welfare/add",
        name: "addwelfare",
        component: () => import("@views/contribution/welfare/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "welfare/:mask",
        name: "welfareedit",
        component: () => import("@views/contribution/welfare/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "pledge/add",
        name: "pledgeAdd",
        component: () => import("@views/contribution/pledge/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "pledge/:mask",
        name: "pledgeEdit",
        component: () => import("@views/contribution/pledge/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "general/add",
        name: "generalAdd",
        component: () => import("@views/contribution/general/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "general/:mask",
        name: "generalEdit",
        component: () => import("@views/contribution/general/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      }
    ]
  }
];
