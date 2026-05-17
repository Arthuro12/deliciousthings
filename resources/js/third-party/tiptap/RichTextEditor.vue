<template>
    <div class="rich-text-editor" :tabindex="-1">
        <div class="rich-text-editor__marks">
            <button 
                class="marks__button"
                type="button" 
                @click="toggleBold"
            >
                <BoldIcon 
                    :color="isBoldActive ? '#e680a5' : '#000000'" 
                    :size="14" 
                />
            </button>
            <button 
                class="marks__button"
                type="button" 
                @click="toggleItalic"
            >
                <ItalicIcon 
                    :color="isItalicActive ? '#e680a5' : '#000000'"
                    :size="14" 
                />
            </button>
            <button 
                class="marks__button"
                type="button" 
                @click="toggleUnderline"
            >
                <UnderlineIcon 
                    :color="isUnderlineActive ? '#e680a5' : '#000000'"
                    :size="14" 
                />
            </button>
            <button 
                class="marks__button"
                type="button" 
                @click="toggleBulletList"
            >
                <ListIcon 
                    :color="isBulletListActive ? '#e680a5' : '#000000'" 
                    :size="14" 
                />
            </button>
        </div>
        <EditorContent class="editor-content" :editor="editor" />
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

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

const isBoldActive = computed(() => !!editor.value?.isActive("bold"));

const isBulletListActive = computed(() => !!editor.value?.isActive("bulletList"));

const isItalicActive = computed(() => !!editor.value?.isActive("italic"));

const isUnderlineActive = computed(() => !!editor.value?.isActive("underline"));

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
    border: 1px solid var(--color-neutral-20);
    border-radius: 12px;
    width: 100%;

    &focus,
    &:focus-within {
        outline: none;
        border: 2px solid var(--color-primary-50);
        box-shadow: 0 0 0 2px var(--color-primary-10);
    }

    &__marks {
        display: flex;
        justify-content: start;
        column-gap: 5px;
        padding: 12px;
        border-bottom: 1px solid var(--color-neutral-20);

        > .marks__button {
            padding: 4px;

            &:hover {
                background-color: var(--color-primary-10);
                border-radius: 5px;
            }
        }
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

.is-active {
    color: var(--color-primary-50);;
}
</style>