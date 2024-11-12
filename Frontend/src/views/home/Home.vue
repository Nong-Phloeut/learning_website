<template>
  <v-container class="pa-0">
    <v-row class="py-0 mt-4">
      <div class="card">
        <v-col cols="12" md="6">
          <h1 class="display-4 font-weight-bold">
            Education is the best way to
            <span class="text-orange">Grow up Knowledge</span>
          </h1>
          <p class="mt-4 mb-4">
            High-quality online courses to help you improve your skills and
            knowledge.
          </p>
          <v-btn color="orange" class="mr-4">Try Now</v-btn>
          <v-btn variant="outlined">Play Video</v-btn>
        </v-col>
      </div>
      <v-col cols="12" md="4">
        <v-img src="./assets/banner1.png" alt="Hero Image" contain></v-img>
      </v-col>
    </v-row>

    <course-card />

    <h2 class="mt-12">Our Popular Courses</h2>
    <p>
      Discover the latest, most effective way to gain job-ready expertise for
      the careers of the future.
    </p>
    <v-row class="mt-4">
      <v-col cols="12" md="3" v-for="course in courses" :key="course.title">
        <v-card class="pa-2">
          <v-img :src="course.image" height="200"></v-img>
          <v-card-title>{{ course.title }}</v-card-title>
          <v-card-subtitle>{{ course.description }}</v-card-subtitle>
          <v-card-actions>
            <v-spacer></v-spacer>

            <!-- :color="isFavorite(course.id) ? 'red' : 'medium-emphasis'"
          :icon="isFavorite(course.id) ? 'mdi-heart' : 'mdi-heart-outline'" -->
            <v-btn
              size="small"
              icon="mdi-heart-outline"
              ></v-btn>
              <!-- @click="toggleFavorite(course.id)" -->

            <v-btn
              color="medium-emphasis"
              icon="mdi-cart-outline"
              size="small"
            ></v-btn>
            <v-btn
              color="medium-emphasis"
              class="bg-primary"
              size="small"
              >
              <!-- @click="handleBuyNowClick(course)" -->
              Buy now
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

    <!-- Mobile App Download Section -->
    <v-row class="my-12 align-center">
      <v-col cols="12" md="6">
        <v-img
          src="https://www.pngall.com/wp-content/uploads/5/Education-Learning-Transparent.png"
          height="400"
        ></v-img>
      </v-col>
      <v-col cols="12" md="6">
        <h2>Ready to Get Information from us</h2>
        <p>
          Join and get unlimited access to different products that can be found
          at affordable prices and that are productive in every way.
        </p>
        <v-row class="py-8 px-3">
          <v-btn color="black" variant="outlined" class="mr-4">
            <v-icon left>mdi-apple</v-icon>
            App Store
          </v-btn>
          <v-btn color="black" variant="outlined">
            <v-icon left>mdi-google-play</v-icon>
            Google Play
          </v-btn>
        </v-row>
      </v-col>
    </v-row>

    <!-- Footer -->
    <v-footer color="grey lighten-3" class="pa-6">
      <v-row>
        <v-col cols="12" md="4">
          <h3>About</h3>
          <p>Some information about the company and its mission.</p>
        </v-col>
        <v-col cols="12" md="4">
          <h3>Help and Solutions</h3>
          <p>Links to help center, FAQs, and more.</p>
        </v-col>
        <v-col cols="12" md="4">
          <h3>Support</h3>
          <p>Contact information and support resources.</p>
        </v-col>
      </v-row>
    </v-footer>
  </v-container>
</template>

<script setup>
  import CourseCard from '../../components/course/CourseCard.vue'

  const courses = [
    {
      title: 'Graphic Design Course',
      description: '80 Lessons',
      image: 'path/to/graphic.jpg',
      rating: 4.7,
      lessons: '80'
    },
    {
      title: 'Web Development Course',
      description: '90 Lessons',
      image: 'path/to/web.jpg',
      rating: 4.5,
      lessons: '90'
    },
    {
      title: 'Machine Learning Intro',
      description: '50 Lessons',
      image: 'path/to/ml.jpg',
      rating: 4.3,
      lessons: '50'
    }
  ]
</script>

<style scoped>
  .text-orange {
    color: #ff9800;
  }
  .card {
    display: flex;
    justify-content: center;
    align-items: center;
    /* background: #8a5555; */
  }
</style>
