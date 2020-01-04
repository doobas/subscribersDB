<template>
    <vk-navbar>
        <vk-navbar-nav slot="right">
            <vk-navbar-item active>
                <router-link to="/subscribers" exact>Subscribers</router-link>
            </vk-navbar-item>
            <vk-navbar-item>
                <router-link to="/fields" exact>Fields</router-link>
            </vk-navbar-item>
        </vk-navbar-nav>
    </vk-navbar>
</template>

<script>
  import{ Navbar, NavbarNav, NavbarItem } from 'vuikit/lib/navbar'

  export default {
    name: "NavBar",
    components: {
      VkNavbar: Navbar,
      VkNavbarNav: NavbarNav,
      VkNavbarItem: NavbarItem,
    },
  }
</script>

<style scoped>
    a {
        text-decoration: none;
        color: #2c3e50;
    }
    a:hover {
        text-decoration: underline;
        color: #4a3750;
    }
    a.router-link-active {
        font-weight: bold;
    }
</style>