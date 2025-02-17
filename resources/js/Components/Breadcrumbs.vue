<script setup>
import { computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';

const page = usePage();

const breadcrumbs = computed(() => {
    const crumbs = [{ name: "Home Index", path: "/group" }];

    if (page.props.group) {
        crumbs.push({
            name: page.props.group.title,
            path: `/group/${page.props.group.id}/topic`
        });
    }

    if (page.props.topic) {
        crumbs.push({
            name: page.props.topic.title,
            path: `/group/${page.props.group.id}/topic/${page.props.topic.id}/post`
        });
    }

    return crumbs;
});
</script>

<template>
    <nav class="text-sm pl-4">
        <span>Currently in: </span>
        <template v-for="(crumb, index) in breadcrumbs" :key="index">
            <span v-if="index > 0"> / </span>
            <Link :href="crumb.path" class="text-sky-500 hover:underline">{{ crumb.name }}</Link>
        </template>
    </nav>
</template>
