<template>
    <nav aria-label="Page navigation" class="mt-3">
      <ul class="inline-flex -space-x-px text-sm">
        <!-- Previous Button -->
        <li>
          <button
            @click="changePage(page - 1)"
            :disabled="page === 1"
            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50"
          >
            Previous 
          </button>
        </li>
  
        <!-- Page Numbers -->
        <li v-for="p in totalVisiblePages" :key="p">
          <button
            @click="changePage(p)"
            :class="{
              'bg-blue-500 text-white': p === page,
              'text-gray-500 hover:bg-gray-100 hover:text-gray-700': p !== page
            }"
            class="flex items-center justify-center px-3 h-8 leading-tight bg-white border border-gray-300"
          >
            {{ p }}
          </button>
        </li>
  
        <!-- Next Button -->
        <li>
          <button
            @click="changePage(page + 1)"
            :disabled="page === length"
            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50"
          >
            Next
          </button>
        </li>
      </ul>
    </nav>
  </template>
  
  <script>
  export default {
    props: {
      page: {
        type: Number,
        required: true
      },
      length: {
        type: Number,
        required: true
      },
      totalVisible: {
        type: Number,
        default: 5
      }
    },
    computed: {
      totalVisiblePages() {
        const pages = [];
        const start = Math.max(this.page - Math.floor(this.totalVisible / 2), 1);
        const end = Math.min(start + this.totalVisible - 1, this.length);
  
        for (let i = start; i <= end; i++) {
          pages.push(i);
        }
        return pages;
      }
    },
    methods: {
      changePage(newPage) {
        if (newPage >= 1 && newPage <= this.length) {
            this.$emit("page-change", newPage);
        }
      }
    }
  };
  </script>
  