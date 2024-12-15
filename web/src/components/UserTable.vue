<template>
  <v-container class="align-center mx-auto" max-width="1800">
    <v-row>
      <Cards
        :total="total"
        :totalAdmin="totalAdmin"
        :totalUsuarios="totalUsuarios"
      />

      <v-col cols="12">
        <v-data-table-server
          v-model:items-per-page="itemsPerPage"
          :headers="headers"
          :items="users"
          :items-length="total"
          :loading="loading"
          loading-text="Buscando usuários..."
          :search="search"
          item-value="nome"
          :sort-by="sortBy"  
          height="550px"
          @update:options="loadUsers"
        >
          <template v-slot:top>
            <v-toolbar flat class="d-flex align-center gap-4">
              <v-toolbar-title>
                <v-icon icon="mdi-account"></v-icon> &nbsp; Usuários
              </v-toolbar-title>
              <v-spacer></v-spacer>

              <v-text-field
                v-model="search"
                class=""
                density="compact"
                placeholder="Buscar por nome..."
                hide-details
              ></v-text-field>

              <v-btn color="primary" dark @click="openForm(null)">
                Cadastrar Usuário
              </v-btn>
            </v-toolbar>
          </template>

          <template v-slot:[`item.created_at`]="{ item }">
            {{ formatDate(item.created_at.toString()) }}
          </template>

          <template v-slot:[`item.acoes`]="{ item }">
            <v-icon
              class="me-2 text-green-lighten-1"
              size="small"
              @click="openForm(item)"
            >
              mdi-pencil
            </v-icon>
            <v-icon
              class="text-red-lighten-1"
              size="small"
              @click="openModalDelete(item)"
            >
              mdi-delete
            </v-icon>
          </template>
        </v-data-table-server>
      </v-col>
    </v-row>
  </v-container>

  <UserForm @update="loadUsers" :perfis="perfis" ref="userForm" />
  <UserDelete @update="loadUsers" ref="userDelete" />
  <Snackbar ref="snackbar" />
</template>

<script lang="ts">
import BaseService from "@/services/BaseService";
import UserForm from "./UserForm.vue";
import UserDelete from "./UserDelete.vue";
import Snackbar from "./Snackbar.vue";
import type User from "@/interfaces/User";
import type Perfil from "@/interfaces/Perfil";

export default {
  data: () => ({
    itemsPerPage: 10,
    dialog: false,
    dialogDelete: false,
    sortBy: [{ key: 'nome', order: 'asc' }] as SortItem,
    headers: [
      { title: "Nome", key: "nome", align: "start" },
      { title: "CPF", key: "cpf", align: "end" },
      { title: "E-mail", key: "email", align: "end" },
      { title: "Adicionado(a) em", key: "created_at", align: "end" },
      { title: "Perfil", key: "perfil.descricao", align: "end" },
      { title: "Ações", key: "acoes", align: "end" },
    ] as const,
    users: [] as User[],
    perfis: []as Perfil[],
    loading: true,
    total: 0,
    totalAdmin: 0,
    totalUsuarios: 0,
    search: "",
    UserForm,
    UserDelete,
    Snackbar,
  }),

  mounted() {
    this.loadPerfis();
  },

  methods: {
    loadPerfis() {
      BaseService.get("perfis")
        .then((res) => {
          this.perfis = res.data;
        })
        .catch((err) => {
          this.$refs.snackbar.openSnackbar(false, err.response.data.message);
        });
    },

    loadUsers({ page, itemsPerPage, sortBy }) {
      this.loading = true;
      const queryUrl = `users?pagination=${itemsPerPage}&page=${page}&key=${sortBy[0].key}&order=${sortBy[0].order}`;

      BaseService.get(queryUrl)
        .then((res) => {
          this.users = res.data.data;
          this.loading = false;
        })
        .catch((err) => {
          this.$refs.snackbar.openSnackbar(false, err.response.data.message);
        });

      BaseService.get(`users/count`)
        .then((res) => {
          const response = res.data;
          this.total = response.admin + response.usuario;
          this.totalAdmin = response.admin;
          this.totalUsuarios = response.usuario;
        })
        .catch((err) => {
          this.$refs.snackbar.openSnackbar(false, err.response.data.message);
        });
    },

    openForm(user: any) {
      this.$refs.userForm.openForm(user);
    },
    openModalDelete(user: any) {
      this.$refs.userDelete.deleteUser(user);
    },
    formatDate(date: string) {
      const formattedDate = new Date(date);
      return new Intl.DateTimeFormat("pt-BR").format(formattedDate);
    },
  },
};
</script>
