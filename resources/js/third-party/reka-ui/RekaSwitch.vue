<template>
    <SwitchRoot class="switch" v-model="modelValue">
        <label class="switch__label">{{ label }}</label>
        <SwitchThumb class="switch__thumb" />
    </SwitchRoot>
</template>

<script setup lang="ts">
import { SwitchRoot, SwitchThumb } from "reka-ui";

defineProps<{
    label: string;
}>();

const modelValue = defineModel<boolean | null>({ default: null, });
</script>

<style scoped lang="scss">
.switch {
    --switch-width: 40px;
    --switch-height: 24px;
    --switch-padding: 3px;
}

.switch {
    position: relative;
    background: none;
    border: 1px solid var(--color-neutral-0);
    padding: 0;
    display: inline-flex;
    align-items: center;
    gap: 12px;

    * {
        cursor: pointer;
    }

    &__label {
        color: var(--color-neutral-50);
    }

    &__thumb {
        position: absolute;
        left: var(--switch-padding);
        top: 50%;
        transform: translateY(-50%);
        width: calc(var(--switch-height) - var(--switch-padding) * 2);
        height: calc(var(--switch-height) - var(--switch-padding) * 2);
        background-color: var(--color-neutral-0);
        border-radius: 50%;
        box-shadow: 0 2px 6px var(--colro-neural-50);
        transition: transform 0.25s ease;
    }
}

.switch::before {
    display: inline-block;
    content: "";
    width: var(--switch-width);
    height: var(--switch-height);
    background-color: var(--color-neutral-10);
    border-radius: 9999px;
    transition: background-color 0.25s ease;
}

.switch[data-state="checked"]::before {
    background-color: var(--color-primary-50);
}

.switch[data-state="checked"] .switch__thumb {
    transform: translate(
        calc(var(--switch-width) - var(--switch-height)),
        -50%
    );
}

.switch:hover::before {
    filter: brightness(0.95);
}

.switch:focus-visible::before {
    outline: 3px solid var(--color-primary-30);
    outline-offset: 2px;
}
</style>