<template>
    <div>
        <DialogRoot v-model:open="isOpen">
            <slot name="trigger"></slot>
            <DialogPortal>
                <DialogOverlay class="app-overlay" />
                <DialogContent class="dialog__content">
                    <div>
                        <div class="dialog__title">
                            <DialogTitle as="h4">{{ title }}</DialogTitle>
                            <DialogClose class="dialog__close-button"><XIcon color="#e680a5" /></DialogClose>
                        </div>
                        <div>
                            <DialogDescription as="div"><slot name="description"></slot></DialogDescription>
                        </div>
                    </div>
                    <slot></slot>
                </DialogContent>
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

defineProps<{
    title: string;
}>();

const isOpen = defineModel<boolean>("open", { required: false, });
</script>