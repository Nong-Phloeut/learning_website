<!-- <template>
  <v-container>
    <custom-title icon="mdi-card-account-details">
      <strong>My Account</strong>
    
    </custom-title>

    <v-form>
      <v-layout class="rounded rounded-md px-0">
        <v-col cols="3" class="pa-0">
          <v-card class="rounded-lg pa-0">
           <template v-slot:append>
              <v-btn icon="" size="small">
                <v-file-input
                  accept="image/png, image/jpeg, image/bmp, image/webp"
                  label="Edit new profile"
                  placeholder="Pick an avatar"
                  prepend-icon="mdi-camera"
                  variant="outlined"
                  counter
                  show-size
                  chips
                  hide-details
                  density="compact"
                  hide-input=""
                  color="primary"
                ></v-file-input>
              </v-btn>
            </template>
            <v-card-text class="px-0 text-center">
              <v-col>
                <div>
                  <v-avatar
                    color="grey"
                    rounded="100"
                    size="282"
                    class="avatar elevation-1"
                  >
                   <v-img
                      :src="user.profile"
                      alt="John"
                    ></v-img> 
                  </v-avatar>
                </div>
              </v-col>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="9" class="pa-0 ms-1 mb-1">
          <v-card class="card pa-2 rounded-lg">
            <v-row>
              <v-col cols="12" md="6" lg="6">
                <v-text-field
                  density="compact"
                  :label="$t('common.firstName')"
                  variant="outlined"
                  prepend-inner-icon="mdi-card-account-details-outline"
                  readonly
                  color="textField"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6" lg="6">
                <v-text-field
                  color="textField"
                  density="compact"
                  :label="$t('common.lastName')"
                  variant="outlined"
                  readonly
                  prepend-inner-icon="mdi-card-account-details-outline"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="6" lg="6">
                <v-text-field
                  color="textField"
                  density="compact"
                  :label="$t('common.gender')"
                  variant="outlined"
                  readonly
                  prepend-inner-icon="mdi-gender-male-female"
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="6" lg="6">
                <v-date-input
                  color="textField"
                  density="compact"
                  :label="$t('common.dateOfBirth')"
                  variant="outlined"
                  readonly
                  prepend-icon=""
                  prepend-inner-icon="mdi-calendar-range"
                  hide-actions
                ></v-date-input>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="6" lg="6">
                <v-text-field
                  color="textField"
                  density="compact"
                  :label="$t('common.email')"
                  variant="outlined"
                  prepend-inner-icon="mdi-email"
                  readonly
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6" lg="6">
                <v-text-field
                  color="textField"
                  density="compact"
                  :label="$t('common.phoneNumer')"
                  variant="outlined"
                  readonly
                  prepend-inner-icon="mdi-phone"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="12" lg="12">
                <v-text-field
                  color="textField"
                  density="compact"
                  :label="$t('common.address')"
                  variant="outlined"
                  readonly
                  prepend-inner-icon="mdi-map-marker"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-layout>
    </v-form>
  </v-container>
</template>
 -->

<template>
  <v-container>
    <custom-title icon="mdi-card-account-details">
      <strong>My Account</strong>
    </custom-title>
    <v-layout>
      <v-col cols="12" md="3">
        <v-card class="pa-0" rounded="lg">
          <v-card-text class="px-1 text-center">
            <div>
              <v-avatar rounded="100" size="150" class="avatar elevation-1">
                <v-img
                  src="https://cdn-icons-png.flaticon.com/512/3276/3276535.png"
                  alt="John"
                ></v-img>
              </v-avatar>
            </div>
          </v-card-text>

          <!-- Sidebar Links -->
          <v-list dense>
            <v-list-item
              v-for="(item, index) in sidebarItems"
              :key="index"
              :to="item.path"
            >
              <template v-slot:prepend>
                <v-icon>{{ item.icon }}</v-icon>
              </template>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>

      <v-main class="pa-0">
        <v-container class="pa-0" fluid>
          <router-view />
        </v-container>
      </v-main>
    </v-layout>
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
          { title: 'How To Spend', icon: 'mdi-credit-card' }
        ]
      }
    },
    methods: {}
  }
</script>
