<template>
  <v-container fluid>
    <!-- <custom-title icon="mdi-heart">My Wishlist</custom-title> -->
    <v-row>
      <v-col
        v-for="(course, index) in wishlist"
        :key="course.id"
        cols="12"
        sm="6"
        md="4"
      >
        <v-card>
          <!-- Course Image -->
          <v-img :src="course.image" height="200px" cover></v-img>

          <!-- Course Info -->
          <v-card-title>{{ course.title }}</v-card-title>
          <!-- <v-card-subtitle>{{ course.category }}</v-card-subtitle> -->
          <v-card-text>
            <p class="text-h6">${{ course.price }}</p>
          </v-card-text>

          <!-- Action Buttons -->
          <v-card-actions>
            <v-btn color="primary" @click="viewDetails(course.id)">
              View Details
            </v-btn>
            <v-btn color="error" @click="removeFromWishlist(index)">
              Remove
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

    <v-alert v-if="wishlist.length === 0" type="info" class="mt-6">
      Your wishlist is empty. Start adding your favorite courses!
    </v-alert>
  </v-container>
</template>

<script>
  import { mapActions, mapState } from 'pinia'
  import { useFavoriteStore } from '../../stores/favorite'
  export default {
    name: 'WishlistPage',
    data() {
      return {}
    },
    computed: {
      ...mapState(useFavoriteStore, ['wishlist'])
    },
    methods: {
      ...mapActions(useFavoriteStore, ['getFavoriteByUser'])
    },
    created() {
      this.getFavoriteByUser(1)
    }
  }
</script>

<style scoped>
  .v-container {
    max-width: 1200px;
    margin: auto;
  }
</style>
