import subscribersApi from '../../api/subscribers'
import fieldsApi from "../../api/fields";
import normalizer from "../../normalizer";

const state = {
  loading: false,
  page: 1,
  subscribers: [],
  meta: [],
  subscriber: {},
  formErrors: []
}

// getters
const getters = {}

// actions
const actions = {
  async fetchData({commit, state}) {
    commit('setLoading', true)
    const subscribers = await subscribersApi.getList(state.page)
    commit('setSubscribers', subscribers.data)
    commit('setMeta', subscribers.meta)
    commit('setLoading', false)
  },

  async fetchSubscriberData({commit, dispatch}, subscriberId) {
    commit('setLoading', true)
    await dispatch('fields/fetchData', {}, { root: true });
    if (subscriberId) {
      const subscribers = await subscribersApi.show(subscriberId);
      commit('setSubscriber', subscribers.data)
    }
    commit('setLoading', false)
  },

  async destroy({commit, dispatch, state}, subscriberId) {
    if (!confirm('Are you sure ?')) {
      return;
    }
    commit('setLoading', true)
    await subscribersApi.destroy(subscriberId)
    await dispatch('fetchData')
    commit('setLoading', false)
  },

  async create({commit, state}, field_values) {
    commit('setFormErrors', {})
    const response = await subscribersApi.create(normalizer.subscriber(state.subscriber, field_values))
    if (response.errors) {
      commit('setFormErrors', response.errors)
      return false
    }
    return true;
  },

  async update({state, commit}, field_values) {
    commit('setFormErrors', {})
    const response = await subscribersApi.update(state.subscriber.id, normalizer.subscriber(state.subscriber, field_values))
    if (response.errors) {
      commit('setFormErrors', response.errors)
      return false
    }
    return true;
  }
}

// mutations
const mutations = {
  setLoading(state, loading) {
    state.loading = loading
  },

  setSubscribers(state, subscribers) {
    state.subscribers = subscribers
  },

  setSubscriber(state, subscriber) {
    state.subscriber = subscriber
  },

  setMeta(state, meta) {
    state.meta = meta
  },

  setPage(state, page) {
    state.page = page
  },

  setFormErrors(state, formErrors) {
    state.formErrors = formErrors
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}