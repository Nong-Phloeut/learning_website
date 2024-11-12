import { defineStore } from 'pinia'
import {
  addFavorite,
  fetchFavorites,
  fetchFavoriteByUser
} from '../api/favorite'
export const useFavoriteStore = defineStore('favorite', {
  state: () => ({
    favorites: [],
    wishlist:[]
  }),
  actions: {
    async addFavorite(data) {
      const response = await addFavorite(data)
      return response
    },
    async getFavorites() {
      const response = await fetchFavorites()
      this.favorites = response.data
    },
    async getFavoriteByUser(id) {
      const response = await fetchFavoriteByUser(id)
      console.log(response.data.courses);
      this.wishlist = response.data.courses
    }
  }
})
