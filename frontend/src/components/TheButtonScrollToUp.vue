<template>
  <v-slide-y-transition>
    <v-btn
      v-show="show"
      v-scroll="onScroll"
      color="#81D4FA"
      bottom
      dark
      fab
      fixed
      right
      @click="toTop"
    >
      <v-icon
        v-text="`keyboard_arrow_up`"
      />
    </v-btn>
  </v-slide-y-transition>
</template>

<script>

  export default {
    name: 'TheButtonScrollToUp',

    data() {
      return {
        show: false,
      };
    },

    methods: {
      onScroll(e) {
        if (typeof window === 'undefined') {
          return;
        }

        const top = window.pageYOffset || e.target.scrollTop || 0;

        this.show = top > 200;
      },

      toTop() {
        this.$vuetify.goTo(0);
      },

    },

  };
</script>
