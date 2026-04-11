<template>
    <div class="wrapper">
        <template v-if="variant != 'default'">
            <CircleAlertIcon :size="24" color="#f73003" />
        </template>
        <p :class="textClass">{{ text  }}</p>
    </div>
</template>

<script setup lang="ts">
import { CircleAlertIcon } from "lucide-vue-next";

import type { HelperTextProps } from "@/types/ui";

const { variant = "default", } = defineProps<HelperTextProps>();

const textClass = variant != "default" ? `text--${variant}` : "";
</script>

<style scoped lang="scss">
.wrapper {
    display: flex;
    align-items: center;
    column-gap: 4px;

    > .text {
        &--error {
            color: var(--color-input-error);
        }
    }
}
</style>