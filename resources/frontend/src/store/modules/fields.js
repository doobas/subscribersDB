import fieldsApi from '../../api/fields'
import normalizer from '../../normalizer'

const state = {
  loading: false,
  fields: [],
  field: {},
  types: [],
  formErrors: [],
}

// getters
const getters = {}

// actions
const actions = {

  async fetchData({commit}) {
    commit('setLoading', true)
    const fields = await fieldsApi.getList()
    commit('setFields', fields.data)
    commit('setLoading', false)
  },

  async fetchFieldData({commit}, fieldId) {
    commit('setLoading', true)
    const types = await fieldsApi.getTypes()
    commit('setTypes', types)
    if (fieldId) {
      const field = await fieldsApi.show(fieldId);
      commit('setField', field.data)
    }
    commit('setLoading', false)
  },

  async destroy({commit, dispatch}, fieldId) {
    if (!confirm('Are you sure ?')) {
      return;
    }
    commit('setLoading', true)
    await fieldsApi.destroy(fieldId)
    await dispatch('fetchData');
    commit('setLoading', false)
  },

  async create({commit, state}) {
    commit('setFormErrors', {})
    const response = await fieldsApi.create(normalizer.field(state.field))
    if (response.errors) {
      commit('setFormErrors', response.errors)
      return false
    }
    return true;
  },

  async update({state, commit}) {
    commit('setFormErrors', {})
    const response = await fieldsApi.update(state.field.id, normalizer.field(state.field))
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

  setFields(state, fields) {
    state.fields = fields
  },

  setField(state, field) {
    state.field = field
  },

  setTypes(state, types) {
    state.types = types
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