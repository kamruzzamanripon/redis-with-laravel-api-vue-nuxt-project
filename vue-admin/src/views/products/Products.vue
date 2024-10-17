<template>
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Last Invoices </h2>
            <router-link to="/products/create" class="text-blue-600 hover:text-blue-500 font-medium">Create Product</router-link>
        </div>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full whitespace-no-wrap bg-white overflow-hidden table-striped">
                <thead>
                    <tr class="text-left">
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
                            #</th>
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Image
                        </th>
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Title
                        </th>
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs text-right">
                            Description</th>
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs text-right">
                            Price</th>
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs text-right">
                            Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products.slice((page - 1) * perPage, page * perPage)" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>
                            <img :src="product.image"  />
                        </td>
                        <td>{{ product.title }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.price }}</td>
                        <td>
                            <v-btn-toggle>
                                <router-link color="primary" :to="`/products/${product.id}/edit`">Edit</router-link>
                                <button color="error" @click="del(product.id)">Delete</button>
                            </v-btn-toggle>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>


        <Pagination :page="page" :total-visible="5" :length="lastPage"></Pagination>

    </div>
</template>

<script lang="ts">
import Pagination from "@/components/common/Pagination.vue";
import axios from "axios";
//import Vue from "vue";

export default {
    name: "Products",
    components: { Pagination },
    data() {
        return {
            products: [],
            page: 1,
            perPage: 10,
            lastPage: 0
        }
    },
    async mounted() {
        const { data } = await axios.get('products');

        this.products = data;
        this.lastPage = Math.ceil(data.length / this.perPage);
    },
    methods: {
        async del(id: number) {
            if (confirm('Are you sure?')) {
                await axios.delete(`products/${id}`);

                this.products = this.products.filter((p: any) => p.id !== id);
            }
        }
    }
}
</script>