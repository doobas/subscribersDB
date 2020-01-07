<template>
    <div class="uk-label uk-label-warning uk-float-left" v-if="loading">Loading...</div>

    <div v-else class="form-container">
        <form class="uk-form-stacked" @submit.prevent="submit">

            <div class="uk-margin">
                <label class="uk-form-label" for="name">Name</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="name" id="name" v-model="subscriber.name" type="text"
                           :class="{'uk-form-danger':formErrors.name}"
                    >
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="email">Email</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="email" id="email" v-model="subscriber.email" type="text"
                           :class="{'uk-form-danger':formErrors.email}"
                    >
                </div>
            </div>

            <div class="uk-margin" v-for="field in fields" :key="field.id">
                <div v-if="field.type === 'string'">
                    <label class="uk-form-label">{{ field.title }}</label>
                    <div class="uk-form-controls">
                        <input
                                class="uk-input"
                                :name="`field_values.${field.title}`"
                                v-model="field_values[field.title]"
                                type="text"
                                :class="{'uk-form-danger':formErrors[`fields.${field.title}.value`]}"
                        />
                    </div>
                </div>
                <div v-else-if="field.type === 'number'">
                    <label class="uk-form-label">{{ field.title }}</label>
                    <div class="uk-form-controls">
                        <input
                                class="uk-input"
                                :name="`field_values.${field.title}`"
                                v-model="field_values[field.title]"
                                type="number"
                                :class="{'uk-form-danger':formErrors[`fields.${field.title}.value`]}"
                        />
                    </div>
                </div>
                <div v-else-if="field.type === 'boolean'">
                    <label>
                        <input
                                class="uk-checkbox"
                                type="checkbox"
                                :name="`field_values.${field.title}`"
                                v-model="field_values[field.title]"
                        > <span :class="{'uk-text-danger':formErrors[`fields.${field.title}.value`]}">{{ field.title }}</span>
                    </label>
                </div>
                <div v-else-if="field.type === 'date'">
                    <label class="uk-form-label">{{ field.title }}</label>
                    <div class="uk-form-controls">
                        <input
                                class="uk-input"
                                :name="`field_values.${field.title}`"
                                v-model="field_values[field.title]"
                                type="tel"
                                :class="{'uk-form-danger':formErrors[`fields.${field.title}.value`]}"
                                placeholder="yyyy-mm-dd"
                                v-mask="'####-##-##'"
                        />
                    </div>
                </div>
            </div>

            <button class="uk-button uk-button-secondary">Submit</button>

        </form>
    </div>
</template>

<script>
  import {mapState, mapActions, mapMutations} from 'vuex'
  import {mask} from 'vue-the-mask'

  export default {
    name: "SubscriberForm",
    directives: {
      mask
    },
    data() {
      return {
        field_values: {}
      }
    },
    computed: {
      ...mapState('subscribers', [
        'loading',
        'subscriber',
        'types',
        'formErrors',
      ]),
      ...mapState('fields', [
        'fields',
      ]),
      subscriberId: function () {
        return this.$route.name === 'editSubscriber' ? this.$route.params.id : null
      }
    },
    methods: {
      ...mapActions('subscribers', [
        'fetchSubscriberData',
        'create',
        'update',
      ]),
      ...mapMutations('subscribers', [
        'setSubscriber'
      ]),
      async submit() {
        let response = false;
        if (this.$route.name === 'editSubscriber') {
          response = await this.update(this.field_values);
        } else {
          response = await this.create(this.field_values);
        }

        if (response) {
          this.$router.push('/subscribers')
        }
      },
      updateFieldValues() {
        if(Object.entries(this.subscriber).length !== 0) {
          this.subscriber.fields.forEach((field) => {
            let value = field.value
            if (field.type === 'boolean') {
              value = JSON.parse(field.value)
            }
            this.field_values[field.title] = value
          })
        }
      },
    },
    async created() {
      await this.fetchSubscriberData(this.subscriberId)
    },
    destroyed() {
      this.setSubscriber({})
    },
    watch: {
      'subscriber': 'updateFieldValues'
    }
  }
</script>

<style scoped>

</style>