<template>
    <div class="py-16 px-4 md:px-6 2xl:px-0 flex justify-center items-center 2xl:mx-auto 2xl:container">
        <div class="flex flex-col justify-start items-start w-full space-y-9">
            <div class="flex justify-start flex-col items-start space-y-2">
                <button class="flex flex-row items-center text-gray-600 dark:text-white hover:text-gray-500 space-x-1"
                    @click="goBack">
                    <BackArrowIcon />
                    <p class="text-sm leading-none">Back</p>
                </button>
                <p class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800 dark:text-gray-50">
                    Checkout
                </p>
                <p class="font-bold">
                    {{ user.first_name }} {{ user.last_name }}, Please check your products details...
                </p>
            </div>

            <div class="flex flex-col xl:flex-row space-y-6 xl:space-y-0 xl:space-x-6 w-full">
                <!-- Product Info -->
                <div class="xl:w-3/5 space-y-4">
                    <div class="bg-gray-300 p-5 rounded-md" v-for="(product, index) in products" :key="product.id">
                        <div class="flex flex-col space-y-4">
                            <p class="text-xl md:text-2xl">{{ product.title }}</p>
                            <p class="text-base font-semibold text-gray-600">$ {{ product.price }}</p>
                            <img :src="product.image" alt="Product image" class="w-52" />

                        </div>
                    </div>
                </div>

                <!-- Total Cart Info -->
                <div class="p-8 bg-gray-100 dark:bg-gray-800 flex flex-col lg:w-full xl:w-3/5">
                    <div class="flex flex-row justify-center items-center mt-6">
                        <hr class="border w-full" />
                        <p class="flex flex-shrink-0 px-4 text-base leading-4 text-gray-600 dark:text-white">
                            Card Info
                        </p>
                        <hr class="border w-full" />
                    </div>

                    <div class="my-8 space-y-3">
                        <div class="" v-for="(product, index) in products" :key="index">
                            <div class="flex justify-between">
                                <p>{{ product.title }}</p>
                                <p>$ {{ product.price }}</p>
                            </div>
                            <p>
                                <input v-model.number="quantities[product.id]"
                                    class="border border-gray-300 p-4 rounded w-full" type="number" min="0"
                                    placeholder="Quantity" />
                            </p>
                        </div>

                    </div>

                    <hr class="border w-full" />
                    <div class="mt-8 flex justify-between">
                        <p class="font-bold text-xl">Total:</p>
                        <p>$ {{ total }}</p>
                    </div>



                </div>

                <!-- User Info and Checkout -->
                <div class="p-8 bg-gray-100 dark:bg-gray-800 lg:w-full xl:w-3/5">
                    <div class="mt-8">
                        <input v-model="user.first_name" class="border border-gray-300 p-4 rounded w-full" type="text"
                            placeholder="First Name" />
                        <input v-model="user.last_name" class="border border-gray-300 p-4 rounded w-full mt-4"
                            type="text" placeholder="Last Name" />
                        <input v-model="user.email" class="border border-gray-300 p-4 rounded w-full mt-4" type="email"
                            placeholder="Email" />
                        <input v-model="user.address" class="border border-gray-300 p-4 rounded w-full mt-4" type="text"
                            placeholder="Address" />
                        <input v-model="user.country" class="border border-gray-300 p-4 rounded w-full mt-4" type="text"
                            placeholder="Country" />
                        <input v-model="user.city" class="border border-gray-300 p-4 rounded w-full mt-4" type="text"
                            placeholder="City" />
                        <input v-model="user.zip" class="border border-gray-300 p-4 rounded w-full mt-4" type="text"
                            placeholder="Zip" />
                    </div>
                    <button @click="checkout"
                        class="mt-8 bg-gray-900 text-white hover:bg-white hover:text-gray-900 border rounded w-full py-4">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useNuxtApp, useRoute, useRouter } from '#imports';

//import { useServerStripe } from '@stripe/server';
import { computed, reactive, ref } from 'vue';

// State and route handling
const user = reactive({
    first_name: '',
    last_name: '',
    email: '',
    address: '',
    country: '',
    city: '',
    zip: '',
});

const products = ref([]);
const quantities = reactive({});

// Computed total calculation
const total = computed(() =>
    products.value.reduce((sum, product) => sum + product.price * (quantities[product.id] || 0), 0)
);

// Nuxt app setup and data fetching
const { $axios } = useNuxtApp();
const route = useRoute();
const router = useRouter();

// onMounted(async () => {
//     const { data } = await $axios.get(`links/${route.params.code}`);
//     Object.assign(user, data.user);
//     products.value = data.products;

//     // Initialize quantities for each product
//     data.products.forEach((product: any) => (quantities[product.id] = 1));
// });
await useAsyncData(async () => {
    const { data } = await $axios.get(`links/${route.params.code}`);
    Object.assign(user, data.user);
    products.value = data.products;

    // Initialize quantities for each product
    data.products.forEach((product: any) => (quantities[product.id] = 1));
    //return response.data.user;
});

// Navigation back function
const goBack = () => router.back();

// Checkout function
const checkout = async () => {
    //const stripe = await ClientStripeOptions();
    const { data } = await $axios.post('orders', {
        ...user,
        code: route.params.code,
        products: products.value.map((product: any) => ({
            product_id: product.id,
            quantity: quantities[product.id],
        })),
    });

    console.log('checkout', data)
    // Redirect to Stripe checkout
   // await $nuxtApp.$stripe?.redirectToCheckout({ sessionId: data.id });
   //await stripe.redirectToCheckout({ sessionId: data.id });
};
</script>