<template>
    <div class="min-h-screen flex items-center justify-center bg-blue-400">
        <div class="bg-white p-16 rounded shadow-2xl w-2/3">
            <h2 class="text-3xl font-bold mb-10 text-gray-800">Create Product</h2>

            <form class="space-y-5" @submit.prevent="submit">
                <div>
                    <label class="block mb-1 font-bold text-gray-500">Title</label>
                    <input type="text"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="title" />
                </div>

                <div>
                    <label class="block mb-1 font-bold text-gray-500">Description</label>
                    <input type="text"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="description" />
                </div>

                <div>
                    <label class="block mb-1 font-bold text-gray-500">Image</label>
                    <input type="file"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        ref="image" @change="handleFileUpload" />
                </div>

                <div>
                    <label class="block mb-1 font-bold text-gray-500">Price</label>
                    <input type="number"
                        class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-purple-500"
                        v-model="price" />
                </div>

                <button
                    class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300"
                    type="submit">
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>


<script>
import axios from "axios";

export default {
    name: "ProductForm",
    data() {
        return {
            title: "",
            description: "",
            price: "",
            imageFile: null, // Store the uploaded image file
        };
    },
    async mounted() {
        if (this.$route.params.id) {
            const { data } = await axios.get(`products/${this.$route.params.id}`);

            this.title = data.title;
            this.description = data.description;
            this.price = data.price;
            // Optional: Load image if required (you may need a backend URL for this)
        }
    },
    methods: {
        handleFileUpload(event) {
            this.imageFile = event.target.files[0]; // Capture the selected file
        },
        async submit() {
            // const formData = new FormData();
            // formData.append("title", this.title);
            // formData.append("description", this.description);
            // formData.append("price", this.price);
            // if (this.imageFile) {
            //     formData.append("image", this.imageFile); // Add image to FormData
            // }

            const formData = {
                title: this.title,
                description: this.description,
                image: this.image,
                price: this.price,
            };

            try {
                if (this.$route.params.id) {
                    await axios.put(`/products/${this.$route.params.id}`, formData);
                } else {
                    await axios.post("products", formData, {
                        headers: { "Content-Type": "multipart/form-data" },
                    });
                }

                await this.$router.push("/products");
            } catch (error) {
                console.error("Error uploading product:", error);
            }
        },
    },
};

</script>