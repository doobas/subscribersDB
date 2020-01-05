import Vue from 'vue'
import Vuex from 'vuex'
import subscribers from './modules/subscribers'
import fields from './modules/fields'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    subscribers,
    fields
  }
})