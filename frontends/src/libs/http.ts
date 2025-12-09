type RequestOptions = RequestInit & { params?: Record<string, any> };

const BASE_URL = import.meta.env.VITE_API_URL || "http://localhost:8000/api";

function buildQuery(params: Record<string, any> = {}) {
  const query = new URLSearchParams();
  Object.entries(params).forEach(([key, value]) => {
    if (value !== undefined && value !== null) query.append(key, String(value));
  });
  const q = query.toString();
  return q ? `?${q}` : "";
}

async function request<T>(url: string, options: RequestOptions = {}): Promise<T> {
  const token = sessionStorage.getItem("token");
  const headers: HeadersInit = {
    "Accept": "application/json",
    "Content-Type": "application/json",
    ...options.headers,
  };

  if (token) {
    (headers as any)["Authorization"] = `Bearer ${token}`;
  }

  const res = await fetch(`${BASE_URL}${url}${options.params ? buildQuery(options.params) : ""}`, {
    ...options,
    headers,
  });

  if (res.status === 401) {
    sessionStorage.removeItem("token");
    throw new Error("Unauthorized");
  }

  if (!res.ok) {
    const errorBody = await res.json().catch(() => ({}));
    throw new Error(errorBody.message || "HTTP Error");
  }

  return res.json();
}

export const http = {
  get: <T>(url: string, params?: Record<string, any>) => request<T>(url, { method: "GET", params }),
  post: <T>(url: string, body?: any) => request<T>(url, { method: "POST", body: JSON.stringify(body) }),
  put: <T>(url: string, body?: any) => request<T>(url, { method: "PUT", body: JSON.stringify(body) }),
  patch: <T>(url: string, body?: any) => request<T>(url, { method: "PATCH", body: JSON.stringify(body) }),
  delete: <T>(url: string) => request<T>(url, { method: "DELETE" }),
};
