<template>
  <v-fade-transition>
    <v-container>
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
          <ipril-bottom-sheet
            v-model="bottom_sheet"
            @filters="setFilters"
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
      };
    },

    mounted() {
      if (localStorage.getItem('user_id') === null) {
        this.$router.push('/welcome');
      }
    },

    methods: {
      async runSearch() {
        console.log('runSearch', await this.$axios.post('/api/search', {
          filters: [
            'video',
            'article',
            'image',
          ],
          searchers: [
            'youtube',
            'wiki',
            'image_wiki',
          ],
          search: this.search,
        }));
      },

      filterHandler() {
        this.bottom_sheet = !this.bottom_sheet;
      },

      setFilters() {

      },

    },
  };
</script>
