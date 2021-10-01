<template>
  <v-container class="fill-height">
    <v-row
      align="center"
      class="welcome-container"
      justify="center"
    >
      <v-col cols="auto">
        <h1 class="mb-3 text-center welcome-container__text">
          <span class="who-i-am" />
        </h1>
        <p class="text-center welcome-container__text">
          <span class="what-is-your-name" />
        </p>
        <transition name="slide-fade">
          <v-text-field
            v-show="is_v_text_filed"
            class="press-start-2p-font ipril-color"
            color="#81D4FA"
            hide-details
          />
        </transition>
        <transition name="slide-fade">
          <v-btn
            v-if="is_v_text_filed"
            color="#81D4FA"
            text
          >
            <span
              class="press-start-2p-font"
              v-text="`Погнали!`"
            />
          </v-btn>
        </transition>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import Typed from 'typed.js';

  export default {
    name: 'Welcome',

    data: () => ({
      is_v_text_filed: false,
    }),

    mounted() {
      document.querySelector('.ipril-color .v-text-field__slot > input').style.color = '#81D4FA';

      const self = this;

      // eslint-disable-next-line no-new
      new Typed('.who-i-am', {
        strings: ['Я Ipril'],
        typeSpeed: 50,
        showCursor: false,
        onComplete() {
          // eslint-disable-next-line no-new
          new Typed('.what-is-your-name', {
            startDelay: 1000,
            strings: ['Я помогаю искать контент', 'Давай знакомиться! Как тебя зовут?'],
            typeSpeed: 50,
            backSpeed: 20,
            showCursor: false,
            onComplete() {
              self.is_v_text_filed = true;
            },
          });
        },
      });
    },
  };
</script>

<style scoped>
  .welcome-container {
    height: 7em;
  }

  .welcome-container__text {
    color: #81D4FA;
    font-family: 'Press Start 2P', cursive;
    user-select: none;
  }

  .press-start-2p-font {
    font-family: 'Press Start 2P', cursive;
  }

  .ipril-color .v-text-field__slot > input {
    color: #81D4FA !important;
  }

  .slide-fade-enter-active {
    transition: all 1s ease;
  }

  .slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  }

  .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */
  {
    transform: translateY(30px);
    opacity: 0;
  }
</style>
