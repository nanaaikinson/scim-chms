export default [
  {
    path: "pastor-report-upload",
    name: "pastor-report",
    component: () => import("@views/pastor-report/upload/Index.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "pastor-report-download",
    name: "download-pastor-report",
    component: () => import("@views/pastor-report/download/Index.vue"),
    meta: {
      requiresAuth: true
    }
  }
];
