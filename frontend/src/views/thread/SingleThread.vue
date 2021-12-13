<template>
  <div>
    <h2>{{ $route.params.slug }}</h2>
  </div>
  <v-container>
    <v-row
        justify="center"
        content="center"
    >
      <v-col
          cols="12"
          md="8"
      >
        <v-card
            outlined
        >
          <v-card-title>
            <h2>laravel test</h2>
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
              dolore magna aliqua. Sit amet commodo nulla facilisi nullam. Diam sollicitudin tempor id eu nisl nunc.
              Cras adipiscing enim eu turpis. Purus in massa tempor nec. Ac tortor vitae purus faucibus ornare. Placerat
              in egestas erat imperdiet sed euismod. Ipsum consequat nisl vel pretium lectus quam id leo. Non
              consectetur a erat nam at lectus urna. Hendrerit gravida rutrum quisque non tellus orci ac. Volutpat lacus
              laoreet non curabitur gravida arcu ac. Fermentum et sollicitudin ac orci phasellus egestas. Euismod
              elementum nisi quis eleifend quam adipiscing. Ultrices tincidunt arcu non sodales neque sodales ut etiam
              sit. Aenean et tortor at risus. Aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros.
              In nulla posuere sollicitudin aliquam.
            </p>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" md="8">
        <v-row>
          <v-col>
            <h2>Replies: </h2>
          </v-col>
          <v-col class="text-right">
            <v-btn ripple to="#" color="green" dark>
              Reply
            </v-btn>
          </v-col>
        </v-row>
      </v-col>
      <v-row justify="center" content="center">
        <v-col
            cols="12"
            md="8"
        >
          <v-card
              outlined
          >
            <v-card-title>
              <v-avatar
                  color="orange"
                  size="62"
              >
                SK
              </v-avatar>
              <v-row class="ml-2">
                <v-col cols="12" md="12">
                  <h5>sanaz keyvanloo</h5>
                </v-col>
                <v-col cols="12" md="12">
                  <small class="text-grey" style="font-size: 10pt">2021/06/08 15:20:25</small>
                </v-col>
              </v-row>
            </v-card-title>
            <v-card-text>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Sit amet commodo nulla facilisi nullam. Diam sollicitudin tempor id eu nisl nunc.
                Cras adipiscing enim eu turpis. Purus in massa tempor nec. Ac tortor vitae purus faucibus ornare.
                Placerat
                in egestas erat imperdiet sed euismod. Ipsum consequat nisl vel pretium lectus quam id leo. Non
                consectetur a erat nam at lectus urna. Hendrerit gravida rutrum quisque non tellus orci ac. Volutpat
                lacus
                laoreet non curabitur gravida arcu ac. Fermentum et sollicitudin ac orci phasellus egestas. Euismod
                elementum nisi quis eleifend quam adipiscing. Ultrices tincidunt arcu non sodales neque sodales ut etiam
                sit. Aenean et tortor at risus. Aenean pharetra magna ac placerat vestibulum lectus mauris ultrices
                eros.
                In nulla posuere sollicitudin aliquam.
              </p>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-row>
  </v-container>
</template>

<script>
import VueMarkdown from 'vue-markdown/src/VueMarkdown'

export default {
  name: "SingleThread",
  components: {
    VueMarkdown
  }
}
</script>
