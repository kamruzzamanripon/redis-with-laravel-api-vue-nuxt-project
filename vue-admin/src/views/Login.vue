<template>
    <div class="min-h-screen flex items-center justify-center bg-blue-400">

        <!-- login form -->
        <div class="bg-white p-16 rounded shadow-2xl w-2/3">

            <h2 class="text-3xl font-bold mb-10 text-gray-800">Create Your Account</h2>

            <form class="space-y-5" @submit.prevent="submit">
                <div>
                    <label class="block mb-1 font-bold text-gray-500">Email</label>
                    <input 
                        type="email"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                         v-model="email"
                    >
                </div>

                <div>
                    <label class="block mb-1 font-bold text-gray-500">Password</label>
                    <input 
                        type="password"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="password"
                    >
                </div>

                <button
                    class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300"  type="submit">Submit
                    Up</button>

            </form>

        </div>

    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    async submit() {
      await axios.post('login', {
        email: this.email,
        password: this.password
      });

      await this.$router.push('/');
    }
  }
}
</script>