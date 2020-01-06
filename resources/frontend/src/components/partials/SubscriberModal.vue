<template>
    <div>
        <vk-modal-title>{{ subscriber.name }}</vk-modal-title>

        <div class="uk-grid uk-child-width-1-2@m uk-grid">
            <div>
                <div class="uk-text-bold">Email</div>
                <div>{{ subscriber.email }}</div>
            </div>
            <div>
                <div class="uk-text-bold">State</div>
                <div>{{ subscriber.state }}</div>
            </div>
        </div>

        <hr class="uk-divider-icon">

        <div class="uk-grid uk-child-width-1-2@m" uk-grid>
            <div class="uk-margin-bottom" v-for="field in subscriber.fields" :key="field.title">
                <div class="uk-text-bold">{{ field.title }} <small>{{ field.type }}</small></div>
                <div>{{ field.value }}</div>
            </div>
        </div>

    </div>
</template>

<script>
  export default {
    name: "SubscriberModal",
    props: [
      'subscriber'
    ],
  }
</script>

<style scoped>

</style>