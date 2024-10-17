// src/stores/userInfo.js
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useUserInfoStore = defineStore('userInfo', () => {
  const user = ref(null);  

  // Action to set user data
  const setUser = (userData) => {
    user.value = userData;
  };

  return { user, setUser };
});
