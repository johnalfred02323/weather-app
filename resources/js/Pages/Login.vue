<template>
    <Head title="Weather App | Login" />
    <div class="flex h-screen">
        <div class="w-1/2 border-2 border-gray-400 m-auto h-4/5 p-8 rounded-xl shadow-xl text-center">
            <a :href="foursquare_url">
                <button class="h-auto border-2 border-gray-500 p-4 font-semibold rounded-lg shadow-lg">Click here to get Access!</button>
            </a>
        </div>
    </div>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";

defineProps({ foursquare_url: String });
</script>
