<script setup>
import dayjs from "dayjs"
import Card from "./Card.vue";
import Markdown from './Markdown.vue';
defineProps({
    model: Object
})
</script>

<template>
    <Card class="p-2 w-full flex-row">
        <div class="flex w-full">
            <div class="flex flex-col w-full">
                <h1 class="text-xl font-bold" v-if="model.title">{{ model.title }}</h1>
                <span class="text-xs text-charcoal-500"><span class="icon-[material-symbols--docs] align-middle"></span>
                    By <span class=" text-sky">{{ model.user.name }}</span>
                    -- {{ dayjs(model.created_at).format("ddd MMM D,YYYY h:mm a") }}</span>
                <Markdown :markdown="model.content"></Markdown>
            </div>
            <div class="flex flex-col w-80">
                <img :src="model.user.avatar_url" alt="User Avatar" class="bg-white size-15" data-zoomable>
                <h1 class="text-sky">{{ model.user.name }}</h1>
                <h1 class="text-charcoal-500 text-xs">User</h1>
                <h1 class="text-charcoal-500 text-xs">Joined at {{ dayjs(model.user.created_at)
                    .format("ddd MMM D,YYYY HH: mm a") }}</h1>
            </div>
        </div>
    </Card>
</template>
