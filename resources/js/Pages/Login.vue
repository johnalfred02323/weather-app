<template>
    <Head title="Weather App | Login" />
    <div class="flex h-screen">
        <div class="w-1/2 border-2 border-gray-400 m-auto h-4/5 p-8 rounded-xl shadow-xl text-center">
            <div>
                <a :href="foursquare_url">
                    <button class="h-auto border-2 my-4 border-gray-500 p-4 font-semibold rounded-lg shadow-lg">Click here to use Foursquare API!</button>
                </a>
            </div>
            <div>
                <a :href="geoapify_url">
                    <button class="h-auto border-2 my-4 border-gray-500 p-4 font-semibold rounded-lg shadow-lg">Click here to use Geoapify!</button>
                </a>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({ foursquare_url: String, geoapify_url: String });
</script>
