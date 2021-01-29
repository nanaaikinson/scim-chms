export default [
  {
    path: "reports",
    component: () => import("@layouts/Report.vue"),
    children: [
      {
        path: "/",
        name: "ReportIndex",
        component: () => import("@views/report/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "attendance",
        name: "ReportAttendance",
        component: () => import("@views/report/attendance/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "expenses",
        name: "ReportExpense",
        component: () => import("@views/report/expense/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "pastor-report",
        name: "pastor-report",
        component: () => import("@views/report/pastor-report/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "contributions",
        name: "ReportContribution",
        component: () => import("@views/report/contribution/Index.vue"),
        meta: {
          requiresAuth: true
        }
      }
    ]
  }
];
