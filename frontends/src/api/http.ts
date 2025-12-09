import axios from "axios";

export const http = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  withCredentials: true,
});

// Attach token to every request
http.interceptors.request.use(config => {
  const token = sessionStorage.getItem("token");
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Remove token on logout
http.interceptors.response.use(undefined, error => {
  if (error.response.status === 401) {
    sessionStorage.removeItem("token");
  }
  return Promise.reject(error);
});