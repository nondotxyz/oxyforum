<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';
import PaginationLinks from '@/Components/PaginationLinks.vue';
import Common from '@/Layouts/Common.vue';
import Empty from '@/Components/Empty.vue';

defineProps({
    groups: Object,
});

</script>
<template>
    <Common>
        <div class="flex items-center justify-between">
            <PaginationLinks :model="groups"></PaginationLinks>
            <Link :href="route('group.create')" class="bg-lavender text-black rounded-lg p-2 inline-flex cursor-pointer"
                as="button">
            Create new group
            </Link>
        </div>

        <Empty v-if="groups.data.length == 0" />

        <Link v-for="group in groups.data" :href="route('topic', group.id)" class="w-full">
        <Card class="p-2 w-full border-none flex-row hover:bg-lavender hover:text-black">
            <span class="icon-[material-symbols--topic] size-15 mr-4"></span>
            <div class="flex flex-col justify-around mr-auto">
                <span class="font-bold text-lg">{{ group.title }}</span>
                <span>{{ group.description }}</span>
            </div>
            <div class="flex flex-col justify-between">
                <div>Topics: {{ group.topics_count }}</div>
                <div>Posts: {{ group.posts_count }}</div>
            </div>
        </Card>
        </Link>
    </Common>
</template>
