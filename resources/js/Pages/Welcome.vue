<script setup>
import Card from "../Components/Card.vue";
import { Link } from "@inertiajs/vue3"
</script>

<template>
    <div class="flex min-h-screen items-center justify-center px-4">
        <Card class="w-full max-w-sm rounded-2xl p-8 shadow-lg  ">
            <h1 class="mb-6 text-center text-2xl font-semibold  ">
                Login to <span class="font-title text-white">OXYFORUM</span>
            </h1>
            <div class="flex flex-col gap-4">
                <a href="/oauth/google"
                    class="flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-white transition border border-white hover:border-russian  ">
                    <span class="icon-[devicon--google] text-lg"></span> Login with Google
                </a>
            </div>
        </Card>
    </div>
</template>
