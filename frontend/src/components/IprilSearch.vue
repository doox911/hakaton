<template>
  <v-container>
    <v-row
      align="center"
      justify="center"
    >
      <v-col>
        <v-text-field
          :value="value"
          class="elevation-24 pa-5 press-start-2p-font font-size-14"
          rounded
          placeholder="Давай попробуем. Вводи запрос..."
          hide-details
          @input="$emit('input', $event)"
        />
      </v-col>
      <v-col cols="auto">
        <v-btn
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
    },

    data: () => ({}),
  };
</script>
