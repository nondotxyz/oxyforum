<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Common from '@/Layouts/Common.vue';
import PostComponent from '@/Components/PostComponent.vue';
import PaginationLinks from '@/Components/PaginationLinks.vue';
import { createReusableTemplate } from '@vueuse/core'
const [DefineTemplate, ReuseTemplate] = createReusableTemplate()

defineProps({
    group: Object,
    topic: Object,
    posts: Object,
})

</script>

<template>
    <DefineTemplate>
        <div class="flex items-center justify-between">
            <PaginationLinks :model="posts"></PaginationLinks>
            <Link :href="route('post.reply', { group: group.id, topic: topic.id })"
                class="bg-lavender text-black rounded-lg p-2 inline-flex cursor-pointer" as="button">
            Reply</Link>
        </div>
    </DefineTemplate>
    <Common>
        <ReuseTemplate />
        <PostComponent v-if="posts.current_page === 1" :model="topic" />
        <PostComponent :model="post" v-for="post in posts.data" :key="post.id"></PostComponent>
        <ReuseTemplate />
    </Common>
</template>