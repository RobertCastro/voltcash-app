<template>
    <auth-layout>
        <template #toolbar>
            <h3 class="font-bold text-2xl">Hello!</h3>
            <p class="text-green-600 pt-2">
                Thanks for registering, before we start, could you please check your email?
            </p>
        </template>
        <form
        @submit.prevent="sentNewVerificationEmail"
        class="flex flex-col">
            <button
            class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl"
            >
                Resend verification email
            </button>
        </form>
    </auth-layout>
</template>

<script>
import AuthLayout from '../../Layouts/AuthLayout.vue'
export default {
  components: { AuthLayout },
  methods: {
        sentNewVerificationEmail() {
          this.$inertia.post(this.route('verification.send')).then(() => {
              
          })
        }
  }
    
}
</script>