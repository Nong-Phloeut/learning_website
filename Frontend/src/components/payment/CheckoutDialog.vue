<!-- src/components/CheckoutDialog.vue -->
<template>
  <v-dialog
    :model-value="dialog"
    max-width="500"
    @update:model-value="updateDialog"
  >
    <v-stepper :items="['Payment method', 'Checkout']">
      <template v-slot:item.1>
        <v-card class="mb-5" variant="text">
          <v-card-title>Payment for: Freelance Assignment</v-card-title>
          <v-card-title class="text-h4 font-weight-bold">$600.00</v-card-title>
          <v-radio-group row>
            <v-radio label="Credit Card" value="credit_card">
              <template v-slot:label>
                <v-icon color="success">mdi-credit-card</v-icon>
                Credit Card
                <!-- <img
                  width="60"
                  src="https://imgs.search.brave.com/_2enuHzTYxcrqUAQ-KrwW-J9isVmXLE5gwqiGntK_3M/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zZWVr/bG9nby5uZXQvd3At/Y29udGVudC91cGxv/YWRzLzIwMTEvMDgv/bWFzdGVyY2FyZC1s/b2dvLTQwMHg0MDAu/cG5n"
                  alt="Visa Mastercard"
                /> -->
              </template>
            </v-radio>
            <v-radio label="Instant Transfer" value="instant_transfer">
              <template v-slot:label>
                <v-icon color="secondary">mdi-bank-transfer</v-icon>
                Instant Transfer
                <!-- <img src="paynow_logo.png" alt="PayNow" /> -->
              </template>
            </v-radio>
            <v-radio label="Direct Debit" value="direct_debit">
              <template v-slot:label>
                <v-icon color="primary">mdi-bank</v-icon>
                Direct Debit
                <!-- <img src="dbs_uob_ocbc_logo.png" alt="DBS UOB OCBC" /> -->
              </template>
            </v-radio>
          </v-radio-group>
        </v-card>
      </template>

      <template v-slot:item.2>
        <v-card>
          <!-- <v-btn variant="text" icon="mdi-close" @click="closeDialog"></v-btn> -->
          <v-card-text>
            <v-form ref="checkoutForm" v-model="valid">
              <v-text-field
                label="Cardholder Name"
                v-model="cardholderName"
                :rules="[rules.required]"
                required
                variant="outlined"
              ></v-text-field>
              <v-text-field
                label="Card Number"
                v-model="cardNumber"
                :rules="[rules.required, rules.cardNumber]"
                maxlength="19"
                required
                variant="outlined"
                @input="formatCardNumber"
              ></v-text-field>
              <v-text-field
                label="Expiry Date (MM/YY)"
                v-model="expiryDate"
                :rules="[rules.required, rules.expiryDate]"
                maxlength="5"
                required
                variant="outlined"
                @input="formatExpiryDate"
              ></v-text-field>
              <v-text-field
                label="CVV"
                v-model="cvv"
                :rules="[rules.required, rules.cvv]"
                maxlength="3"
                required
                variant="outlined"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions class="px-4">
            <v-btn
              class="bg-primary"
              block
              @click="processPayment"
              :disabled="!valid"
            >
              Pay $999
            </v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-stepper>
    <!-- <v-card>
      <v-toolbar class="bg-primary">
        <v-toolbar-title>Checkout</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn variant="text" icon="mdi-close" @click="closeDialog"></v-btn>
      </v-toolbar>
      <v-card-text>
        <v-form ref="checkoutForm" v-model="valid">
          <v-text-field
            label="Cardholder Name"
            v-model="cardholderName"
            :rules="[rules.required]"
            required
            variant="outlined"
          ></v-text-field>
          <v-text-field
            label="Card Number"
            v-model="cardNumber"
            :rules="[rules.required, rules.cardNumber]"
            maxlength="19"
            required
            variant="outlined"
            @input="formatCardNumber"
          ></v-text-field>
          <v-text-field
            label="Expiry Date (MM/YY)"
            v-model="expiryDate"
            :rules="[rules.required, rules.expiryDate]"
            maxlength="5"
            required
            variant="outlined"
            @input="formatExpiryDate"
          ></v-text-field>
          <v-text-field
            label="CVV"
            v-model="cvv"
            :rules="[rules.required, rules.cvv]"
            maxlength="3"
            required
            variant="outlined"
          ></v-text-field>
        </v-form>
      </v-card-text>
      <v-card-actions class="px-6">
        <v-btn
          class="bg-primary"
          block
          @click="processPayment"
          :disabled="!valid"
        >
          Pay $999
        </v-btn>
      </v-card-actions>
    </v-card> -->
  </v-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Boolean,
        required: true
      },
      courseName: {
        type: String,
        default: ''
      }
    },
    data() {
      return {
        valid: false,
        cardholderName: '',
        cardNumber: '',
        expiryDate: '',
        cvv: '',
        rules: {
          required: value => !!value || 'Required.',
          cardNumber: value =>
            /^\d{4} \d{4} \d{4} \d{4}$/.test(value) ||
            'Card number must be 16 digits in the format XXXX XXXX XXXX XXXX.',

          expiryDate: value =>
            /^(0[1-9]|1[0-2])\/\d{2}$/.test(value) || 'Format must be MM/YY.',
          cvv: value => /^\d{3}$/.test(value) || 'CVV must be 3 digits.'
        }
      }
    },
    methods: {
      updateDialog(value) {
        this.$emit('update:dialog', value)
      },
      closeDialog() {
        this.$emit('close')
        this.updateDialog(false)
        this.clearForm()
      },
      processPayment() {
        if (this.$refs.checkoutForm.validate()) {
          this.$emit('payment-success')
          this.$root.$notif(`Payment successful`, {
            type: 'success',
            color: 'primary'
          })
          this.closeDialog()
        }
      },
      clearForm() {
        this.cardholderName = ''
        this.cardNumber = ''
        this.expiryDate = ''
        this.cvv = ''
      },
      formatCardNumber() {
        // Remove any non-numeric characters
        this.cardNumber = this.cardNumber.replace(/\D/g, '')

        // Automatically insert spaces every four digits
        if (this.cardNumber.length > 4) {
          this.cardNumber = this.cardNumber.match(/.{1,4}/g).join(' ')
        }

        // Limit to 19 characters (16 digits + 3 spaces)
        this.cardNumber = this.cardNumber.slice(0, 19)
      },
      formatExpiryDate() {
        // Remove any non-numeric characters
        this.expiryDate = this.expiryDate.replace(/\D/g, '')

        // Automatically insert a slash after the month
        if (this.expiryDate.length > 2) {
          this.expiryDate =
            this.expiryDate.slice(0, 2) + '/' + this.expiryDate.slice(2, 4)
        }

        // Limit to 5 characters (MM/YY)
        this.expiryDate = this.expiryDate.slice(0, 5)
      }
    }
  }
</script>

<style scoped></style>
