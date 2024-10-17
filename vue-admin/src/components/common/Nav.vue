<template>
  <div class="px-4 md:px-8 py-2 h-16 flex justify-between items-center shadow-sm bg-white">
    <div class="flex items-center w-2/3">
      <input
        class="bg-gray-200 focus:outline-none focus:shadow-outline focus:bg-white border border-transparent focus:border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal hidden md:block placeholder-gray-700 mr-10"
        type="text" placeholder="Search..." />

      <div class="p-2 rounded-full hover:bg-gray-200 cursor-pointer md:hidden">
        <MenuBarIcone />
      </div>
      <div class="text-xl font-bold tracking-tight text-gray-800 md:hidden ml-2">
        Dashing Admin
      </div>
    </div>

    <div class="flex items-center">
      <a href="#" class="text-gray-500 p-2 rounded-full hover:text-blue-600 hover:bg-gray-200 cursor-pointer mr-4">
        <BellIcon /> 
      </a>

      <!-- Profile Icon with Dropdown -->
      <div class="relative">
        <!-- Trigger: Profile Icon -->
        <div
          class="cursor-pointer font-bold w-10 h-10 bg-blue-200 text-blue-600 flex items-center justify-center rounded-full"
          @click="toggleDropdown">
          {{ userName }}
        </div>

        <!-- Dropdown Menu -->
        <div v-show="open"
          class="absolute top-0 mt-12 right-0 w-48 bg-white py-2 shadow-md border border-gray-100 rounded-lg z-40"
          ref="dropdown">
          <router-link to="/profile" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Edit Profile</router-link>
          <!-- <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600">Account Settings</a> -->
          <button class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-blue-600" @click="logout">Sign Out</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useUserInfoStore } from '@/stores/useUserInfoStore';
import axios from 'axios';
import BellIcon from '../icons/BellIcon.vue';
import MenuBarIcone from '../icons/MenuBarIcone.vue';

export default {
  name: 'Nav',
  components: { BellIcon, MenuBarIcone },
  setup() {
    const userInfoStore = useUserInfoStore();
    return { userInfoStore };
  },
  data() {
    return {
      open: false, 
    };
  },
  computed: {
    user() {
      return this.userInfoStore.user;
    },
    userName() {
      const firstNameInitial = this.user?.first_name?.[0]?.toUpperCase() || '';
      const lastNameInitial = this.user?.last_name?.[0]?.toUpperCase() || '';
      return `${firstNameInitial}${lastNameInitial}`;
    },
  },
  methods: {
    async logout() {
      await axios.post('logout');
      await this.$router.push('/login');
    },
    toggleDropdown() {
      this.open = !this.open; // Toggle the dropdown state
    },
    handleClickOutside(event) {
      if (this.$refs.dropdown && !this.$refs.dropdown.contains(event.target)) {
        //this.open = false; // Close the dropdown if clicked outside
      }
    },
  },
  mounted() {
    document.addEventListener('click', this.handleClickOutside);
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
  },
};
</script>
