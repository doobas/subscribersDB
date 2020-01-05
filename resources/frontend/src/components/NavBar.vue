<template>
    <nav class="uk-navbar-container" uk-navbar>

        <div class="uk-navbar-right">

            <ul class="uk-navbar-nav">
                <li>
                    <router-link to="/subscribers">Subscribers</router-link>
                </li>
                <li>
                    <router-link to="/fields">Fields</router-link>
                </li>
            </ul>

        </div>

    </nav>
</template>

<script>

  export default {
    name: "NavBar",
  }
</script>

<style scoped>
    a.router-link-active {
        font-weight: bold;
    }
</style>