<template>
  <viewer v-if="!loading && images.length" :images="images">
    <v-container>
      <v-row>
        <v-col>
          <h2 class="press-start-2p-font user-select-none ipril-text-color">
            Изображения
          </h2>
        </v-col>
      </v-row>
      <v-row>
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
                  <img
                    :src="`${image.content}`"
                    style="width:100%; height: 200px;"
                  >
                </v-col>
              </v-row>
              <v-row
                align="center"
                justify="end"
              >
                <v-col cols="auto">
                  <b>{{ getSourceName(image.source_type) }}</b>
                </v-col>
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
    </v-container>
  </viewer>
</template>

<script>
  import DataMixin from 'Mixins/DataMixin';

  export default {
    name: 'Images',

    mixins: [
      DataMixin,
    ],

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

    },
  };
</script>
