<script setup>
import { Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';
import Common from '@/Layouts/Common.vue';
import dayjs from 'dayjs';
import PaginationLinks from "@/Components/PaginationLinks.vue"
import Empty from '@/Components/Empty.vue';
import { createReusableTemplate } from '@vueuse/core'
const [DefineTemplate, ReuseTemplate] = createReusableTemplate()

defineProps({
    group: Object,
    topics: Object,
})
</script>

<template>
    <DefineTemplate>
        <div class="flex items-center justify-between">
            <PaginationLinks :model="topics"></PaginationLinks>
            <Link :href="route('topic.create', group.id)"
                class="bg-lavender text-black rounded-lg p-2 inline-flex cursor-pointer" as="button">
            Create new topic</Link>
        </div>
    </DefineTemplate>
    <Common>
        <ReuseTemplate />
        <Empty v-if="topics.data.length == 0" />
        <Link v-for="topic in topics.data" :href="route('post', { group: group.id, topic: topic.id })" class="w-full">
        <Card class="  p-2 w-full border-none flex-row group hover:bg-lavender hover:text-black">
            <span class="icon-[material-symbols--topic] size-15 mr-4"></span>
            <div class="flex flex-col justify-around mr-auto">
                <span class="font-bold text-lg">{{ topic.title }}</span>
                <p class="text-charcoal-500">
                    <span class="icon-[material-symbols--convert-to-text] align-sub"></span> by
                    <span class="text-lavender group-hover:text-black">{{ topic.user.name }}</span> --
                    {{ dayjs(topic.created_at).format("dddd MMM DD, YYYY HH:mm") }}
                </p>
            </div>
        </Card>
        </Link>
        <ReuseTemplate />
    </Common>
</template>
