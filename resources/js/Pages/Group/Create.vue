<script setup>
import Card from "@/Components/Card.vue";
import Common from "@/Layouts/Common.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    title: "",
    description: ""
})
</script>

<template>
    <Common>
        <Card class="p-4">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="title" class="mb-1 text-sm font-medium">Title</label>
                    <input type="text" id="title" class="bg-neutral-900 p-2 rounded w-full" v-model="form.title" />
                </div>
                <div class="flex flex-col">
                    <label for="description" class="mb-1 text-sm font-medium">Description</label>
                    <input type="text" id="description" class="bg-neutral-900 p-2 rounded w-full"
                        v-model="form.description" />
                </div>
                <div class="flex justify-end">
                    <button @click="form.post(route('group.store'))"
                        class="text-black bg-lavender mt-4 p-2 rounded-lg font-bold cursor-pointer">Create</button>
                </div>
            </div>
        </Card>
    </Common>
</template>
