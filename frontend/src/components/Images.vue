<template>
  <v-container>
    <v-row>
      <v-col>
        <h2 class="press-start-2p-font user-select-none ipril-text-color">
          Изображения
        </h2>
      </v-col>
    </v-row>
    <v-row v-if="!loading">
      <v-col
        v-for="(image, index) in images"
        :key="index"
        cols="3"
      >
        <v-card
          :loading="loading"
          :disabled="loading"
          rounded
        >
          <v-card-title>
            {{ image.title }}
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col>
                <img :src="`${image.content}`" />
              </v-col>
            </v-row>
            <v-row justify="end">
              <v-col cols="auto">
                <v-btn
                  icon
                  color="#81D4FA"
                  @click="goToResource(image.source)"
                >
                  <v-icon
                    v-text="`mdi-open-in-new`"
                  />
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row
      v-if="!loading"
      justify="end"
    >
      <v-col cols="auto">
        <v-btn
          :disabled="images.length === value.length"
          text
          class="press-start-2p-font"
          style="color: #81D4FA"
          @click="addThreeImages"
          v-text="`Показать ещё`"
        />
      </v-col>
    </v-row>
    <v-row v-if="loading">
      <v-col>
        <h3 class="user-select-none press-start-2p-font ipril-text-color">
          {{ name }}, я в поиске...
        </h3>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    name: 'Images',

    props: {
      value: {
        default: () => [],
        type: Array,
      },
      loading: {
        default: false,
        type: Boolean,
      },
    },

    data: () => ({
      images: [],
      last_index: 0,
      name: localStorage.getItem('user_name'),
    }),

    watch: {
      value() {
        this.images = [];

        this.addThreeImages();
      },
    },

    methods: {

      addThreeImages() {
        const images = [];

        for (let i = this.images.length; i < this.value.length; i++) {
          if (i >= this.images.length + 4) {
            break;
          }

          this.value[i].content = this.value[i].content.substring(0, 200);

          images.push({ ...this.value[i] });
        }

        this.images = [...this.images, ...images];
      },

      goToResource(url) {
        window.open(url, '_blank');
      },
    },
  };
</script>
