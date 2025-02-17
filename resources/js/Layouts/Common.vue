<script setup>
import { ref, onMounted, watch } from 'vue';
import Navbar from '@/Components/Navbar.vue';

const props = defineProps({
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const errorPopup = ref([]);

const displayErrors = () => {
    const errorsArray = [];
    Object.values(props.errors).forEach((err) => {
        if (Array.isArray(err)) {
            errorsArray.push(...err);
        } else {
            errorsArray.push(err);
        }
    });
    errorPopup.value = errorsArray;
    setTimeout(() => {
        errorPopup.value = [];
    }, 3000);
};

onMounted(displayErrors);
watch(() => props.errors, displayErrors, { deep: true });
</script>

<template>
    <div class="flex flex-col gap-4 px-4 py-2">
        <!-- Error popups -->
        <div v-if="errorPopup.length" class="fixed top-4 right-4 z-50 space-y-2">
            <TransitionGroup name="fade" tag="div">
                <div v-for="(error, index) in errorPopup" :key="index"
                    class="bg-red-600 text-white px-4 py-2 rounded shadow-lg">
                    {{ error }}
                </div>
            </TransitionGroup>
        </div>
        <Navbar />
        <slot></slot>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
