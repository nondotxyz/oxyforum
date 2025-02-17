<script setup>
import { useTextareaAutosize } from "@vueuse/core"
const model = defineModel({ type: String })
const { textarea: textareaRef } = useTextareaAutosize();


const insertText = (tag) => {
    const textarea = textareaRef.value;
    if (!textarea) return;

    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selectedText = model.value.substring(start, end);

    let formattedText = "";

    if (tag === "bold") formattedText = `**${selectedText || "Bold Text"}**`;
    if (tag === "italic") formattedText = `*${selectedText || "Italic Text"}*`;
    if (tag === "underline") formattedText = `<u>${selectedText || "Underlined Text"}</u>`;
    if (tag === "image") formattedText = `![](${selectedText || "https://placehold.co/100x100"})`
    if (tag.startsWith("h")) {
        const level = tag.replace("h", "");
        formattedText = `${"#".repeat(level)} ${selectedText || `Heading ${level}`}`;
    }

    model.value =
        model.value.substring(0, start) + formattedText + model.value.substring(end);

    setTimeout(() => {
        textarea.selectionStart = textarea.selectionEnd = start + formattedText.length;
        textarea.focus();
    }, 0);
};
</script>

<template>
    <div class="flex gap-2 mb-2">
        <button id="action_button" @click="insertText('bold')">
            <span class="icon-[material-symbols--format-bold] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('italic')">
            <span class="icon-[material-symbols--format-italic] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('underline')">
            <span class="icon-[material-symbols--format-underlined] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('h1')">
            <span class="icon-[material-symbols--format-h1] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('h2')">
            <span class="icon-[material-symbols--format-h2] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('h3')">
            <span class="icon-[material-symbols--format-h3] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('h4')">
            <span class="icon-[material-symbols--format-h4] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('h5')">
            <span class="icon-[material-symbols--format-h5] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('h6')">
            <span class="icon-[material-symbols--format-h6] action_icon"></span>
        </button>
        <button id="action_button" @click="insertText('image')">
            <span class="icon-[material-symbols--image-rounded] action_icon"></span>
        </button>
    </div>
    <textarea name="content" id="content" class="bg-neutral-900 w-full p-2 min-h-70 resize-none"
        placeholder="Post your content here..." ref="textareaRef" v-model="model"></textarea>
</template>
