<script setup>
import { computed } from "vue"
import Card from '@/Components/Card.vue';
import Markdown from '@/Components/Markdown.vue';
import Common from '@/Layouts/Common.vue';
import dayjs from 'dayjs';

const possibleMissingAboutMe = [
    "Whoops, looks like this user is a mystery!",
    "Nothing to see here...",
    "Nothing here, or is there?"
]
const randomMessage = computed(() => {
    const random = Math.floor(Math.random() * possibleMissingAboutMe.length);
    return possibleMissingAboutMe[random];
})
</script>

<template>
    <Common>
        <div class="grid grid-cols-4 gap-4">
            <Card>
                <img :src="$page.props.auth.user.avatar" alt="Profile Avatar" class="rounded-full">
                <p class="text-xl">Display Name</p>
                <p class="text-md text-charcoal-500">Username</p>
                <p class="text-xs">An active member since {{ dayjs($page.props.auth.user.created_at)
                    .format("DD MMM YYYY")
                    }}</p>
            </Card>
            <Card class="col-span-3 flex flex-col pl-3 overlfow-y-auto">
                <h1>About me</h1>
                <Markdown :markdown="$page.props.auth.user.about_me ?? `# [color=#cb4c4e]${randomMessage}[\\color]`" />
            </Card>
        </div>
    </Common>
</template>