<template>
  <v-dialog v-model="dialog" max-width="900px">
    <v-card>
      <v-form validate-on="blur" @submit.prevent="save" ref="form">
        <v-card-title>
          <span class="text-h5">{{ formTitle }}</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" md="6" sm="6">
                <v-text-field
                  v-model="form.nome"
                  label="Nome"
                  :error="errors.enabled"
                  :error-messages="errors.message"
                  :rules="validateNome"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6" sm="6">
                <v-text-field
                  v-model="form.email"
                  label="E-mail"
                  :rules="validateEmail"
                  :error="errors.enabled"
                  :error-messages="errors.message"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4" sm="6">
                <v-text-field
                  v-model="form.cpf"
                  label="CPF"
                  :rules="validateCPF"
                  :error="errors.enabled"
                  :error-messages="errors.message"
                  v-mask="['###.###.###-##']"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4" sm="6">
                <v-select
                  v-model="form.perfil"
                  :items="perfis"
                  item-value="nome"
                  item-title="descricao"
                  label="Perfil"
                  :rules="validatePerfil"
                  :error="errors.enabled"
                  :error-messages="errors.message"
                ></v-select>
              </v-col>
              <v-col cols="12" md="4" sm="6">
                <v-text-field
                  v-model="form.password"
                  label="Senha"
                  :rules="rowId ? [] : validatePassword"
                  :error="errors.enabled"
                  :error-messages="errors.message"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red-darken-1" variant="text" @click="close">
            Cancelar
          </v-btn>
          <v-btn color="blue-darken-1" variant="text" type="submit" :loading="loading">
            Salvar
          </v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-dialog>
  <Snackbar ref="snackbar"/>
</template>

<script lang="ts">
import BaseService from "@/services/BaseService";
import { validateCPF, validateEmail, validateNome, validatePassword, validatePerfil } from "@/utils/rules";
import Snackbar from "./Snackbar.vue";

export default {
  emits: ["update"],
  data: () => ({
    dialog: false,
    dialogDelete: false,
    loading: false,
    rowId: "",
    form: {
      nome: "",
      cpf: "",
      email: "",
      perfil: "",
      password: "",
    },
    defaultForm: {
      nome: "",
      cpf: "",
      email: "",
      perfil: "",
      password: "",
    },
    errors: {
      enabled: false,
      message: "",
    },
    validateNome,
    validateCPF,
    validatePerfil,
    validateEmail,
    validatePassword,
    snackbarData: {
      success: true,
      message: "",
    },
    Snackbar,
  }),

  props: {
    perfis: { type: Object },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
  },

  computed: {
    formTitle() {
      return !this.rowId ? "Novo Usuário" : "Editar Usuário";
    },
  },

  methods: {
    openForm(user: any) {
      if (user) {
        this.rowId = user.id;
        this.form.nome = user.nome;
        this.form.email = user.email;
        this.form.cpf = user.cpf;
        this.form.perfil = user.perfil.nome;
      }
      this.dialog = true;
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.form = Object.assign({}, this.defaultForm);
        this.rowId = "";
      });
    },

    save() {
      this.loading = true;

      if (!this.$refs.form.isValid) {
        return;
      }

      if (!this.rowId) {
        BaseService.post(`users`, this.form)
          .then((res) => {
            this.$refs.snackbar.openSnackbar(true, "Usuário cadastrado com sucesso");
            this.$emit("update", {page: 1, itemsPerPage: 10, sortBy: [{ key: 'nome', order: 'asc' }]});
            this.close();
          })
          .catch((err) => {
            this.$refs.snackbar.openSnackbar(false, err.response.data.message);
          })
          .finally(() => {
            this.loading = false;
          })
      } else {
        BaseService.put(`users/${this.rowId}`, this.form)
          .then((res) => {
            this.$refs.snackbar.openSnackbar(true, "Usuário atualizado com sucesso");
            this.$emit("update", {page: 1, itemsPerPage: 10, sortBy: [{ key: 'nome', order: 'asc' }]});
            this.close();
          })
          .catch((err) => {
            this.$refs.snackbar.openSnackbar(false, err.response.data.message);
          })
          .finally(() => {
            this.loading = false;
          })
      }
    },
  },
};
</script>
