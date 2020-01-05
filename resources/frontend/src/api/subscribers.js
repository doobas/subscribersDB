export default {
  getList(page = 1) {
    return fetch(`/api/subscribers?page=${page}`)
      .then(response => response.json())
  },

  create() {

  },

  update() {

  },

  destroy(id) {
    return fetch(`/api/subscribers/${id}`, {
      method: 'DELETE'
    })
      .then(response => response.json())
  }
}