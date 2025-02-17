<script setup>
import Card from "@/Components/Card.vue";
import Common from "@/Layouts/Common.vue";
import Markdown from "@/Components/Markdown.vue";
import { useForm } from "@inertiajs/vue3";
import MarkdownEditor from '@/Components/MarkdownEditor.vue'
defineProps({
    group: Object,
    topic: Object,
})

const form = useForm({
    content: "",
})
</script>

<template>
    <Common :errors="$page.props.errors">
        <Card>
            <h1 class="font-bold">Preview</h1>
            <Markdown :markdown="form.content"></Markdown>
        </Card>
        <Card>
            <h1 class="text-lg font-bold mb-4">Reply to a posts / topic</h1>
            <MarkdownEditor v-model="form.content" />
            <button @click="form.post(route('post.store', { group: group.id, topic: topic.id }))"
                class="text-black bg-lavender mt-4 p-2 rounded-lg font-bold cursor-pointer">Create</button>
        </Card>
    </Common>
</template>
