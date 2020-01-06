<template>
    <div id="app">
        <NavBar/>
        <div class="uk-container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
  import NavBar from './components/NavBar'

  export default {
    name: 'app',
    components: {
      NavBar
    }
  }
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        color: #2c3e50;
        background-color: #eee;
        min-height: 100vh;
    }

    .uk-container {
        padding-top: 20px;
    }
</style>
