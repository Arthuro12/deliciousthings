<template>
    <div>
        <div>
            <label :for="id">
                <UploadIcon />
                <p>{{ label ?? `${multiple ? 'Dateien' : 'Datei'} auswählen` }}</p>
            </label>
            <input 
                hidden
                type="file" 
                :id="id"
                :accept="accept" 
                multiple
                @input="onUpdate"
            />
            <slot name="helper"></slot>
        </div>
        <template v-if="modelValue">
            <div class="preview" v-for="(file, idx) in (Array.isArray(modelValue)) ? modelValue : [modelValue]" :key="`${file.name}-${idx}`">
                <img class="preview__img" :alt="file.name" :src="createFileUrl(file)" />
                <p class="preview__text" :style="{ 'font-size': '14px'  }">{{ file.name }}</p>
                <AppButton 
                    class="delete-button"
                    type="button" 
                    layout="icon"
                    variant="secondary"
                    @click="removeFile(idx)" 
                >
                    <template #leading>
                        <TrashIcon :size="20" />
                    </template>
                </AppButton>
            </div>
        </template>
    </div>
</template>

<script setup lang="ts">
import { UploadIcon, TrashIcon } from "lucide-vue-next";

import AppButton from "./AppButton.vue";

import type { FileValue } from "@/types/ui";

const { multiple = false } = defineProps<{
    id: string;
    label?: string;
    accept: string; 
    /**
     * Whether multiple files can be selected or not.
     */
    multiple?: boolean;
}>();

const modelValue = defineModel<FileValue>("modelValue", { required: true });

/**
 * Triggers updates on the `modelValue`.
 * @param event 
 */
function onUpdate(event: Event): void {
    const files = Array.from((event.target as HTMLInputElement)?.files ?? []);
    if (multiple && Array.isArray(modelValue.value)) {
        modelValue.value = [...modelValue.value, ...files];
    }
}

function removeFile(index: number): void {
    if (multiple && Array.isArray(modelValue.value)) {
        modelValue.value.splice(index, 1);
    }
}

/**
 * Creates URL for the given file.
 * @param file 
 */
function createFileUrl(file: File): string {
    return URL.createObjectURL(file);
}
</script>

<style scoped lang="scss">
label {
    display: flex;
    align-items: center;
    flex-direction: column;
    padding: 4rem;
    border: 1px dashed black;
    border-radius: 5px;
}

.preview {
    display: flex;
    column-gap: 5px;
    align-items: center;
    padding: 12px;
    margin-top: 16px;
    background-color: var(--color-primary-0);
    border-radius: 5px;

    &__img {
        width: 26px;
        height: 26px;
    }

    &__text {
        flex: 2;
    }
}
</style>