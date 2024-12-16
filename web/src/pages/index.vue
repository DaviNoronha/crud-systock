<template>
  <v-app-bar :elevation="2" rounded>
    <v-app-bar-title>Crud Systock</v-app-bar-title>

    <template v-slot:append>
      <v-menu>
        <template v-slot:activator="{ props }">
          <v-btn prepend-icon="mdi-account" v-bind="props"> {{ nome }}</v-btn>
        </template>
        <v-list>
          <v-list-item>
            <v-list-item-title>
              <v-form @submit.prevent="authStore.logout">
                <v-btn prepend-icon="mdi-logout" type="submit">Sair</v-btn>
              </v-form>
            </v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </template>
  </v-app-bar>

  <UserTable />
</template>

<script setup lang="ts">
import "@/assets/main.css";
import { definePage } from "unplugin-vue-router/runtime";
import { useAuthStore } from "@/store/auth";
import { storeToRefs } from "pinia";

const { nome } = storeToRefs(useAuthStore());

const authStore = useAuthStore();

definePage({
  alias: ["/n/:name"],
  meta: {
    requiresAuth: true,
  },
});
</script>
