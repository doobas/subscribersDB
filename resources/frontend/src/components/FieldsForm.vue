<template>
    <div class="uk-label uk-label-warning uk-float-left" v-if="loading">Loading...</div>

    <div v-else class="form-container">
        <form class="uk-form-stacked" @submit.prevent="submit">

            <div class="uk-margin">
                <label class="uk-form-label" for="title">Title</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="title" id="title" v-model="field.title" type="text"
                           :class="{'uk-form-danger':formErrors.title}"
                    >
                </div>
            </div>

            <div class="uk-margin" v-if="this.$route.name !== 'editField'">
                <label class="uk-form-label" for="type">Type</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="type" name="type" v-model="field.type"
                            :class="{'uk-form-danger':formErrors.type}">
                        <option v-for="(type, key) in types" :key="key">{{ type }}</option>
                    </select>
                </div>
            </div>

            <button class="uk-button uk-button-secondary">Submit</button>

        </form>
    </div>
</template>

<script>
  import {mapState, mapActions, mapMutations} from 'vuex'

  export default {
    name: "FieldsForm",
    computed: {
      ...mapState('fields', [
        'loading',
        'field',
        'types',
        'formErrors',
      ]),
      fieldId: function () {
        return this.$route.name === 'editField' ? this.$route.params.id : null
      }
    },
    methods: {
      ...mapActions('fields', [
        'fetchFieldData',
        'create',
        'update',
      ]),
      ...mapMutations('fields', [
        'setField'
      ]),
      async submit() {
        let response = false;
        if (this.$route.name === 'editField') {
          response = await this.update();
        } else {
          response = await this.create();
        }

        if (response) {
          this.$router.push('/fields')
        }
      },
    },
    async created() {
      await this.fetchFieldData(this.fieldId)
    },
    destroyed() {
      this.setField({})
    }
  }
</script>

<style scoped>

</style>