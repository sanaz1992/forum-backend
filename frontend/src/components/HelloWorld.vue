<template>
  <v-card>
    <v-system-bar></v-system-bar>
    <v-banner
        single-line
        :sticky="sticky"
    >
      We can't save your edits while you are in offline mode.

      <template v-slot:actions>
        <v-btn
            class="float-right text-white"
            text
            color="deep-purple accent-4"
        >
         Register
        </v-btn>
      </template>
    </v-banner>
    <v-card-text class="grey lighten-4">
      <v-sheet
          max-width="800"
          height="300"
          class="mx-auto"
      ></v-sheet>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    sticky: false,
  }),
}
</script>