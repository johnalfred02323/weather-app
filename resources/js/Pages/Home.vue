<template>
    <Head title="Weather App" />
    <div class="flex min-h-screen">
        <div class="w-1/2 border-2 border-gray-400 bg-blue-100 m-auto h-4/5 p-8 rounded-xl shadow-xl text-gray-800">

            <div class="">
                <div class="relative">
                    <input v-model="search" type="text" class="w-96 border-gray-600 rounded-md border-2 focus:outline-none py-1 pr-2 pl-9" placeholder="Search for a city...">
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
                    <div class="text-5xl font-semibold text-center">{{ countryInfo[0] + ', ' + countryInfo[1] }}</div>

                    <div class="mt-24 flex justify-start overflow-auto py-4" >
                        <div v-for="item in props.data.list" :key="item.dt"><List :data="item" :timezone="props.data.city.timezone" /></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import Card from "@/Components/Card.vue";
import List from "@/Components/List.vue";
import { ref, computed, watch } from "vue";
import { Head, router, usePage } from "@inertiajs/vue3";
// import { Inertia } from "@inertiajs/inertia";

const props = defineProps({ data: Object });

let search = ref(usePage().props.search);

// watch(search, value => {
//     Inertia.get('/home', { search: value }, {
//         preserveState: true
//     });
// });

let dataUrl = computed(() => {
    let url = new URL(route('home'));

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

let countryInfo = computed(() => {
    if(props.data) {
        let regionName = new Intl.DisplayNames(["en"], {type: "region"}).of(props.data.city.country);
        let cityName = props.data.city.name;

        // let datetime = convertTimeStamp(data.dt, data.timezone)

        return [cityName, regionName];
    }
});

function convertTimeStamp(timestamp, timezone) {
    const convertTimezone = timezone / 3600; // convert seconds to hours

    const date = new Date(timestamp * 1000);

    const options = {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric",
        hour: "numeric",
        minute: "numeric",
        timeZone: `Etc/GMT${convertTimezone >= 0 ? "-" : "+"}${Math.abs(convertTimezone)}`,
        hour12: true,
    }
    return date.toLocaleString("en-US", options);
}

function getImage(icon) {
    return "http://openweathermap.org/img/wn/"+icon+"@4x.png";
}

// let convertTimeStamp = computed({
//     get() {
//         return
//     },

//     set(newValue) {
//         const convertTimezone = timezone / 3600; // convert seconds to hours

//         const date = new Date(timestamp * 1000);

//         const options = {
//             weekday: "long",
//             day: "numeric",
//             month: "long",
//             year: "numeric",
//             hour: "numeric",
//             minute: "numeric",
//             timeZone: `Etc/GMT${convertTimezone >= 0 ? "-" : "+"}${Math.abs(convertTimezone)}`,
//             hour12: true,
//         }
//         return date.toLocaleString("en-US", options);
//     }
// });

// console.log(props.data);

</script>
