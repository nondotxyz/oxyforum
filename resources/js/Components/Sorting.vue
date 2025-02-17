<script setup>
import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    sortBy: { type: String, default: "title" },
    order: { type: String, default: "asc" },
    routeName: { type: String, default: "group" }
});

const selectedSort = ref(props.sortBy);
const order = ref(props.order);

watch(() => props.sortBy, (newVal) => selectedSort.value = newVal);
watch(() => props.order, (newVal) => order.value = newVal);

const updateSorting = () => {
    router.get(route(props.routeName), { sort: selectedSort.value, order: order.value }, { preserveState: true });
};

const toggleOrder = () => {
    order.value = order.value === 'asc' ? 'desc' : 'asc';
    updateSorting();
};
</script>

<template>
    <div class="flex items-center text-sm space-x-3">
        <label for="sort" class="font-medium">Sort by:</label>

        <div class="relative">
            <select id="sort" v-model="selectedSort" @change="updateSorting"
                class="border rounded-lg p-2 pl-8 pr-6 focus:text-sky appearance-none shadow-sm focus:ring-2 focus:ring-sky focus:outline-none">
                <option value="title">Title</option>
                <option value="topics_count">Number of Topics</option>
                <option value="posts_count">Number of Posts</option>
                <option value="created_at">Latest</option>
            </select>
            <span class="absolute left-2 top-2.5 text-gray-500">
                <span class="icon-[material-symbols--sort] text-lg"></span>
            </span>
        </div>

        <button @click="toggleOrder"
            class="flex items-center p-2 border rounded-lg shadow-sm bg-white hover:bg-gray-100 transition">
            <span v-if="order === 'asc'" class="icon-[mdi--arrow-up] text-lg text-gray-700"></span>
            <span v-else class="icon-[mdi--arrow-down] text-lg text-gray-700"></span>
        </button>
    </div>
</template>
