export default {
  path: "/resources/personal_files",
  meta: { requiresAuth: true },
  name: "personal_files",
  component: () => import("../views/personalfile/Home.vue"),
  children: [
    {
<<<<<<< HEAD
      name: "personal_files",
=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
      path: ":node/",
      component: () => import("../components/personalfile/Layout.vue"),
      redirect: { name: "PersonalFileList" },
      children: [
        {
          name: "PersonalFileList",
          path: "",
          component: () => import("../views/personalfile/List.vue"),
        },
        {
          name: "PersonalFileUploadFile",
          path: "upload",
          component: () => import("../views/personalfile/Upload.vue"),
        },
        {
          name: "PersonalFileShared",
          path: "shared",
          component: () => import("../views/personalfile/Shared.vue"),
        },
        {
          name: "PersonalFileUpdate",
<<<<<<< HEAD
          //path: ':id/edit',
=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
          path: "edit_file",
          component: () => import("../views/personalfile/Update.vue"),
        },
        {
          name: "PersonalFileShow",
          path: "show",
          component: () => import("../views/personalfile/Show.vue"),
        },
      ],
    },
  ],
}
