import { defineStore } from 'pinia'

import { register, login, logout, fetchUser } from '@/api/auth.js' // get form auth

export const useAuthStore = defineStore('auth', {
  state: () => ({
    authUser: [],
    isAuthenticated: false
  }),
  // getters: {
  //   isAuthenticated: state => !!state.authToken
  // },
  actions: {
    async userLogin(data) {
      const response = await login(data)
      console.log(response)
      if (response.data.token) {
        this.isAuthenticated = true
        localStorage.setItem('authToken', response.data.token) // Store token in localStorage
      }
      // this.authUser = response.data
      return response
    },
    async userRegister(data) {
      const response = await register(data)
      if (response.token) {
        this.isAuthenticated = true
        localStorage.setItem('authToken', response.token) // Store token in localStorage
      }
      return response
    },
    async logout() {
      const response = await logout()
      // localStorage.removeItem('authToken')
      // this.isAuthenticated = false
      return response
    },
    // async changePassword(data) {
    //   return await changeNewPassword(data)
    // },
    async getUser() {
      const response = await fetchUser()
      this.authUser = response.data
    }
  }
})
