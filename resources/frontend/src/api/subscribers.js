export default {
  getList(page = 1) {
    return fetch(`/api/subscribers?page=${page}`)
      .then(response => response.json())
  },

  show(id) {
    return fetch(`/api/subscribers/${id}`)
      .then(response => response.json())
  },

  create(formData) {
    return fetch(`/api/subscribers`, {
      method: 'POST',
      body: JSON.stringify(formData),
      headers: {
        'Content-Type': 'application/json'
      },
    })
      .then(response => response.json())
  },

  update(id, formData) {
    return fetch(`/api/subscribers/${id}`, {
      method: 'PUT',
      body: JSON.stringify(formData),
      headers: {
        'Content-Type': 'application/json'
      },
    })
      .then(response => response.json())
  },

  destroy(id) {
    return fetch(`/api/subscribers/${id}`, {
      method: 'DELETE'
    })
      .then(response => response.json())
  }
}