<template>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full whitespace-no-wrap bg-white overflow-hidden table-striped">
            <thead>
                <tr class="text-left">
                    <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">
                        #</th>
                    <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Code
                    </th>
                    <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Count
                    </th>
                    <th class="px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs text-right">
                        Revenue</th>

                </tr>
            </thead>
            <tbody>

                <tr v-for="link in links" :key="link.id">
                    <td>{{ link.id }}</td>
                    <td>{{ link.code }}</td>
                    <td>{{ link.orders.length }}</td>
                    <td>{{ link.orders.reduce((s, o) => s + o.total, 0) }}</td>
                </tr>

            </tbody>
        </table>
    </div>


</template>

<script>
import axios from "axios";

export default {
    name: "Links",
    data() {
        return {
            links: []
        }
    },
    async mounted() {
        const { data } = await axios.get(`users/${this.$route.params.id}/links`);

        this.links = data;
    }
}
</script>