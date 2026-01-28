<template>
    <div>
        <ToastProvider 
                :duration="duration" 
                :swipe-direction="swipeDirection"
            >
            <ToastRoot 
                class="toast__item"
                :type="type" 
                :default-open="defaultOpen" 
                :open="isOpen"
                @update:open="(value) => {
                    isOpen = value;
                    emits('update:open', value);
                }"
            >
                <ToastTitle class="toast__title">{{ title }}</ToastTitle>
                <ToastDescription class="toast__description">{{ description }}</ToastDescription>
            </ToastRoot>
            <ToastPortal :to="to">
                <ToastViewport 
                    :class="{
                        'toast--error': severity == 'error',
                        'toast--success': severity == 'success',
                    }" 
                />
            </ToastPortal>
        </ToastProvider>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import { 
    ToastPortal, 
    ToastProvider, 
    ToastRoot, 
    ToastTitle, 
    ToastDescription, 
    ToastViewport
} from "reka-ui";

import type { ToastSeverityType } from "@/types/ui";

type ToastType = "foreground" | "background";

const { 
    to = "body", 
    type = "foreground",
    severity,
    swipeDirection = "down",
    defaultOpen = undefined, 
    open = undefined,
} = defineProps<{
    to?: string;
    severity?: ToastSeverityType;
    type?: ToastType;
    swipeDirection?: "right" | "left" | "up" | "down";
    defaultOpen?: boolean;
    duration?: number;
    title?: string;
    description?: string;
    open?: boolean;
}>(); 

const emits = defineEmits<{
    (e: "update:open", value: boolean): void;
}>();

const isOpen = ref<boolean | undefined>(Boolean(open || defaultOpen || undefined));
</script>
