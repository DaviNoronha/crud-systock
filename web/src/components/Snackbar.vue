<template>
  <v-snackbar :color="success ? 'green-lighten-1' : 'red-lighten-1'" v-model="snackbar">
    {{ message }}

    <template v-slot:actions>
      <v-btn variant="text" @click="snackbar = false">
        Ok
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script lang="ts">

export default {
  data: () => ({
    success: false,    
    message: "",
    snackbar: false
  }),
  methods: {
    openSnackbar(success: boolean, message: string) {
      this.success = success;
      this.message = message;
      this.snackbar = true
    }
  }
};
</script>
