import { useAuthStore } from "@/stores/authStore";
import { computed } from "vue";

export function useAuth() {
  const store = useAuthStore();

  return {
    user: computed(() => store.user),
    organization: computed(() => store.organization),
    token: computed(() => store.token),
    login: (email: string, password: string) => store.login(email, password),
    logout: () => store.logout(),
  };
}
