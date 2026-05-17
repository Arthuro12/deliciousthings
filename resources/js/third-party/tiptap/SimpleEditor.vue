<template>
    <div class="rich-text-editor" :tabindex="-1">
        <EditorContent class="editor-content" :editor="editor" />
    </div>
</template>

<script setup lang="ts">
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";

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
</script>

<style scoped lang="scss">
.rich-text-editor {
    border: 1px solid var(--color-neutral-20);
    border-radius: 12px;
    width: 100%;

    &focus,
    &:focus-within {
        outline: none;
        border: 2px solid var(--color-primary-50);
        box-shadow: 0 0 0 2px var(--color-primary-10);
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