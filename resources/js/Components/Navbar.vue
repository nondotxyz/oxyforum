<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Card from '../Components/Card.vue';
import Breadcrumbs from '../Components/Breadcrumbs.vue'
const user = usePage().props.auth.user;
</script>

<template>
    <div>
        <Card class="w-full border-none text-black flex-row justify-between flex-wrap bg-sky">
            <span class="font-title text-4xl">OXYFORUM</span>
            <Link :href="route('profile')">
            <div class="flex gap-2 items-center">
                <div class="font-bold">{{ user.name }}</div>
                <img :src="user.avatar_url" class="rounded-full size-10">
            </div>
            </Link>
        </Card>
        <Breadcrumbs />
    </div>
</template>
