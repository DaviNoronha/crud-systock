import http from "@/http";
import router from "@/router";
import BaseService from "@/services/BaseService";
import { defineStore } from "pinia";

export const useAuthStore = defineStore("authStore", {
  state: () => {
    return {
      token: localStorage.getItem('token'),
      email: localStorage.getItem('email'),
      errors: {
        enabled: false,
        message: "",
      },
    };
  },
  getters: {
    isLoggedIn: (state) => {
      return !!state.token;
    }
  },
  actions: {
    async login(loginForm: any) {
      BaseService.post("login", loginForm)
        .then((response) => {
            localStorage.setItem('token', response.data);
            localStorage.setItem('email', loginForm.email);

            this.token = response.data;
            this.email = loginForm.email;

            router.push("/");
        })
        .catch((err) => {
          this.errors = {
            enabled: true,
            message: err.response.data.message,
          };
        });
    },
    async logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('email');
      router.push("/login");
    },
    success() {
      http.defaults.headers.common["Authorization"] = "Bearer " + this.token;
    }
  },
});
