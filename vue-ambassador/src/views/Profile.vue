<template>
    <div>

        <div class="border bottom-3 bg-yellow-200 p-4 rounded-md mt-4">
            <h3>Account Information</h3>
            <form @submit.prevent="infoSubmit">
                <div>
                    <label class="block mb-1 font-bold text-gray-500">First Name</label>
                    <input type="text"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="user.first_name">
                </div>
                
                <div>
                    <label class="block mb-1 font-bold text-gray-500">Last Name</label>
                    <input type="text"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="user.last_name">
                </div>
                
                <div>
                    <label class="block mb-1 font-bold text-gray-500">Email</label>
                    <input type="email"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="user.email">
                </div>
                <button
                    class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300"
                    type="submit">Update
                    Up</button>
            </form>
        </div>

        <div class="border bottom-3 bg-yellow-200 p-4 rounded-md mt-4">
            <h3 class="mt-4">Change Password</h3>
            <form class="space-y-5" @submit.prevent="passwordSubmit">
                <div>
                    <label class="block mb-1 font-bold text-gray-500">Password</label>
                    <input type="password"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="password">
                </div>

                <div>
                    <label class="block mb-1 font-bold text-gray-500">Password Confirm</label>
                    <input type="password"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="password_confirm">
                </div>

                <button
                    class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300"
                    type="submit">Update
                    Up</button>

            </form>
        </div>
    </div>
</template>
  
<script>
import { useUserInfoStore } from '@/stores/useUserInfoStore';
import axios from "axios";

export default {
    name: "Profile",
    data() {
        return {
            password: '',
            password_confirm: ''
        }
    },
    setup() {
        const userInfoStore = useUserInfoStore(); // Initialize the store
        return { userInfoStore }; // Make it available in template and computed properties
    },
    methods: {
        async infoSubmit() {
            const { data } = await axios.put('users/info', {
                first_name: this.user.first_name,
                last_name: this.user.last_name,
                email: this.user.email,
            });

            await this.$store.dispatch('setUser', data);
        },
        async passwordSubmit() {
            await axios.put('users/password', {
                password: this.password,
                password_confirm: this.password_confirm,
            })
        }
    },
    computed: {
        user() {
            return this.userInfoStore.user;
        }
    }
}
</script>