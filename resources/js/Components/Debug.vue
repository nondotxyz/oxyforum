<script setup>
import { ref, defineProps, computed } from "vue";

const props = defineProps({
    data: Object,
    level: {
        type: Number,
        default: 0,
    },
});

const expanded = ref({});

// Toggle a specific property
const toggle = (key) => {
    expanded.value[key] = !expanded.value[key];
};

// Determine if the value is an object/array
const isExpandable = (value) =>
    typeof value === "object" && value !== null && Object.keys(value).length > 0;
</script>

<template>
    <div class="debug-dump">
        <ul class="dump-list">
            <template v-for="(value, key) in data" :key="key">
                <li>
                    <button v-if="isExpandable(value)" @click="toggle(key)" class="toggle-btn">
                        {{ expanded[key] ? "▼" : "▶" }}
                    </button>
                    <span class="dump-key">{{ key }}:</span>
                    <span v-if="!isExpandable(value)" class="dump-value">{{ value }}</span>
                    <div v-if="expanded[key]" class="nested">
                        <DebugDump :data="value" :level="level + 1" />
                    </div>
                </li>
            </template>
        </ul>
    </div>
</template>

<style scoped>
.debug-dump {
    font-family: monospace;
    background: #1e1e1e;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    margin-left: 20px;
}

.dump-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.dump-key {
    font-weight: bold;
    color: #61dafb;
}

.dump-value {
    color: #e06c75;
}

.toggle-btn {
    background: none;
    border: none;
    color: #61dafb;
    cursor: pointer;
    margin-right: 5px;
    font-weight: bold;
}

.nested {
    margin-left: 20px;
}
</style>
