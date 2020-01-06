export default {
  getList() {
    return fetch(`/api/fields`)
      .then(response => response.json())
  },

  show(id) {
    return fetch(`/api/fields/${id}`)
      .then(response => response.json())
  },

  create(formData) {
    console.log('formData', formData);
    return fetch(`/api/fields`, {
      method: 'POST',
      body: JSON.stringify(formData),
      headers: {
        'Content-Type': 'application/json'
      },
    })
      .then(response => response.json())
  },

  update(id, formData) {
    return fetch(`/api/fields/${id}`, {
      method: 'PUT',
      body: JSON.stringify(formData),
      headers: {
        'Content-Type': 'application/json'
      },
    })
      .then(response => response.json())
  },

  destroy(id) {
    return fetch(`/api/fields/${id}`, {
      method: 'DELETE'
    })
      .then(response => response.json())
  },

  getTypes() {
    return fetch(`/api/fields-types`)
      .then(response => response.json())
  }
}