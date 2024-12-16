import http from "@/http";
import router from "@/router";
import BaseService from "@/services/BaseService";
import { defineStore } from "pinia";

export const useAuthStore = defineStore("authStore", {
  state: () => {
    return {
      token: localStorage.getItem("token"),
      nome: localStorage.getItem("nome"),
      email: localStorage.getItem("email"),
      perfil: localStorage.getItem("perfil"),
      errors: {
        enabled: false,
        message: "",
      },
    };
  },
  getters: {
    isLoggedIn: (state) => {
      return !!state.token;
    },
  },
  actions: {
    async login(loginForm: any) {
      BaseService.post("login", loginForm)
        .then((response) => {
          localStorage.setItem("token", response.data.token);
          localStorage.setItem("nome", response.data.user.nome);
          localStorage.setItem("email", response.data.user.email);
          localStorage.setItem("perfil", response.data.user.perfil.nome);

          this.token = response.data.token;
          this.nome = response.data.user.nome;
          this.email = response.data.user.email;
          this.perfil = response.data.user.perfil.nome;

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
      localStorage.removeItem("token");
      localStorage.removeItem("nome");
      localStorage.removeItem("email");
      localStorage.removeItem("perfil");

      this.token = null;
      this.nome = null;
      this.email = null;
      this.perfil = null;

      router.push("/login");
    },
    success() {
      http.defaults.headers.common["Authorization"] = "Bearer " + this.token;
    },
  },
});
