<template>
  <v-bottom-sheet
    :value="value"
    @input="$emit('input', $event)"
  >
    <v-sheet
      class="text-center press-start-2p-font "
    >
      <v-container>
        <v-row>
          <v-col
            class="ma-0 pa-0 pt-3"
            cols="auto"
          >
            <p>
              Что ищем:
            </p>
          </v-col>
        </v-row>
        <v-row
          align="center"
          justify="start"
        >
          <v-col
            v-for="(filter, index) in filters"
            :key="index"
            class="ma-0 pa-0"
            cols="3"
          >
            <v-checkbox
              v-model="selected_filters"
              color="#81D4FA"
              :value="filter.value"
              :label="filter.description"
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col
            class="ma-0 pa-0"
            cols="auto"
          >
            <p>
              Где ищем:
            </p>
          </v-col>
        </v-row>
        <v-row
          align="center"
          justify="start"
        >
          <v-col
            v-for="(searcher, index) in searchers"
            :key="index"
            class="ma-0 pa-0"
            cols="4"
          >
            <v-checkbox
              v-model="selected_searchers"
              color="#81D4FA"
              :value="searcher.value"
              :label="searcher.description"
            />
          </v-col>
        </v-row>
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            class="ma-0 pa-0"
            cols="auto"
          >
            <v-btn
              text
              color="#81D4FA"
              @click="$emit('input', false)"
              v-text="`Готово`"
            />
          </v-col>
        </v-row>
      </v-container>
    </v-sheet>
  </v-bottom-sheet>
</template>

<script>
  export default {
    name: 'IprilBottomSheet',

    props: {
      value: {
        default: false,
        type: Boolean,
      },
    },

    data: () => ({
      filters: [
        {
          description: 'Видео',
          value: 'video',
        },
        {
          description: 'Статьи',
          value: 'article',
        },
        {
          description: 'Изображения',
          value: 'image',
        },
      ],

      searchers: [
        {
          description: 'Rutube',
          value: 'rutube',
        },
        {
          description: 'Википедия',
          value: 'wiki',
        },
        {
          description: 'Википедия(Изображения)',
          value: 'image_wiki',
        },
        {
          description: 'DuckDuckGo',
          value: 'duck',
        },
        {
          description: 'Рамблер',
          value: 'rambler',
        },
      ],

      selected_filters: ['article'],
      selected_searchers: ['wiki'],
    }),

    watch: {
      selected_filters() {
        if (!this.selected_filters.length) {
          this.selected_filters = ['article'];
        }

        localStorage.setItem('selected_filters', JSON.stringify(this.selected_filters));

        this.$emit('selected-filters', [...this.selected_filters]);
      },

      selected_searchers() {
        if (!this.selected_searchers.length) {
          this.selected_searchers = ['wiki'];
        }

        localStorage.setItem('selected_searchers', JSON.stringify(this.selected_searchers));

        this.$emit('selected-searchers', [...this.selected_searchers]);
      },
    },

    mounted() {
      if (localStorage.getItem('selected_filters') !== null) {
        this.selected_filters = JSON.parse(localStorage.getItem('selected_filters'));
      }

      if (localStorage.getItem('selected_searchers') !== null) {
        this.selected_searchers = JSON.parse(localStorage.getItem('selected_searchers'));
      }
    },
  };
</script>
