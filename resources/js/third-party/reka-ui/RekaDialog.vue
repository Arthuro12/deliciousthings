<template>
    <DialogRoot>
        <DialogTrigger as="div">
            <slot name="trigger"></slot>
        </DialogTrigger>
        <DialogPortal>
            <DialogOverlay class="app-overlay" />
            <DialogContent class="dialog__content">
                <div>
                    <div class="dialog__title">
                        <DialogTitle as="h4">{{ title }}</DialogTitle>
                        <DialogClose><XIcon /></DialogClose>
                    </div>
                    <div>
                        <DialogDescription as="div"><slot name="description"></slot></DialogDescription>
                    </div>
                </div>
                <slot></slot>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>

<script setup lang="ts">
import { 
    DialogRoot,
    DialogPortal, 
    DialogOverlay,
    DialogTrigger, 
    DialogContent,
    DialogTitle,
    DialogDescription,
    DialogClose,
} from "reka-ui";

import { XIcon } from "lucide-vue-next";

defineProps<{
    title: string;
    description?: string;
}>();
</script>