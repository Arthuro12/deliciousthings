<template>
    <CollapsibleRoot v-model:open="isOpen">
        <CollapsibleTrigger :class="triggerButtonClass">
            <slot name="trigger"></slot>
        </CollapsibleTrigger>   
        <CollapsibleContent :class="contentClass"><slot name="content"></slot></CollapsibleContent>
    </CollapsibleRoot>
</template>

<script setup lang="ts">
import {
    CollapsibleRoot,
    CollapsibleTrigger,
    CollapsibleContent,
} from "reka-ui";

import type { VueClass } from "@/types/ui";

defineProps<{
    triggerButtonClass?: VueClass;
    contentClass?: VueClass;
}>();

const isOpen = defineModel<boolean>("open", { default: false });
</script>
