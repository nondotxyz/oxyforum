<script setup>
import { ref, onMounted } from 'vue';
import Card from './Card.vue';

const quote = ref(null);

onMounted(async () => {
    try {
        const res = await fetch('https://dummyjson.com/quotes/random');
        if (!res.ok) throw new Error('Fetch failed');
        quote.value = await res.json();
    } catch (error) {
        console.error('Error fetching quote:', error);
    }
});
</script>

<template>
    <Card>
        <div v-if="quote">
            <p class="mb-4">This page is empty... Be the first to add something!</p>
            <p class="italic">
                "{{ quote.quote }}"
            </p>
            <p>- {{ quote.author }}</p>
        </div>
        <div v-else>
            <p>Loading...</p>
        </div>
    </Card>
</template>
