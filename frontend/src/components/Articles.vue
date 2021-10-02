<template>
  <v-container>
    <v-row>
      <v-col>
        <h2 class="press-start-2p-font user-select-none ipril-text-color">
          Статьи
        </h2>
      </v-col>
    </v-row>
    <v-row v-if="!loading">
      <v-col
        v-for="(article, index) in articles"
        :key="index"
        cols="3"
      >
        <v-card
          :loading="loading"
          :disabled="loading"
          rounded
        >
          <v-card-title>
            {{ article.title }}
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col>
                {{ article.content }}
              </v-col>
            </v-row>
            <v-row justify="end">
              <v-col cols="auto">
                <v-btn
                  icon
                  color="#81D4FA"
                  @click="goToResource(article.source)"
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
          :disabled="articles.length === value.length"
          text
          class="press-start-2p-font"
          style="color: #81D4FA"
          @click="addThreeArticles"
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
    name: 'Articles',

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
      articles: [],
      last_index: 0,
      name: localStorage.getItem('user_name'),
    }),

    watch: {
      value() {
        this.articles = [];

        this.addThreeArticles();
      },
    },

    methods: {

      addThreeArticles() {
        const articles = [];

        for (let i = this.articles.length; i < this.value.length; i++) {
          if (i >= this.articles.length + 4) {
            break;
          }

          this.value[i].content = this.value[i].content.substring(0, 200);

          articles.push({ ...this.value[i] });
        }

        this.articles = [...this.articles, ...articles];
      },

      goToResource(link) {
        location.href = link;
      },
    },
  };
</script>
