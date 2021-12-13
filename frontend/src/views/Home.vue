<template>
  <v-container>
    <v-row
        justify="center"
        content="center">
      <v-col
          col="12"
          md="6">
        <v-card>
          <v-card-title>
            <router-link to="/thread/leravel-test" class="text-decoration-none text-black">
              <h2>leravel test</h2>
            </router-link>
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col>
                <p>sanaz keyvanloo</p>
              </v-col>
              <v-col>
                <p class="text-right">2020/05/15 15:03:25</p>
              </v-col>
            </v-row>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua.
            </p>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

  </v-container>
</template>

<script>

export default {
  name: 'Home',

}
</script>