<script setup lang="ts">
import BackArrowIcon from '~/component/icons/BackArrowIcon.vue';
</script>

<template>
    <div>
        <div class="py-16 px-4 md:px-6 2xl:px-0 flex justify-center items-center 2xl:mx-auto 2xl:container">

            <!-- CheckOut Title and meta info -->
            <div class="flex flex-col justify-start items-start w-full space-y-9">
                <div class="flex justify-start flex-col items-start space-y-2">
                    <button
                        class="flex flex-row items-center text-gray-600 dark:text-white hover:text-gray-500 space-x-1">
                        <BackArrowIcon />
                        <p class="text-sm leading-none">Back</p>
                    </button>
                    <p
                        class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800 dark:text-gray-50">
                        Checkout</p>
                </div>
                <!-- End CheckOut Title and meta info -->

                <div
                    class="flex flex-col xl:flex-row justify-center xl:justify-between space-y-6 xl:space-y-0 xl:space-x-6 w-full">

                    <!-- Product Info -->
                    <div
                        class="xl:w-3/5 space-y-4 flex flex-col sm:flex-row xl:flex-col justify-center items-center bg-gray-100 dark:bg-gray-800 py-7 sm:py-0 xl:py-10 px-10 xl:w-full">
                        <div class="bg-gray-300 p-5 rounded-md">
                            <div class="flex flex-col justify-start items-start w-full space-y-4">
                                <p class="text-xl md:text-2xl leading-normal text-gray-800 dark:text-gray-50">Logitech
                                    K251
                                </p>
                                <p class="text-base font-semibold leading-none text-gray-600 dark:text-white">$520.00
                                </p>
                            </div>
                            <div class="mt-6 sm:mt-0 xl:my-10 xl:px-20 w-52 sm:w-96 xl:w-auto">
                                <img src="https://i.ibb.co/0GFzTP4/Rectangle-131.png" alt="headphones" />
                            </div>
                        </div>
                        <div class="bg-gray-300 p-5 rounded-md">
                            <div class="flex flex-col justify-start items-start w-full space-y-4">
                                <p class="text-xl md:text-2xl leading-normal text-gray-800 dark:text-gray-50">Logitech
                                    K251
                                </p>
                                <p class="text-base font-semibold leading-none text-gray-600 dark:text-white">$520.00
                                </p>
                            </div>
                            <div class="mt-6 sm:mt-0 xl:my-10 xl:px-20 w-52 sm:w-96 xl:w-auto">
                                <img src="https://i.ibb.co/0GFzTP4/Rectangle-131.png" alt="headphones" />
                            </div>
                        </div>
                    </div>
                    <!-- End Product Info -->
                    
                    <!-- total cart Info -->
                    <div class="p-8 bg-gray-100 dark:bg-gray-800 flex flex-col lg:w-full xl:w-3/5">
                        <div class="flex flex-row justify-center items-center mt-6">
                            <hr class="border w-full" />
                            <p class="flex flex-shrink-0 px-4 text-base leading-4 text-gray-600 dark:text-white">
                                Card Info
                            </p>
                            <hr class="border w-full" />
                        </div>

                        <div class="my-8 space-y-3">
                            <div class="flex justify-between">
                                <p>Product Name: Abcde</p>
                                <p>$10</p>
                            </div>
                            <div class="flex justify-between">
                                <p>Product Name: Abcde</p>
                                <p>$10</p>
                            </div>
                        </div>

                        <hr class="border w-full" />
                        <div class="mt-8 flex justify-between">
                            <p class="font-bold text-xl">Total:</p>
                            <p>$100</p>
                        </div>
                        

                     
                    </div>
                    <!-- End total cart Info -->

                    <!-- User Infor and Payment Process -->
                    <div class="p-8 bg-gray-100 dark:bg-gray-800 flex flex-col lg:w-full xl:w-3/5">
                        <div class="flex flex-row justify-center items-center mt-6">
                            <hr class="border w-full" />
                            <p class="flex flex-shrink-0 px-4 text-base leading-4 text-gray-600 dark:text-white">
                                Personal Info
                            </p>
                            <hr class="border w-full" />
                        </div>

                        <div class="mt-8">
                            <input
                                class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600"
                                type="text" name="" id="" placeholder="First Name" />
                        </div>
                        <div class="mt-8">
                            <input
                                class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600"
                                type="text" name="" id="" placeholder="Last Name" />
                        </div>

                        <div class="mt-8">
                            <input
                                class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600"
                                type="email" name="" id="" placeholder="Email" />
                        </div>
                        <div class="mt-8">
                            <input
                                class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600"
                                type="text" name="" id="" placeholder="Address" />
                        </div>
                        <div class="mt-8">
                            <input
                                class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600"
                                type="text" name="" id="" placeholder="country" />
                        </div>
                        <div class="mt-8">
                            <input
                                class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600"
                                type="text" name="" id="" placeholder="City" />
                        </div>
                        <div class="mt-8">
                            <input
                                class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600"
                                type="text" name="" id="" placeholder="Zip" />
                        </div>





                        <button
                            class="mt-8 border border-transparent hover:border-gray-300 dark:bg-white dark:hover:bg-gray-900 dark:text-gray-900 dark:hover:text-white dark:border-transparent bg-gray-900 hover:bg-white text-white hover:text-gray-900 flex justify-center items-center py-4 rounded w-full">
                            <div>
                                <p class="text-base leading-4">Checkout </p>
                            </div>
                        </button>
                    </div>
                    <!-- End User Infor and Payment Process -->


                </div>
            </div>
        </div>
    </div>
</template>