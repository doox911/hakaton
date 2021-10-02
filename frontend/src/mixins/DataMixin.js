export default {
  methods: {
    goToResource(url) {
      window.open(url, '_blank');
    },

    getSourceName(type) {
      const rt = {
        'app\\classes\\duckduckgoarticlesearch': 'DuckDuckGo',
        'app\\classes\\imageswikisearch': 'Википедия(Изоб.)',
        'app\\classes\\ramblersearch': 'Рамблер',
        'app\\classes\\wikisearch': 'Википедия',
        'app\\classes\\yandexsearch': 'Яндекс',
        'app\\classes\\RuTubeSearch': 'Rutube',
      };

      return rt[type];
    },
  },
};
