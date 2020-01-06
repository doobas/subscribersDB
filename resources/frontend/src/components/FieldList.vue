<template>
    <div>
        <div class="header">
            <router-link to="/fields/create" class="uk-button uk-button-primary uk-float-right">Add field</router-link>
        </div>

        <div class="uk-label uk-label-warning uk-float-left" v-if="loading">Loading...</div>

        <div class="table_wrapper" v-if="fields.length">
            <table class="uk-table uk-table-hover uk-table-divider">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="field in fields" :key="field.id">
                    <td>{{ field.id }}</td>
                    <td>{{ field.title }}</td>
                    <td>{{ field.type }}</td>
                    <td>{{ field.created_at }}</td>
                    <td>
                        <router-link :to="{ path: `/fields/edit/${field.id}`}">
                            <vk-icons-file-edit/>
                        </router-link>
                        <span class="pointer" @click="destroy(field.id)"><vk-icons-trash/></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


    </div>
</template>

<script>
  import {mapState, mapActions, mapMutations} from 'vuex'
  import {IconFileEdit, IconTrash} from '@vuikit/icons'

  export default {
    name: "FieldList",
    components: {
      VkIconsFileEdit: IconFileEdit,
      VkIconsTrash: IconTrash,
    },
    created() {
      this.fetchData()
    },
    watch: {
      '$route': 'fetchData',
    },
    methods: {
      ...mapActions('fields', [
        'fetchData',
        'destroy',
      ]),
      ...mapMutations('fields', [
        'setFields'
      ])
    },
    computed: {
      ...mapState('fields', [
        'loading',
        'fields',
      ])
    },
    destroyed() {
      this.setFields({})
    }
  }
</script>

<style scoped>
    .pointer {
        cursor: pointer;
    }
</style>