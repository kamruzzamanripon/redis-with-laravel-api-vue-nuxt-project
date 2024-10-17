<template>
    <div class="col-md-12 mb-4" v-if="link">
        <div class="alert alert-info" role="alert">
            {{ link }}
        </div>
    </div>

    <div class="col-md-12 mb-4" v-if="error">
        <div class="alert alert-danger" role="alert">
            {{ error }}
        </div>
    </div>

<!-- <div>
    test -{{ testLink }}
</div> -->
    <div class="flex justify-between p-5">
        <div class="flex space-x-10">
            <input class="w-80 rounded-md h-10" placeholder="Search" @keyup="search($event.target.value)" />
            <div class="input-group-append" v-if="selected.length > 0">
                <button class="bg-green-700 p-2 rounded-md text-white" @click="generate">Generate Link</button>
            </div>
        </div>
        <div class="input-group-append">
            <select class="form-select" @change="sort($event.target.value)">
                <option>Select</option>
                <option value="asc">Price Ascending</option>
                <option value="desc">Price Descending</option>
            </select>
        </div>
    </div>

    <div class="flex flex-wrap space-x-10 space-y-4 justify-center">
        <div class="col" v-for="product in products" :key="product.id" @click="select(product.id)">
            <div :class="selected.some(s => s === product.id) ? 'card shadow-sm selected' : 'card shadow-sm'">
                <img :src="product.image" class="w-44 rounded-md" />
                <div class="card-body">
                    <p class="card-text">{{ product.title }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">${{ product.price }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-10" v-if="filters.page < lastPage">
        <button class="bg-blue-800 text-white p-2 rounded-md " @click="loadMore">Load More</button>
    </div>
</template>

<script lang="ts">
import axios from "axios";
import { computed, ref, SetupContext } from 'vue';

export default {
    name: "Products",
    props: ['products', 'filters', 'lastPage'],
    emits: ['set-filters'],
    setup(props: any, context: SetupContext) {
        const selected = ref<number[]>([]);
        const link = ref('');
        const error = ref('');

        const search = (s: string) => {
            context.emit('set-filters', {
                ...props.filters,
                s,
                page: 1
            });
        }

        const sort = (sort: string) => {
            context.emit('set-filters', {
                ...props.filters,
                sort,
                page: 1
            });
        }

        const loadMore = () => {
            context.emit('set-filters', {
                ...props.filters,
                page: props.filters.page + 1
            });
        }

        const select = (id: number) => {
            console.log('vite',import.meta.env);
            if (selected.value.some(s => s === id)) {
                selected.value = selected.value.filter(s => s !== id);
                return;
            }

            selected.value = [...selected.value, id];
        }

        const generate = async () => {
            try {
                const { data } = await axios.post('links', {
                    products: selected.value
                });

               //link.value = `Link generated: ${process.env.VUE_APP_CHECKOUT_URL}/${data.code}`;
               link.value = `Link generated: http://localhost:5000/${data.code}`;
            } catch (e) {
                error.value = 'You should be logged in to generate a link!';
            } finally {
                setTimeout(() => {
                    link.value = '';
                    error.value = '';
                }, 5000);
            }
        }

        const testLink = computed(()=>{
            const checkoutUrl = import.meta.env.VITE_CHECKOUT_URL; // Access environment variable
                return `Link generated: ${checkoutUrl}/`;
        })

        return {
            selected,
            link,
            error,
            search,
            sort,
            loadMore,
            select,
            generate,
            testLink
        }
    }
}
</script>

<style scoped>
.card {
    cursor: pointer;
}

.card.selected {
    border: 4px solid darkcyan;
}
</style>