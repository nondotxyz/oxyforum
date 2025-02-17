<template>
    <div class="w-full mx-auto">
        <div class="flex">
            <button v-for="(tab, index) in tabs" :key="index" @click="activeTab = tab"
                class="px-4 py-2 border-b-2 transition-colors duration-300"
                :class="activeTab === tab ? 'border-blue-500  ' : 'border-transparent   hover: '">
                {{ tab }}
            </button>
        </div>
        <div>
            <slot :name="activeTab"></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, watch } from 'vue';

const props = defineProps({
    tabs: Array,
    active: String
});

const activeTab = ref(props.active || props.tabs[0]);

watch(() => props.active, (newActive) => {
    if (props.tabs.includes(newActive)) {
        activeTab.value = newActive;
    }
});
</script>
