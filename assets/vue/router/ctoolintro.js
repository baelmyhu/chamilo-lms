export default {
  path: "/resources/ctoolintro/",
  meta: { requiresAuth: true, showBreadcrumb: true },
  name: "ctoolintro",
  component: () => import("../components/ctoolintro/Layout.vue"),
  redirect: { name: "ToolIntroList" },
  children: [
    {
      name: "ToolIntroCreate",
      path: "new/:courseTool",
      component: () => import("../views/ctoolintro/Create.vue"),
    },
    {
      name: "ToolIntroUpdate",
<<<<<<< HEAD
      //path: ':id/edit',
=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
      path: "edit",
      component: () => import("../views/ctoolintro/Update.vue"),
    },
    {
      name: "ToolIntroShow",
      path: "",
      component: () => import("../views/ctoolintro/Show.vue"),
    },
  ],
}
