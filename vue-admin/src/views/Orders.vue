<template>
    <div class="space-y-4">
      <div 
        v-for="order in orders" 
        :key="order.id" 
        class="border rounded-lg shadow-md"
      >
        <!-- Order Header -->
        <div 
          @click="togglePanel(order.id)" 
          class="flex justify-between items-center p-4 bg-gray-200 cursor-pointer"
        >
          <span class="font-bold">{{ order.name }}</span>
          <span class="text-green-600">${{ order.total }}</span>
        </div>
  
        <!-- Order Content -->
        <div 
          v-if="activePanel === order.id" 
          class="p-4 bg-white"
        >
          <table class="w-full table-auto border-collapse">
            <thead>
              <tr class="bg-gray-100">
                <th class="border p-2 text-left">#</th>
                <th class="border p-2 text-left">Product Title</th>
                <th class="border p-2 text-left">Price</th>
                <th class="border p-2 text-left">Quantity</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in order.order_items" :key="item.id">
                <td class="border p-2">{{ item.id }}</td>
                <td class="border p-2">{{ item.product_title }}</td>
                <td class="border p-2">${{ item.price }}</td>
                <td class="border p-2">{{ item.quantity }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "Orders",
    data() {
      return {
        orders: [],
        activePanel: null, // To track which panel is expanded
      };
    },
    async mounted() {
      const { data } = await axios.get("orders");
      this.orders = data;
    },
    methods: {
      togglePanel(id) {
        this.activePanel = this.activePanel === id ? null : id;
      },
    },
  };
  </script>
  