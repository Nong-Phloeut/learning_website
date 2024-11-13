<template>
  <v-container class="pa-0">
    <custom-title icon="mdi-card-account-details">
      <strong>My Account</strong>
    </custom-title>
    <v-row class="mt-4">
      <v-toolbar elevation="2" rounded="lg">
        <v-col cols="12" class="text-center">
          <v-btn
            variant="text"
            v-for="item in sidebarItems"
            :key="item"
            :to="item.path"
            width="190"
          >
            {{ item.title }}
          </v-btn>
        </v-col>
      </v-toolbar>
      <v-main class="pa-0">
        <v-container class="pa-0" fluid>
          <router-view />
        </v-container>
      </v-main>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    name: 'UserProfile',
    data() {
      return {
        sidebarItems: [
          { title: 'My Profile', icon: 'mdi-account', path: 'profile' },
          { title: 'My Orders', icon: 'mdi-cart' },
          { title: 'My Wishlist', icon: 'mdi-heart', path: 'wishlist' },
          { title: 'My Credits', icon: 'mdi-cash', value: '$440' },
          { title: 'My Cart', icon: 'mdi-cash', path: 'my-cart' },
          { title: 'How To Spend', icon: 'mdi-credit-card' }
        ]
      }
    },
    methods: {}
  }
</script>
