<script setup>
import { computed, watch, nextTick } from "vue";
import DOMPurify from "dompurify";
import { useZoom } from "@/Composables/ZoomSingleton";

const props = defineProps({
    markdown: String,
});

const parseMarkdown = (markdown) => {
    return markdown
        .replace(/^# (.*$)/gm, "<h1 class='inline text-4xl font-bold'>$1</h1>")
        .replace(/^## (.*$)/gm, "<h2 class='inline text-3xl font-semibold'>$1</h2>")
        .replace(/^### (.*$)/gm, "<h3 class='inline text-2xl font-medium'>$1</h3>")
        .replace(/^#### (.*$)/gm, "<h4 class='inline text-xl font-medium'>$1</h4>")
        .replace(/^##### (.*$)/gm, "<h5 class='inline text-lg font-medium'>$1</h5>")
        .replace(/^###### (.*$)/gm, "<h6 class='inline text-md font-medium'>$1</h6>")
        .replace(/\*\*(.*?)\*\*/g, "<b class='font-bold'>$1</b>")
        .replace(/\*(.*?)\*/g, "<i class='italic'>$1</i>")
        .replace(/^> (.*$)/gm, "<blockquote class='border-l-4 border-gray-400 pl-4 italic'>$1</blockquote>")
        .replace(/(?:^- (.*$)\n?)+/gm, (match) => {
            const items = match
                .trim()
                .split("\n")
                .map(item => `<li class='list-disc ml-5'>${item.replace(/^- /, "")}</li>`)
                .join("");
            return `<ul>${items}</ul>`;
        })
        .replace(/!\[(.*?)\]\((.*?)\)(?:\{(.*?)\})?/g, (match, alt, src, style) => {
            const styleAttr = style ? ` style="${style.trim()}"` : "";
            return `<img src='${src}' alt='${alt}' class='max-w-full rounded-md cursor-zoom-in' data-zoomable${styleAttr} />`;
        })
        .replace(/\[(.*?)\]\((.*?)\)/g, "<a href='$2' class='underline'>$1</a>")
        .replace(/\[color=(#?[0-9a-fA-F]{3,6})](.*?)\[\\color]/g, "<span style='color:$1;'>$2</span>")
        .replace(/\n/g, "<br>");
};

const sanitizedContent = computed(() => {
    return DOMPurify.sanitize(parseMarkdown(props.markdown));
    // return parseMarkdown(props.markdown)
});

const { initZoom } = useZoom();

watch(sanitizedContent, async () => {
    await nextTick(); // Wait for the DOM to update
    initZoom();
});
</script>

<template>
    <div class="p-4">
        <div class="pl-2 rounded-md" v-html="sanitizedContent"></div>
    </div>
</template>
