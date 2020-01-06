<template>
    <div>
        <div class="header">
            <router-link to="/subscribers/create" class="uk-button uk-button-primary uk-float-right">Add subscriber
            </router-link>
        </div>

        <div class="uk-label uk-label-warning uk-float-left" v-if="loading">Loading...</div>

        <div class="table_wrapper" v-if="subscribers.length">
            <table class="uk-table uk-table-hover uk-table-divider">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="subscriber in subscribers" :key="subscriber.id">
                    <td>{{ subscriber.id }}</td>
                    <td><a @click.prevent="showSubscriber(subscriber)">{{ subscriber.name }}</a></td>
                    <td>{{ subscriber.email }}</td>
                    <td>{{ subscriber.state }}</td>
                    <td>{{ subscriber.created_at }}</td>
                    <td>
                        <router-link :to="{ path: `/subscribers/edit/${subscriber.id}`}">
                            <vk-icons-file-edit/>
                        </router-link>
                        <span class="pointer" @click="destroy(subscriber.id)"><vk-icons-trash/></span>
                    </td>
                </tr>
                </tbody>
            </table>

            <vk-pagination align="center" :page.sync="selectedPage" :perPage="meta.per_page" :total="meta.total">
                <vk-pagination-page-prev></vk-pagination-page-prev>
                <vk-pagination-pages></vk-pagination-pages>
                <vk-pagination-page-next></vk-pagination-page-next>
            </vk-pagination>
        </div>

        <vk-modal :show.sync="showSubscriberModal" :subscriber="selectedSubscriber">
            <SubscriberModal :subscriber="selectedSubscriber" />
        </vk-modal>

    </div>
</template>

<script>
  import {mapState, mapActions, mapMutations} from 'vuex'
  import {IconFileEdit, IconTrash} from '@vuikit/icons'
  import SubscriberModal from './partials/SubscriberModal'

  export default {
    name: "SubscriberList",
    components: {
      VkIconsFileEdit: IconFileEdit,
      VkIconsTrash: IconTrash,
      SubscriberModal
    },
    data() {
      return {
        showSubscriberModal: false,
        selectedSubscriber: null,
      }
    },
    created() {
      this.fetchData()
    },
    watch: {
      '$route': 'fetchData',
      page: 'fetchData'
    },
    methods: {
      ...mapActions('subscribers', [
        'fetchData',
        'destroy',
      ]),
      ...mapMutations('subscribers', [
        'setPage',
        'setSubscribers'
      ]),
      showSubscriber(subscriber) {
        this.selectedSubscriber = subscriber
        this.showSubscriberModal = true
      }
    },
    computed: {
      ...mapState('subscribers', [
        'loading',
        'subscribers',
        'page',
        'meta',
      ]),
      selectedPage: {
        get() {
          return this.page;
        },
        set(page) {
          this.setPage(page)
        }
      }
    },
    destroyed() {
      this.setSubscribers({})
    }
  }
</script>

<style scoped>
    .uk-spinner {
        text-align: center;
        display: block;
    }

    .pointer {
        cursor: pointer;
    }
</style>