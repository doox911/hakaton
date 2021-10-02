<template>
  <v-container>
    <v-row v-if="!loading && videos.length">
      <v-col>
        <h2 class="press-start-2p-font user-select-none ipril-text-color">
          Видео
        </h2>
      </v-col>
    </v-row>
    <v-row v-if="!loading && videos.length">
      <v-col
        v-for="(video, index) in videos"
        :key="index"
        cols="3"
      >
        <v-card
          :loading="loading"
          :disabled="loading"
          rounded
        >
          <v-card-title>
            {{ video.title }}
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col>
                <a
                  :href="video.source"
                  target="_blank"
                >
                  <img
                    :src="`${video.image_url}`"
                    style="width:100%; height: 200px;"
                  >
                </a>
              </v-col>
            </v-row>
            <v-row
              align="center"
              justify="end"
            >
              <v-col cols="auto">
                <b>{{ getSourceName(video.source_type) }}</b>
              </v-col>
              <v-col cols="auto">
                <v-btn
                  icon
                  color="#81D4FA"
                  @click="goToResource(video.source)"
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
      v-if="!loading && videos.length"
      justify="end"
    >
      <v-col cols="auto">
        <v-btn
          :disabled="videos.length === value.length"
          text
          class="press-start-2p-font"
          style="color: #81D4FA"
          @click="addThreeVideo"
          v-text="`Показать ещё`"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import DataMixin from 'Mixins/DataMixin';

  export default {
    name: 'IVideo',

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
      videos: [],
      last_index: 0,
      name: localStorage.getItem('user_name'),
    }),

    watch: {
      value() {
        this.videos = [];

        this.addThreeVideo();
      },
    },

    methods: {

      addThreeVideo() {
        const videos = [];

        for (let i = this.videos.length; i < this.value.length; i++) {
          if (i >= this.videos.length + 4) {
            break;
          }

          this.value[i].content = this.value[i].content.substring(0, 200);

          videos.push({ ...this.value[i] });
        }

        this.videos = [...this.videos, ...videos];
      },

    },
  };
</script>
