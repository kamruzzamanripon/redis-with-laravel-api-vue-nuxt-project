

<template>
    <div class="bg-white w-64 min-h-screen overflow-y-auto hidden md:block shadow relative z-30">

<!-- Brand Logo / Name -->
<div class="flex items-center px-6 py-3 h-16">
  <div class="text-2xl font-bold tracking-tight text-gray-800">Dashing Admin.</div>
</div>
<!-- @end Brand Logo / Name -->

<div class="px-4 py-2">
  <ul>
    <li>
      <router-link 
        to="/stats"
        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200"
        active-class="bg-gray-200"
        >
        <SqureBoxIcon />
        Stats
      </router-link>
    </li>

    <li>
      <router-link to="/rankings"
        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
        <ChartIcone />
        Rankings
      </router-link>
    </li>

    <li>
      <router-link to="/orders"
        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
        <InvoiceIcon />
        Orders
      </router-link>
    </li>

    <li>
      <router-link to="/profile"
        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-200">
        <InvoiceIcon />
        Profile
      </router-link>
    </li>

    <!-- <li>
      <a href="#"
        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-blue-600 hover:text-blue-600 hover:bg-gray-200 bg-gray-200">
        <TimerIcone />
        Tracking
      </a>
    </li> -->

    <li>
      <a href="#"
        class="mb-1 px-2 py-2 rounded-lg flex items-center font-medium text-blue-600 hover:text-blue-600 hover:bg-gray-200 "
        @click="logout"
        >
        <TimerIcone />
        Log out
      </a>
    </li>

    
  </ul>

  <div class="bg-orange-200 mb-10 p-6 rounded-lg mt-16">
    <h2 class="text-gray-800 text-lg leading-tight">Try <strong class="font-bold">Dashing Admin.</strong></h2>
    <p class="text-gray-800 text-lg mb-4 leading-tight">Premium for free!</p>

    <button class="shadow text-center w-full block bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline text-white font-semibold py-2 px-4 rounded-lg">
      30 Days Free Trail	  
    </button>
  </div>
</div>
</div>
</template>

<script>
import { useUserInfoStore } from '@/stores/useUserInfoStore';
import axios from "axios";
import ChartIcone from '../icons/ChartIcone.vue';
import InvoiceIcon from '../icons/InvoiceIcon.vue';
import SqureBoxIcon from '../icons/SqureBoxIcon.vue';
import TimerIcone from '../icons/TimerIcone.vue';

export default {
  name: "Nav",
  components: { ChartIcone, InvoiceIcon, SqureBoxIcon, TimerIcone },
  setup() {
    const userInfoStore = useUserInfoStore(); // Initialize the store
    return { userInfoStore }; // Make it available in template and computed properties
  },
  methods: {
    async logout() {
      await axios.post('logout');

      await this.$router.push('/login');
    }
  },
 
  computed: {
    user() {
        return this.userInfoStore.user;
    }
  }
}
</script>