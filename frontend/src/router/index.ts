import { useAuthStore } from "@/stores/authStore";
import { createRouter, createWebHistory } from "vue-router";

const DashboardView = () => import("@/views/DashboardView.vue");
const LoginView = () => import("@/views/LoginView.vue");
const InvoiceListView = () =>
  import("@/views/invoices/InvoiceListView.vue");
const InvoiceDetailView = () =>
  import("@/views/invoices/InvoiceDetailView.vue");
const VendorListView = () =>
  import("@/views/vendors/VendorListView.vue");

const routes = [
  { path: "/login", component: LoginView },
  { path: "/", component: DashboardView },
  { path: "/invoices", component: InvoiceListView },
  { path: "/invoices/:id", component: InvoiceDetailView },
  { path: "/vendors", component: VendorListView },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to) => {
  const authStore = useAuthStore();
  authStore.user = JSON.parse(sessionStorage.getItem("user") || "{}");
  authStore.organization = JSON.parse(sessionStorage.getItem("organization") || "{}");
  authStore.token = sessionStorage.getItem("token");
  
  if (to.path !== "/login" && !authStore.token) {
    return "/login";
  }
  if (to.path === "/login" && authStore.token) {
    return "/";
  }
});

export default router;
