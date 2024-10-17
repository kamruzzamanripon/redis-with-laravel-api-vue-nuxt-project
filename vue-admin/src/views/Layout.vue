
<template>
    <div class="antialiased bg-gray-200 w-full">

        <div class="h-screen flex overflow-hidden">

            <!-- Menu Above Medium Screen -->
            <SideBarMenu />
            <!-- @end Menu Above Medium Screen -->

            <div class="flex-1 flex-col relative z-0 overflow-y-auto">
                <Nav />

                <div class="md:max-w-6xl md:mx-auto px-4 py-8">

                   <router-view />


                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Nav from '@/components/common/Nav.vue';
import SideBarMenu from '@/components/common/SideBarMenu.vue';
import { useUserInfoStore } from '@/stores/useUserInfoStore';
import axios from 'axios';

export default {
  name: "Layout",
  components: { SideBarMenu, Nav },
  setup() {
    const userInfoStore = useUserInfoStore(); // Initialize the store
    return { userInfoStore }; // Make it available in template and computed properties
  },
  async mounted() {
    try {
      const { data } = await axios.get('user');
      console.log("layout-1", data);

      this.userInfoStore.setUser(data); // Store data in Pinia store
    } catch (e) {
      console.error('Error fetching user:', e);
      // Optionally handle error or redirect to login
       this.$router.push('/login');
    }
  },
  computed:{
    userInfo() {
            return this.userInfoStore.user;
        },
  }
  
};
</script>

<style scoped></style>
