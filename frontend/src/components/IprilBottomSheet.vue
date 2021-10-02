<template>
  <v-bottom-sheet
    :value="value"
    @input="$emit('input', $event)"
  >
    <v-sheet
      class="text-center"
    >
      <v-container>
        <v-row>
          <v-col>

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

      selected_filters: [],
      selected_searchers: [],
    }),
  };
</script>
