<template>
    <div class="min-h-screen flex items-center justify-center">
      <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Login</h1>
        <form @submit.prevent="submit" class="space-y-4">
          <input 
            v-model="email" 
            placeholder="Email" 
            type="email" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <input 
            v-model="password" 
            placeholder="Password" 
            type="password" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
            Login
          </button>
        </form>
      </div>
    </div>
</template>
  
<script lang="ts" setup>
  import { ref } from "vue";
  import { useRouter } from "vue-router";
  import { useAuth } from "@/composables/useAuth";
  
  const email = ref("");
  const password = ref("");
  const router = useRouter();
  const { login } = useAuth();
  
  async function submit() {
    await login(email.value, password.value);
    router.push("/");
  }
</script>