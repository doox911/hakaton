import Vue from 'vue';
import './plugins/axios';
import App from './App.vue';
import './registerServiceWorker';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import './assets/index.scss';

Vue.config.productionTip = false;

/**
 * @param {function} callback
 */
function hidePreloadContainer(callback = () => {}) {
  const element = document.querySelector('.ipril-container');

  setTimeout(() => {
    element.classList.add('hide');

    setTimeout(() => {
      element.remove();

      callback();
    }, 1000);
  }, 3000);
}

hidePreloadContainer(() => {
  new Vue({
    router,
    store,
    vuetify,
    render: h => h(App),
  }).$mount('#app');
});
