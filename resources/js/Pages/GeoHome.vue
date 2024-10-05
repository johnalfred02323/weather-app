<template>
    <Head title="Weather App" />
    <div class="flex min-h-screen px-4 md:px-0">
        <div class="w-full md:w-1/2 border-2 border-gray-400 bg-blue-100 m-auto h-4/5 p-8 my-8 rounded-xl shadow-xl text-gray-800">

            <div class="">
                <div class="relative">
                    <input v-model="search" type="text" class="w-full md:w-96 border-gray-600 rounded-md border-2 focus:outline-none py-1 pr-2 pl-9" placeholder="Search for a city...">
                    <div class="absolute top-1 left-2">
                        <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                    </div>

                </div>
                <!-- <div v-if="search" class="absolute left-0 z-10 ">
                    <div class="w-96 bg-white py-2 rounded-lg mt-1 shadow-lg">
                        <div class="block px-4 py-1 text-gray-800 hover:bg-gray-700 hover:text-white">test</div>
                    </div>
                </div> -->
                <div v-if="props.data" class="mt-16 mx-auto">
                    <div class="text-4xl font-semibold text-center">{{ geodata['formatted'] }}</div>
                    <div class="font-semibold text-center mt-4">Timezone: {{ geodata['timezone']['offset_STD'] }}</div>
                    <div class="font-semibold text-center">County: {{ geodata['county'] }}</div>

                    <div class="mt-6 flex justify-start overflow-x-auto py-4" >
                        <div v-for="item in props.data.list" :key="item.dt"><List :data="item" :timezone="props.data.city.timezone" /></div>
                    </div>
                </div>
                <div v-else class="mt-16 mx-auto">
                    <div class="text-2xl font-semibold text-center mt-4">Please, search a city to view the forecast</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import List from "@/Components/List.vue";
import { ref, computed, watch } from "vue";
import { Head, router, usePage } from "@inertiajs/vue3";

const props = defineProps({ data: Object, geodata: Object });

let search = ref(usePage().props.search);

let dataUrl = computed(() => {
    let url = new URL(route('geo.home'));

    if(search.value) {
        url.searchParams.append("search", search.value);
    }

    return url;
});

watch(() => dataUrl.value,
    (newDataUrl) => {
        router.visit(newDataUrl, {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        });
    }
)
</script>