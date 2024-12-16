import axios, { type AxiosInstance } from "axios";
import { useAuthStore } from "./store/auth";
import router from "./router";

const http: AxiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api/',
  headers: {
    "Content-type": "application/json",
    "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS",
    "Access-Control-Allow-Credentials": "true",
  },
});

http.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    const store = useAuthStore();

    if (error.response?.status === 401) {
      store.logout();
      router.push("/login");
    }

    return Promise.reject(error);
  }
);

export default http;
