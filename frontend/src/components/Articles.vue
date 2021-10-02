<template>
  <v-container>
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
            {{ article.content }}
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row v-if="!loading">
      <v-col>
        <v-btn
          :disabled="articles.length === value.length"
          text
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
        default: Array,
        type: [],
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

    },
  };
</script>
