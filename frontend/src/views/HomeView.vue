<template>
  <v-fade-transition>
    <v-container v-show="show_content">
      <v-row>
        <v-col>
          <ipril-search
            v-model="search"
            :loading="loading"
            @click="runSearch"
            @filters="filterHandler"
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <articles
            :value="find.article"
            :loading="loading"
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <images
            :value="find.image"
            :loading="loading"
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <i-video
            :value="find.video"
            :loading="loading"
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <ipril-bottom-sheet
            v-model="bottom_sheet"
            @selected-filters="setSelectedFilters"
            @selected-searchers="setSelectedSearchers"
          />
        </v-col>
      </v-row>
    </v-container>
  </v-fade-transition>
</template>

<script>
  import IprilSearch from 'Components/IprilSearch.vue';
  import IprilBottomSheet from 'Components/IprilBottomSheet';
  import Articles from 'Components/Articles';
  import Images from 'Components/Images';
  import IVideo from 'Components/IVideo';

  export default {
    name: 'HomeView',

    components: {
      Articles,
      Images,
      IVideo,
      IprilSearch,
      IprilBottomSheet,
    },

    data() {
      return {
        search: '',
        loading: false,
        bottom_sheet: false,
        selected_filters: ['article'],
        selected_searchers: ['wiki'],
        show_content: false,

        find: {
          article: [],
          image: [],
          video: [],
        },
      };
    },

    mounted() {
      this.show_content = localStorage.getItem('user_id') !== null;

      if (localStorage.getItem('user_id') === null) {
        this.$router.push('/welcome');
      }
    },

    methods: {
      async runSearch() {
        try {
          this.loading = true;

          const response = await this.$axios.post('/api/search', {
            filters: this.selected_filters,
            searchers: this.selected_searchers,
            search: this.search,
          });

          this.find.article = response.data.content?.article ?? [];
          this.find.image = response.data.content?.image ?? [];
          this.find.video = response.data.content?.video ?? [];
        } catch (e) {
          console.log(e);
        } finally {
          this.loading = false;
        }
      },

      filterHandler() {
        this.bottom_sheet = !this.bottom_sheet;
      },

      setSelectedFilters(filters) {
        this.selected_filters = filters;
      },

      setSelectedSearchers(searchers) {
        this.selected_searchers = searchers;
      },

    },
  };
</script>
