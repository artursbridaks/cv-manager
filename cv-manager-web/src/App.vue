<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <router-link to="/" class="d-flex align-center" tag="div">
        <img alt="Save CV Logo" src="../src/assets/CV_Logo.png" contain height="50" class="pr-4">
        <h1>CV Manager</h1>
      </router-link>
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
    //
  })
};
</script>

<style scoped>
.d-flex.align-center:hover {
  cursor: pointer;
}
</style>
