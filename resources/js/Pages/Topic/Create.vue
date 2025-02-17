<script setup>
import Card from "@/Components/Card.vue";
import Common from "@/Layouts/Common.vue";
import Markdown from "@/Components/Markdown.vue";
import { useForm } from "@inertiajs/vue3";
import MarkdownEditor from '@/Components/MarkdownEditor.vue'
defineProps({
    group: Object
})

const form = useForm({
    title: "",
    content: "",
})
</script>

<template>
    <Common>
        <Card>
            <h1 class="font-bold">Preview</h1>
            <Markdown :markdown="form.content"></Markdown>
        </Card>
        <Card>
            <h1 class="text-lg font-bold mb-4">POST A NEW TOPIC</h1>
            <div class="flex mb-2">
                <label for="title" class="mr-8">Title</label>
                <input type="text" name="title" id="title" class="bg-neutral-900 w-5xl" v-model="form.title" />
            </div>
            <MarkdownEditor v-model="form.content" />
            <button @click="form.post(route('topic.store', { group: group.id }))"
                class="text-black bg-lavender mt-4 p-2 rounded-lg font-bold cursor-pointer">Create</button>
        </Card>
    </Common>
</template>
