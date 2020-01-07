export default {
  field(data) {
    return {
      title: data.title,
      type: data.type,
    }
  },

  subscriber(data, field_values) {
    let fields = {};
    Object.keys(field_values).forEach(function (title) {
      fields[title] = {
        title: title,
        value: field_values[title],
      }
    });
    return {
      name: data.name,
      email: data.email,
      fields
    }
  }
}