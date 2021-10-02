<template>
  <v-fade-transition>
    <v-container v-show="show_content">
      <v-row>
        <v-col>
          <ipril-search
            v-model="search"
            @click="runSearch"
            @filters="filterHandler"
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          Content
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

  export default {
    name: 'Home',

    components: {
      IprilSearch,
      IprilBottomSheet,
    },

    data() {
      return {
        search: '',
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
        console.log('runSearch', await this.$axios.post('/api/search', {
          filters: this.selected_filters,
          searchers: this.selected_searchers,
          search: this.search,
        }));
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
