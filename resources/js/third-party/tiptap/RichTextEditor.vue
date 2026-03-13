<template>
    <div class="rich-text-editor">
        <div class="rich-text-editor__marks">
            <button type="button" @click="toggleBold"><BoldIcon color="#000000" :size="14" /></button>
            <button type="button" @click="toggleItalic"><ItalicIcon color="#000000" :size="14" /></button>
            <button type="button" @click="toggleUnderline"><UnderlineIcon color="#000000" :size="14" /></button>
            <button type="button" @click="toggleBulletList"><ListIcon color="#000000" :size="14" /></button>
        </div>
        <EditorContent class="editor-content" :editor="editor" />
    </div>
</template>

<script setup lang="ts">
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";

import { BoldIcon, ItalicIcon, ListIcon, UnderlineIcon } from "lucide-vue-next";

const { content } = defineProps<{
    content: string;
}>();

const emit = defineEmits<{
    (e: "update:content", value: string): void;
}>();

const editor = useEditor({
    content: content,
    extensions: [StarterKit],
    onUpdate: () => {
        emit("update:content", editor.value?.getHTML() ?? "");
    }
});

function toggleBold(): void {
    editor.value?.chain().focus().toggleBold().run();
}

function toggleBulletList(): void {
    editor.value?.chain().focus().toggleBulletList().run();
}

function toggleItalic(): void {
    editor.value?.chain().focus().toggleItalic().run();
}

function toggleUnderline(): void {
    editor.value?.chain().focus().toggleUnderline().run();
}
</script>

<style scoped lang="scss">
.rich-text-editor {
    border: 1px solid var(--color-neutral-50);
    border-radius: 12px;
    width: 100%;

    &__marks {
        display: flex;
        justify-content: start;
        column-gap: 5px;
        padding: 12px;
        border-bottom: 1px solid var(--color-neutral-50);
    }
}

.editor-content {
    padding: 5px;
}

.editor-content :deep(.tiptap) {
    max-height: 200px;
    height: 100%;
    overflow: auto;
    padding: 12px;

    ul {
        padding-left: 24px;
    }
    
    &:focus-visible,
    p:focus-visible {
        outline: none;
    }
}
</style>