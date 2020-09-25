import reportRoutes from "./report";
import contributionRoutes from "./contribution";
import expenseRoutes from "./expense";
import pledgeRoutes from "./pledge";
import importRoutes from "./imports";
import branchesRoutes from "./branches";
import ticketsRoutes from "./ticket";

export default [
  {
    path: "/",
    component: () => import("@layouts/Auth.vue"),
    children: [
      {
        path: "",
        name: "Home",
        component: () => import("@views/auth/Index.vue")
      },
      {
        path: "password-reset",
        name: "PasswordReset",
        component: () => import("@views/auth/PasswordReset.vue")
      }
    ]
  },
  {
    path: "/",
    component: () => import("@layouts/Main.vue"),
    children: [
      {
        path: "dashboard",
        name: "Dashboard",
        component: () => import("@views/dashboard/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "books",
        name: "Books",
        component: () => import("@views/books/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "books/add",
        name: "BooksAdd",
        component: () => import("@views/books/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "books/edit/:mask",
        name: "BooksEdit",
        component: () => import("@views/books/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "user",
        name: "user",
        component: () => import("@views/users/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "user/add",
        name: "adduser",
        component: () => import("@views/users/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "user/edit/:mask",
        name: "useredit",
        component: () => import("@views/users/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "role",
        name: "role",
        component: () => import("@views/roles/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "role/add",
        name: "roleadd",
        component: () => import("@views/roles/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "role/edit/:mask",
        name: "roleedit",
        component: () => import("@views/roles/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "groups",
        name: "groups",
        component: () => import("@views/groups/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "groups/add",
        name: "groupadd",
        component: () => import("@views/groups/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "groups/edit/:mask",
        name: "groupedit",
        component: () => import("@views/groups/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "people",
        name: "people",
        component: () => import("@views/people/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "person/add",
        name: "addperson",
        component: () => import("@views/people/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "person/edit/:mask",
        name: "personedit",
        component: () => import("@views/people/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "person/detail/:mask",
        name: "PersonDetail",
        component: () => import("@views/people/detail/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "family",
        name: "family",
        component: () => import("@views/family/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "family/add",
        name: "familyadd",
        component: () => import("@views/family/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "family/edit/:mask",
        name: "familyedit",
        component: () => import("@views/family/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "follow-up",
        name: "FollowUp",
        component: () => import("@views/follow-up/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "follow-up/add",
        name: "FollowUpAdd",
        component: () => import("@views/follow-up/Add.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "follow-up/:mask",
        name: "FollowUpEdit",
        component: () => import("@views/follow-up/Edit.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "attendance",
        name: "attendance",
        component: () => import("@views/attendance/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "attendance/add",
        name: "AttendanceAdd",
        component: () => import("@views/attendance/import/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "attendance/:mask",
        name: "attendanceEdit",
        component: () => import("@views/attendance/edit/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "profile",
        name: "Profile",
        component: () => import("@views/profile/Index.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "set-currency",
        name: "currency",
        component: () => import("@views/settings/Currency.vue"),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "/not-authorized",
        name: "Unauthorized",
        component: () => import("@views/utils/Unauthorized.vue"),
        meta: {
          requiresAuth: false
        }
      },
      ...pledgeRoutes,
      ...expenseRoutes,
      ...contributionRoutes,
      ...reportRoutes,
      ...importRoutes,
      ...branchesRoutes,
      ...ticketsRoutes
    ]
  },
  {
    path: "/store",
    component: () => import("@layouts/Store.vue"),
    children: [
      {
        path: "books",
        name: "StoreBooks",
        component: () => import("@views/store/Books.vue")
      },
      {
        path: "book/:token",
        name: "StoreBook",
        component: () => import("@views/store/Book.vue")
      }
    ]
  },
  {
    path: "/404",
    name: "NotFound",
    component: () => import("@views/utils/404.vue")
  },
  {
    path: "*",
    redirect: { name: "NotFound" }
  }
];
