<template>
  <v-container>
    <v-row
      align="center"
      justify="center"
    >
      <v-col
        cols="12"
        sm="8"
      >
        <v-text-field
          :value="value"
          :disabled="loading"
          class="elevation-24 pa-5 press-start-2p-font font-size-14"
          rounded
          placeholder="Давай попробуем. Вводи запрос..."
          hide-details
          @input="$emit('input', $event)"
          @keyup.enter="$emit('click', true)"
        />
      </v-col>
      <v-col cols="auto">
        <v-btn
          class="elevation-24 pa-9"
          :disabled="loading"
          icon
          rounded
          color="#81D4FA"
          @click="$emit('filters', true)"
        >
          <v-icon
            large
          >
            mdi-filter-outline
          </v-icon>
        </v-btn>
      </v-col>
      <v-col cols="auto">
        <v-btn
          :disabled="!value.length || loading"
          color="white"
          class="elevation-24 pa-9 press-start-2p-font"
          style="color: #81D4FA"
          rounded
          @click="$emit('click', true)"
          v-text="`Поиск`"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    name: 'IprilSearch',

    props: {
      value: {
        default: '',
        type: String,
      },
      loading: {
        default: false,
        type: Boolean,
      },
    },

    data: () => ({}),
  };
</script>
