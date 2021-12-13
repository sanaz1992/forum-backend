<template>
<v-container>
  <v-row justify="center" content="center">
    <v-col cols="12" md="8">
      <v-card>
        <v-card-title>Create New Thread</v-card-title>
        <v-card-text>
          <v-form>
            <v-text-field
                label="Title"
                name="title"
                type="text"
                outlined
            ></v-text-field>
            <v-textarea
                name="Content"
                label="content"
                value=""
            ></v-textarea>
            <v-select
                label="Channel"
                outlined
            ></v-select>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn ripple color="green" class="text-white">
            submit
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</v-container>
</template>

<script>
export default {
name: "CreateThread"
}
</script>

<style scoped>

</style>