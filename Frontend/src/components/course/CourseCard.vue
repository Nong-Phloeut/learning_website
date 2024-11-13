<template>
  <course-filter @filter-changed="applyFilter" />
  <custom-title icon="mdi-book">Academic Courses</custom-title>
  <v-row v-if="courses.length != 0">
    <v-col cols="12" md="3" v-for="course in courses" :key="course.name">
      <!-- <v-skeleton-loader
        :loading="loading"
        type="image, list-item-two-line"
      > -->
      <v-card>
        <v-img
          :src="course.image"
          class="align-end"
          gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
          height="200px"
          cover
        >
          <v-card-title class="text-white" v-text="course.title"></v-card-title>
        </v-img>
        <v-card-text>
          <v-row align="center" class="mx-0">
            <v-rating
              :model-value="4.5"
              color="amber"
              density="compact"
              size="small"
              half-increments
              readonly
            ></v-rating>

            <div class="text-grey ms-4">4.5 (413)</div>
          </v-row>

          <div class="my-4 text-subtitle-1">$ {{ course.price }}</div>
        </v-card-text>
        {{ isFavorite(course.id) }}
        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            size="small"
            :color="isFavorite(course.id) ? 'red' : 'medium-emphasis'"
            :icon="isFavorite(course.id) ? 'mdi-heart' : 'mdi-heart-outline'"
            @click="toggleFavorite(course.id)"
          ></v-btn>

          <!-- color="medium-emphasis"
          icon="mdi-cart-outline" -->
          <v-btn
            :color="isAddToCart(course.id) ? 'red' : 'medium-emphasis'"
            :icon="isAddToCart(course.id) ? 'mdi-cart' : 'mdi-cart-outline'"
            size="small"
            @click="toggleAddToCart(course.id)"
          ></v-btn>
          <v-btn
            color="medium-emphasis"
            class="bg-primary"
            size="small"
            @click="handleBuyNowClick(course)"
          >
            Buy now
          </v-btn>
        </v-card-actions>
      </v-card>
      <!-- </v-skeleton-loader> -->
    </v-col>
  </v-row>
  <v-row v-else>
    <v-col v-for="i in 4">
      <v-skeleton-loader
        :loading="loading"
        class="mx-auto"
        elevation="2"
        max-width="390"
        type="card,list-item-two-line, actions"
        boilerplate
      ></v-skeleton-loader>
    </v-col>
  </v-row>
  {{ wishlist }}
  <!-- Use the CheckoutDialog component -->
  <checkout-dialog
    :dialog="checkoutDialog"
    :courseName="selectedCourse?.name"
    @close="closeCheckoutDialog"
    @payment-success="handlePaymentSuccess"
  />
  <!-- <PaymentStepper></PaymentStepper> -->
  <register-dialog v-if="showLoginDialog" @close="showLoginDialog = false" />
</template>
<script>
  import CourseFilter from '../filters/CourseFilter.vue'
  import { mapActions, mapState } from 'pinia'
  import { useCourseStore } from '../../stores/course'
  import { useFavoriteStore } from '../../stores/favorite'
  import CheckoutDialog from '../payment/CheckoutDialog.vue'
  import RegisterDialog from '../auth/RegisterDialog.vue'
  import { useCartStore } from '../../stores/cart'
  // import PaymentStepper from '../payment/PaymentStepper.vue'

  export default {
    components: {
      CourseFilter,
      CheckoutDialog,
      RegisterDialog
      // PaymentStepper
    },
    data() {
      return {
        form: {
          // user_id: 1,
          course_id: ''
        },
        checkoutDialog: false,
        selectedCourse: null,
        showLoginDialog: false,
        loading: false
      }
    },
    created() {
      this.getCourses({})
      const token = localStorage.getItem('authToken')
      if (token) {
        this.getFavoriteByUser()
        this.getCarts()
      }
    },
    computed: {
      ...mapState(useCourseStore, ['courses']),
      ...mapState(useFavoriteStore, ['wishlist']),
      ...mapState(useCartStore, ['carts']),
      isFavorite() {
        return courseId => {
          return this.wishlist && this.wishlist.some(fav => fav.id === courseId)
        }
      },
      isAddToCart() {
        return courseId => {
          return (
            this.carts && this.carts.some(cart => cart.id === courseId)
          )
        }
      }
    },
    methods: {
      ...mapActions(useCourseStore, ['getCourses']),
      ...mapActions(useFavoriteStore, [
        'addFavorite',
        'getFavoriteByUser',
        'removeFavorite'
      ]),
      ...mapActions(useCartStore, ['addCart', 'getCarts']),
      async toggleFavorite(courseId) {
        // Check if the course is already in the wishlist
        const isFav = this.isFavorite(courseId)
        if (isFav) {
          // If it is in favorites, remove it
          await this.removeFavorite(courseId)
            .then(() => {
              this.$root.$notif('Favorite removed successfully', {
                type: 'success',
                color: 'primary'
              })
            })
            .catch(error => {
              console.log(error)
              this.$root.$notif(error.message || error, {
                type: 'error',
                color: 'error'
              })
            })
        } else {
          // If it is not in favorites, add it
          this.form.course_id = courseId
          await this.addFavorite(this.form)
            .then(() => {
              this.$root.$notif('Favorite added successfully', {
                type: 'success',
                color: 'primary'
              })
            })
            .catch(error => {
              this.$root.$notif(error.message || error, {
                type: 'error',
                color: 'error'
              })
            })
        }

        await this.getFavoriteByUser()
      },

      async toggleAddToCart(courseId) {
        this.form.course_id = courseId
        await this.addCart(this.form)
          .then(() => {
            this.$root.$notif('Cart added successfully', {
              type: 'success',
              color: 'primary'
            })
          })
          .catch(error => {
            // console.log(error.response.data.error);
            this.$root.$notif(error.response.data.error || error, {
              type: 'error',
              color: 'error'
            })
          })

        this.getCarts()
      },

      openCheckoutDialog(course) {
        this.selectedCourse = course
        this.checkoutDialog = true
      },
      handleBuyNowClick(course) {
        if (localStorage.getItem('authToken')) {
          // If authToken exists, proceed with checkout
          this.openCheckoutDialog(course)
        } else {
          // If authToken is missing, prompt login/register
          this.showLoginDialog = true
        }
      },
      closeCheckoutDialog() {
        this.checkoutDialog = false
        this.selectedCourse = null
      },
      handlePaymentSuccess() {
        this.closeCheckoutDialog()
      },

      applyFilter(filter) {
        this.getCourses(filter)
      }
    },

    filters: {
      currency(value) {
        return `$${value.toFixed(2)}`
      }
    }
  }
</script>
