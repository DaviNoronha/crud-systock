<template>
  <v-dialog v-model="dialogDelete" width="auto">
    <v-card
      max-width="400"
      prepend-icon="mdi-alert"
      text="O usuário será excluido permanentemente do sistema e não poderá ser recuperado."
      title="Deseja excluir o usuário?"
    >
      <template v-slot:actions>
        <v-btn color="blue-darken-1" variant="text" @click="closeDelete"
          >Cancelar</v-btn
        >
        <v-btn color="red-lighten-1" variant="text" @click="deleteUserConfirm" :loading="loading"
          >Confirmar</v-btn
        >
      </template>
    </v-card>
  </v-dialog>

  <Snackbar ref="snackbar"/>
</template>

<script lang="ts">
import BaseService from "@/services/BaseService";

export default {
  emits: ["update"],
  data: () => ({
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
    }
  }),

  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  methods: {
    deleteUser(user: any) {
      this.rowId = user.id;
      this.form = Object.assign({}, user);
      this.dialogDelete = true;
    },

    deleteUserConfirm() {
      this.loading = true;
      BaseService.delete(`users/${this.rowId}`)
        .then(() => {
          this.$refs.snackbar.openSnackbar(true, "Usuário excluído com sucesso");
          this.$emit("update", {page: 1, itemsPerPage: 10, sortBy: [{ key: 'nome', order: 'asc' }]});
        })
        .catch((err) => {
          this.$refs.snackbar.openSnackbar(false, err.response.data.message);
        })
        .finally(() => {
          this.loading = false;
          this.closeDelete();
        });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.form = Object.assign({}, this.defaultForm);
        this.rowId = "";
      });
    },
  },
};
</script>
