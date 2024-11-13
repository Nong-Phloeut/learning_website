<template>
  <v-container class="py-5" max-width="400px">
    <v-card class="pa-4">
      <!-- Credit Score Header -->
      <v-card-title>
        Credit Report
      </v-card-title>

      <!-- Credit Score Bar -->
      <v-row class="my-4" align="center">
        <v-col cols="12">
          <v-progress-linear
            :value="score"
            height="16"
            rounded
            color="success"
            class="rounded-pill"
          >
            <template #default>
              <v-row no-gutters align="center">
                <v-col class="d-flex justify-center" cols="12">
                  <span class="text-body-1 text-white">{{ score }}</span>
                </v-col>
              </v-row>
            </template>
          </v-progress-linear>
        </v-col>

        <!-- Score Range Labels -->
        <v-col class="text-left text-body-2">
          <span class="text-red">300</span>
        </v-col>
        <v-col class="text-right text-body-2">
          <span class="text-green">850</span>
        </v-col>
      </v-row>

      <!-- Report Section -->
      <v-divider></v-divider>
      <v-card-text>
        <v-row>
          <v-col>
            <v-card title="On-Time Payment" variant="tonal">
              <template v-slot:append>
                <v-icon class="mr-1" color="primary">mdi-check-circle</v-icon>
              </template>
              <span class="text-h6 font-weight-bold ms-4">100%</span>
            </v-card>
          </v-col>
          <v-col>
            <v-card title="Est. Monthly Payments" variant="tonal">
              <template v-slot:append>
                <v-icon class="mr-1" color="primary">mdi-currency-usd</v-icon>
              </template>
              <span class="text-h6 font-weight-bold ms-4">$1,346</span>
            </v-card>
          </v-col>
          <v-col>
            <v-card title="Credit Used" variant="tonal">
              <template v-slot:append>
                <v-icon class="mr-1" color="primary">mdi-chart-pie</v-icon>
              </template>
              <span class="text-h6 font-weight-bold ms-4">32%</span>
            </v-card>
          </v-col>
          <v-col>
            <v-card title="Total Debt" variant="tonal">
                <template v-slot:append>
                <v-icon class="mr-1" color="primary">mdi-bank</v-icon>
              </template>
              <span class="text-h6 font-weight-bold ms-4">$20,235</span>
            </v-card>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
  export default {
    data() {
      return {
        score: 750 // Credit score value
      }
    }
  }
</script>

<style scoped>
  .text-red {
    color: #f44336;
  }

  .text-green {
    color: #4caf50;
  }

  .rounded-pill {
    border-radius: 9999px;
  }
</style>
