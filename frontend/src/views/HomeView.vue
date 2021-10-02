<template>
  <v-fade-transition>
    <v-container>
      <v-row>
        <v-col>
          <ipril-search
            v-model="search"
            @click="runSearch"
          />
        </v-col>
      </v-row>
    </v-container>
  </v-fade-transition>
</template>

<script>
  import IprilSearch from 'Components/IprilSearch.vue';

  export default {
    name: 'Home',

    components: {
      IprilSearch,
    },

    data() {
      return {
        search: '',
      };
    },

    mounted() {
      if (localStorage.getItem('user_id') === null) {
        this.$router.push('/welcome');
      }
    },

    methods: {
      runSearch() {
        console.log('runSearch', this.$axios);
      },
    },
  };
</script>
