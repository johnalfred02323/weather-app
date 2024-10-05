<template>
    <div class="flex justify-between rounded-lg py-1 px-4 bg-blue-600 border-2 border-blue-800 shadow-lg">
        <div class="mx-1 my-auto">
            <i :class="[{'fa-solid': true}, icon ? 'fa-' + icon : '']"></i>
        </div>
        <div class="mx-1 font-semibold">
            <div>{{ title }}</div>
            <div>{{ content }}</div>
        </div>
    </div>
</template>
<script setup>
defineProps({
    title: {
        type: String
    },
    icon: {
        type: String
    },
    content: {
        type: String,
    },
 });
</script>
