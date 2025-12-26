<template>
    <div class="form__group">
        <slot name="header"></slot>
        <FileUpload
            id="gallery"
            accept=".jpg, .jpeg, .png"
            multiple
            :model-value="selectedFiles"
        />
        <slot name="action" :data="selectedFiles"></slot>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import FileUpload from "../presentation/FileUpload.vue"; 

import type { FileValue } from "@/types/ui";

const selectedFiles = ref<FileValue>([]);
</script>
