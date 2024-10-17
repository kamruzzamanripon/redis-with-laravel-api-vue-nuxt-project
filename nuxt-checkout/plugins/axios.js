import axios from 'axios'

export default defineNuxtPlugin(() => {
    const config = useRuntimeConfig()

    const axiosInstance = axios.create({
        //baseURL: 'http://localhost:8000/api/checkout/', // Set the base URL here
        baseURL: config.public.axiosBaseURL,
    })

    return {
        provide: {
            axios: axiosInstance,
        },
    }
})
