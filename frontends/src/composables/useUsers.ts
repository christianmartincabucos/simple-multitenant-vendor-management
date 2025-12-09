import { useUserStore } from "@/stores/userStore";

export function useUsers() {
  const store = useUserStore();
  return {
    users: store.users,
    fetchUsers: store.fetchUsers,
  };
}
