import Vue from 'vue';
import './plugins/axios';
import App from './App.vue';
import './registerServiceWorker';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import './assets/index.scss';
import 'viewerjs/dist/viewer.css';
import VueViewer from 'v-viewer';

Vue.use(VueViewer);

VueViewer.setDefaults({
  inline: false,
  button: true,
  navbar: false,
  title: false,
  toolbar: false,
  tooltip: false,
  movable: true,
  zoomable: true,
  rotatable: false,
  scalable: true,
  transition: true,
  fullscreen: true,
  keyboard: true,
});

Vue.config.productionTip = false;

if (!String.prototype.splice) {

  /**
   * The splice() method changes the content of a string by removing a range of
   * characters and/or adding new characters.
   *
   * @this {String}
   * @param {number} start Index at which to start changing the string.
   * @param {number} delete_count An integer indicating the number of old chars to remove.
   * @param {string} import_string The String that is spliced in.
   * @return {string} A new string with the spliced substring.
   */
  // eslint-disable-next-line no-extend-native
  String.prototype.splice = function(start, delete_count, import_string) {
    return this.slice(0, start) + import_string + this.slice(start + Math.abs(delete_count));
  };
}

/**
 * @param {function} callback
 */
function hidePreloadContainer(callback = () => {
}) {
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
