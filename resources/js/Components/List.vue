<template>
    <div class="w-80 p-4 mx-4 border-2 border-gray-200 bg-white shadow-lg rounded-2xl">
        <div class="font-semibold">
            <div>
                <div class="text-lg">Date: {{ convertTimeStamp(data.dt, timezone, {day: "numeric", month: "long", year: "numeric"}) }}</div>
                <div>{{ convertTimeStamp(data.dt, timezone, {weekday: "long", hour: "numeric", minute: "numeric"}) }}</div>
            </div>
            <div class=" text-center my-4 border-gray-400 border-2 py-1 px-2 rounded-2xl shadow-md">{{ data.weather[0].main }}</div>
            <div class="mx-auto w-20 bg-gray-700  rounded-full"><img :src="getImage(data.weather[0].icon)" /></div>
            <div class="text-center mt-4">
                <div class="text-lg">Temperature <div>{{ data.main.temp.toFixed() }}&#176</div></div>
                <div class="flex justify-center text-sm">
                    <div class="mx-1">Min: {{ data.main.temp_min.toFixed() }}&#176</div>
                    <div class="mx-1">Max: {{ data.main.temp_max.toFixed() }}&#176</div>
                </div>
            </div>
        </div>

        <div class="flex justify-start">
            <div>
                <div class="grid grid-cols-2 gap-4 text-gray-100 my-4">
                    <Card :content="data.main.feels_like.toFixed() + '&#176' " icon="temperature-three-quarters" title="Real Feel" />
                    <Card :content="data.main.humidity + '%'" icon="droplet" title="Humidity" />
                    <Card :content="data.wind.speed + ' m/s'" icon="wind" title="Wind" />
                    <Card :content="data.main.pressure + ' hPa'" icon="gauge-high" title="Pressure" />
                </div>
                <div v-if="data.rain" class="flex justify-start py-1 px-4 bg-blue-600 border-2 border-blue-800 text-gray-100 rounded-lg shadow-lg">
                    <div class="mx-1 my-auto"><i class="fa-solid fa-cloud-showers-heavy fa-lg"></i></div>
                    <div class="mx-1">
                        <div>Rain Volume for last 3 hours:</div>
                        <div>{{ data.rain['3h'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import Card from '@/Components/Card.vue';

defineProps({
    data: {
        type: Object
    },
    timezone: {
        type: Number
    }
})

function convertTimeStamp(timestamp, timezone, option) {
    const convertTimezone = timezone / 3600; // convert seconds to hours

    const date = new Date(timestamp * 1000);

    const options = {
        // weekday: "long",
        // day: "numeric",
        // month: "long",
        // year: "numeric",
        // hour: "numeric",
        // minute: "numeric",
        timeZone: `Etc/GMT${convertTimezone >= 0 ? "-" : "+"}${Math.abs(convertTimezone)}`,
    }


    let result = {...option, ...options};
    console.log(result);
    return date.toLocaleString("en-US", result);
}

function getImage(icon) {
    return "http://openweathermap.org/img/wn/"+icon+"@4x.png";
}
</script>
