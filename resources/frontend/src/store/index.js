import Vue from 'vue'
import Vuex from 'vuex'
import subscribers from './modules/subscribers'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    subscribers
  }
})