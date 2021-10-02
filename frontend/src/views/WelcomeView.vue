<template>
  <v-fade-transition>
    <v-container
      v-if="is_container"
      class="fill-height"
    >
      <v-row
        align="center"
        class="welcome-container"
        justify="center"
      >
        <v-col cols="auto">
          <v-row>
            <v-col>
              <h1 class="mb-3 text-center welcome-container__text">
                <span class="who-i-am" />
              </h1>
              <p class="text-center welcome-container__text">
                <span class="ipril-description" />
                <span class="what-is-your-name" />
              </p>
            </v-col>
          </v-row>
          <v-row
            align="center"
            justify="center"
          >
            <v-col
              class="pt-0"
              cols="auto"
            >
              <transition name="slide-fade">
                <v-text-field
                  v-show="is_v_text_filed"
                  v-model="name"
                  class="press-start-2p-font ipril-color"
                  color="#81D4FA"
                  outlined
                  placeholder="Напиши своё имя.."
                  rounded
                  autocomplete="off"
                  type="search"
                  hide-details
                />
              </transition>
            </v-col>
          </v-row>
          <v-row
            align="center"
            justify="center"
          >
            <v-col cols="auto">
              <transition name="slide-fade">
                <v-btn
                  v-show="is_v_text_filed"
                  color="#81D4FA"
                  :disabled="!name.length"
                  text
                  @click="onClickHandler"
                >
                  <span
                    class="press-start-2p-font"
                    v-text="`Погнали!`"
                  />
                </v-btn>
              </transition>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </v-fade-transition>
</template>

<script>
  import Typed from 'typed.js';

  export default {
    name: 'WelcomeView',

    data: () => ({
      name: '',
      is_container: true,
      is_v_text_filed: false,
    }),

    created() {
      if (localStorage.getItem('user_id') !== null) {
        this.$router.push('/');
      }
    },

    mounted() {
      if (localStorage.getItem('user_id') === null) {
        document.querySelector('.ipril-color .v-text-field__slot > input').style.color = '#81D4FA';

        const self = this;

        // eslint-disable-next-line no-new
        new Typed('.who-i-am', {
          strings: ['Я Ipril'],
          typeSpeed: 50,
          showCursor: false,
          onComplete() {
            // eslint-disable-next-line no-new
            new Typed('.ipril-description', {
              startDelay: 1000,
              strings: ['Я помогаю искать контент', 'Давай знакомиться! '],
              typeSpeed: 50,
              backSpeed: 20,
              showCursor: false,
              onComplete() {
                // eslint-disable-next-line no-new
                new Typed('.what-is-your-name', {
                  startDelay: 2000,
                  strings: ['Как тебя зовут?'],
                  typeSpeed: 50,
                  backSpeed: 20,
                  showCursor: false,
                  onComplete() {
                    setTimeout(() => {
                      self.is_v_text_filed = true;
                    }, 1000);
                  },
                });
              },
            });
          },
        });
      }
    },

    methods: {
      onClickHandler() {
        localStorage.setItem('user_id', `${Date.now()}`);
        localStorage.setItem('user_name', `${this.name}`);

        this.is_container = false;
        setTimeout(() => {
          this.$router.push('/');
        }, 1000);
      },
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
