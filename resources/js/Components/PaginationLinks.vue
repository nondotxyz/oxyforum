<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    model: Object, // Expected to contain 'links' from Laravel pagination
});

const goToPage = (event) => {
    const page = event.target.value;
    if (page && page > 0 && page <= props.model.last_page) {
        router.get(`${props.model.path}?page=${page}`, {}, { preserveScroll: true, preserveState: true });
    }
};
</script>

<template>
    <div class="flex justify-center items-center gap-1 mt-2 text-sm">
        <template v-for="(link, index) in model.links" :key="index">
            <Link v-if="index === 0" v-show="link.url" :href="link.url"
                class="px-2 py-1 border rounded transition-all duration-200 bg-sky text-black">
            <span class="icon-[material-symbols--arrow-left-alt] text-xs"></span>
            </Link>

            <input v-else-if="link.label === '...'" type="number" min="1" :max="model.last_page"
                class="w-10 px-1 py-0.5 text-center border rounded text-white [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                placeholder="..." @change="goToPage" />

            <Link v-else-if="index !== 0 && index !== model.links.length - 1" :href="link.url"
                class="px-2 py-1 border rounded transition-all duration-200" :class="{
                    'text-sky font-medium': link.active,
                    'hover:text-sky': !link.active
                }" v-html="link.label">
            </Link>

            <Link v-if="index === model.links.length - 1" v-show="link.url" :href="link.url"
                class="px-2 py-1 border rounded transition-all duration-200 bg-sky text-black">
            <span class="icon-[material-symbols--arrow-right-alt] text-xs"></span>
            </Link>
        </template>
        <span class="ml-2">{{ model.current_page }} / {{ model.last_page }}</span>
    </div>
</template>
