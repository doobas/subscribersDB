import subscribersApi from '../../api/subscribers'

const state = {
  loading: false,
  page: 1,
  subscribers: [],
  meta: [],
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

  async destroy({commit, dispatch, state}, subscriberId) {
    if (!confirm('Are you sure ?')) {
      return;
    }
    commit('setLoading', true)
    await subscribersApi.destroy(subscriberId)
    await dispatch('fetchData')
    commit('setLoading', false)
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

  setMeta(state, meta) {
    state.meta = meta
  },

  setPage(state, page) {
    state.page = page
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}