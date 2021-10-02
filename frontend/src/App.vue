<template>
  <v-app>
    <v-main>
      <router-view />

      <the-button-scroll-to-up />
    </v-main>
  </v-app>
</template>

<script>

  import TheButtonScrollToUp from 'Components/TheButtonScrollToUp';

  export default {
    name: 'App',

    components: {
      TheButtonScrollToUp,
    },

    data: () => ({
      //
    }),
  };
</script>
