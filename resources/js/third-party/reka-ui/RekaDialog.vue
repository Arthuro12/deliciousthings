<template>
    <div class="dialog">
        <DialogRoot v-model:open="isOpen">
            <slot name="trigger"></slot>
            <DialogPortal>
                <DialogOverlay class="app-overlay dialog-overlay">
                    <div class="content-wrapper">
                        <DialogContent class="dialog__content" :class="contentClass">
                            <div>
                                <div class="dialog__title">
                                    <DialogTitle as="h4">{{ title }}</DialogTitle>
                                    <DialogClose class="dialog__close-button"><XIcon color="#e680a5" /></DialogClose>
                                </div>
                                <DialogDescription class="dialog__description" v-if="description">{{ description }}</DialogDescription>
                            </div>
                            <slot></slot>
                        </DialogContent>       
                    </div>
                </DialogOverlay>
            </DialogPortal>
        </DialogRoot>
    </div>
</template>

<script setup lang="ts">
import { 
    DialogRoot,
    DialogPortal, 
    DialogOverlay,
    DialogContent,
    DialogTitle,
    DialogDescription,
    DialogClose,
} from "reka-ui";

import { XIcon } from "lucide-vue-next";

import type { VueClass } from "@/types/ui";

defineProps<{
    title: string;
    description?: string;
    contentClass?: VueClass;
}>();

const isOpen = defineModel<boolean>("open", { required: false, });
</script>