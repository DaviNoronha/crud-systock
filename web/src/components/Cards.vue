<template>
  <v-container class="align-center fill-height mx-auto" max-width="1800">
    <v-row>
      <v-col cols="4">
        <v-card
          class="py-6"
          color="surface-variant"
          image="https://cdn.vuetifyjs.com/docs/images/one/create/feature.png"
          prepend-icon="mdi-account-group"
          rounded="lg"
          variant="outlined"
        >
          <template #image>
            <v-img position="top right" />
          </template>

          <template #title>
            <h2 class="text-h5 font-weight-bold">{{ total }}</h2>
          </template>

          <template #subtitle>
            <div class="info-card-title text-subtitle-1">Total</div>
          </template>

          <v-overlay
            opacity=".12"
            scrim="primary"
            contained
            model-value
            persistent
          />
        </v-card>
      </v-col>

      <v-col cols="4">
        <v-card
          class="py-6"
          color="surface-variant"
          image="https://cdn.vuetifyjs.com/docs/images/one/create/feature.png"
          prepend-icon="mdi-shield-account"
          rounded="lg"
          variant="outlined"
        >
          <template #image>
            <v-img position="top right" />
          </template>

          <template #title>
            <h2 class="text-h5 font-weight-bold">{{ totalAdmin }}</h2>
          </template>

          <template #subtitle>
            <div class="info-card-title text-subtitle-1">Administradores</div>
          </template>

          <v-overlay
            opacity=".12"
            scrim="primary"
            contained
            model-value
            persistent
          />
        </v-card>
      </v-col>

      <v-col cols="4">
        <v-card
          class="py-6"
          color="surface-variant"
          image="https://cdn.vuetifyjs.com/docs/images/one/create/feature.png"
          prepend-icon="mdi-account"
          rounded="lg"
          variant="outlined"
        >
          <template #image>
            <v-img position="top right" />
          </template>

          <template #title>
            <h2 class="text-h5 font-weight-bold">{{ totalUsuarios }}</h2>
          </template>

          <template #subtitle>
            <div class="info-card-title text-subtitle-1">Usuários</div>
          </template>

          <v-overlay
            opacity=".12"
            scrim="primary"
            contained
            model-value
            persistent
          />
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">

export default {
  props: {
    total: { type: Number, required: true },
    totalAdmin: { type: Number, required: true },
    totalUsuarios: { type: Number, required: true },
  },
};
</script>
