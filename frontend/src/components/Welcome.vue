<template>
  <v-container class="fill-height">
    <v-row
      align="center"
      justify="center"
    >
      <v-col>
        <p class="text-center">
          <span class="who-i-am"></span>
        </p>
        <p class="text-center">
          <span class="i-help"></span>
        </p>
        <p class="text-center">
          <span class="what-is-your-name"></span>
        </p>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import Typed from 'typed.js';

  export default {
    name: 'Welcome',

    data: () => ({}),

    mounted() {
      // eslint-disable-next-line no-new
      new Typed('.who-i-am', {
        strings: ['Я <span class="ipril-text">Ipril</span>'],
        typeSpeed: 100,
        showCursor: false,
        onComplete() {
          // eslint-disable-next-line no-new
          new Typed('.i-help', {
            startDelay: 1000,
            strings: [' Я помогаю искать контент. Но сначала, давай познакомимся'],
            typeSpeed: 100,
            showCursor: false,
            onComplete() {
              // eslint-disable-next-line no-new
              new Typed('.what-is-your-name', {
                startDelay: 1000,
                strings: ['Как тебя зовут?'],
                typeSpeed: 100,
                showCursor: false,
              });
            },
          });
        },
      });
    },
  };
</script>
