<template>
  <v-bottom-sheet
    :value="value"
    @input="$emit('input', $event)"
  >
    <v-sheet
      class="text-center press-start-2p-font "
    >
      <v-container>
        <v-row
          align="center"
          justify="center"
        >
          <v-col cols="auto">
            <v-checkbox
              v-for="(filter, index) in filters"
              :key="index"
              v-model="selected_filters"
              color="#81D4FA"
              :value="filter.value"
              :label="filter.description"
            />
          </v-col>
          <v-col cols="auto">
            <v-checkbox
              v-for="(searcher, index) in searchers"
              :key="index"
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
          <v-col cols="auto">
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
          description: 'Youtube',
          value: 'youtube',
        },
        {
          description: 'Википедия',
          value: 'wiki',
        },
        {
          description: 'Википедия(Изображения)',
          value: 'image_wiki',
        },
      ],

      selected_filters: ['article'],
      selected_searchers: ['wiki'],
    }),

    watch: {
      selected_filters(value) {
        if (!this.selected_filters.length) {
          this.selected_filters = ['article'];
        }

        this.$emit('selected-filters', [...this.selected_filters]);
      },

      selected_searchers(value) {
        if (!this.selected_searchers.length) {
          this.selected_searchers = ['wiki'];
        }

        this.$emit('selected-searchers', [...this.selected_searchers]);
      },
    },
  };
</script>
