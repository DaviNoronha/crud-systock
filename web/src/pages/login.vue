<template>
  <div>
    <v-img class="mx-auto my-6" height="150" src="@/assets/logo.png" />

    <v-card
      class="mx-auto pa-12 pb-8"
      elevation="8"
      max-width="448"
      rounded="lg"
    >
      <v-form validate-on="blur" @submit.prevent="sendLogin(loginForm)" ref="form">
        <div class="text-subtitle-1 text-medium-emphasis">E-mail</div>

        <v-text-field
          density="compact"
          placeholder="Digite seu e-mail"
          prepend-inner-icon="mdi-email-outline"
          variant="outlined"
          v-model="loginForm.email"
          :rules="validateEmail"
          required
        ></v-text-field>

        <div
          class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
        >
          Senha
        </div>

        <v-text-field
          :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
          :type="visible ? 'text' : 'password'"
          density="compact"
          placeholder="Digite sua senha"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          v-model="loginForm.password"
          :error="errors.enabled"
          :error-messages="errors.message"
          :onclick="clearErrors"
          :rules="validatePassword"
          required
          @click:append-inner="visible = !visible"
        ></v-text-field>

        <v-btn
          class="my-4"
          color="blue"
          size="large"
          variant="tonal"
          block
          type="submit"
          :loading="loading"
        >
          Entrar
        </v-btn>
      </v-form>
    </v-card>
  </div>
</template>

<script lang="ts">
import { useAuthStore } from "@/store/auth";
import { validateEmail, validatePassword } from "@/utils/rules";
import { storeToRefs } from "pinia";

const { errors } = storeToRefs(useAuthStore());
const { login } = useAuthStore();

export default {
  data: () => ({
    visible: false,
    login,
    errors,
    loginForm: {
      email: "",
      password: "",
    },
    validateEmail,
    validatePassword,
    loading: false
  }),

  methods: {
    clearErrors() {
      this.errors = {
        enabled: false,
        message: "",
      };
    },

    sendLogin(loginForm) {
      this.loading = true;
      if (this.$refs.form.isValid) {
        login(loginForm);
      }
      this.loading = false;
    },
  },
};
</script>
