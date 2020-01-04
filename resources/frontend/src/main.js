import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import routes from './routes';

Vue.config.productionTip = false

Vue.use(VueRouter)
Vue.use(Vuex)

const router = new VueRouter({
  routes
})

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
