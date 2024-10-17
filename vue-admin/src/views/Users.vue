<template>
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Last Invoices </h2>
            <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">View all</a>
        </div>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full whitespace-no-wrap bg-white overflow-hidden table-striped">
                <thead>
                    <tr class="text-left">
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
                            #</th>
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Name
                        </th>
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Email
                        </th>
                        <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs text-right">
                            Action</th>

                    </tr>
                </thead>
                <tbody>

                    <tr v-for="user in users.slice((page - 1) * perPage, page * perPage)" :key="user.id"
                        class="focus-within:bg-gray-200 overflow-hidden">
                        <td class="border-t">{{ user.id }}</td>
                        <td class="border-t">{{ user.first_name }} {{ user.last_name }}</td>
                        <td class="border-t">{{ user.email }}</td>
                        <td class="border-t">
                            <router-link :to="`/users/${user.id}/links`" color="primary" elevation="2">View</router-link>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

       
        <Pagination
          :page="page"
          :total-visible="5"
          :length="lastPage"
        ></Pagination>

    </div>
</template>

<script>
import Pagination from "@/components/common/Pagination.vue";
import axios from "axios";

export default {
    name: "Users",
    components: { Pagination },
    data() {
        return {
            users: [],
            page: 1,
            perPage: 10,
            lastPage: 0
        }
    },
    async mounted() {
        const { data } = await axios.get('ambassadors');

        this.users = data;
        this.lastPage = Math.ceil(data.length / this.perPage);
    }
}
</script>