<template>
    <div>
        <label for="password">Passwort *</label>
        <div 
            class="input-wrapper input--focused"
            :class="{ 'is-invalid': error }"
            :tabindex="-1"
        >
            <input 
                class="password-input"
                id="password"
                :type="showPassword ? 'text' : 'password'" 
                v-model="modelValue"
            />
            <AppButton
                v-if="showRevealIcon"
                class="reveal-icon"
                type="button"
                layout="icon"
                @click="showPassword = !showPassword"
            >
                <template #leading>
                    <EyeIcon 
                        v-if="showPassword" 
                        :size="24" 
                        color="#000000"
                    />
                    <EyeClosedIcon 
                        v-else
                        :size="24" 
                        color="#000000" 
                    />
                </template>
            </AppButton>
        </div>
        <slot name="helper"></slot>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";

import { EyeIcon, EyeClosedIcon } from "lucide-vue-next"; 

import AppButton from "./AppButton.vue";

defineProps<{
    error?: boolean;
}>();

const modelValue = defineModel<string | undefined>();

const showPassword = ref(false);

const showRevealIcon = computed(() => !!(modelValue.value && modelValue.value.length > 0));
</script>

<style scoped lang="scss">
@use "../../../css/abstracts/breakpoints" as breakpoints;

input[type="password"] {
    ::-ms-reveal {
        opacity: 0;
    }
    
    &:focus,
    &:focus-visible {
        border: none;
        box-shadow: none;
    }
}

.input-wrapper {
    display: flex;
    position: relative;
    border: 1px solid var(--color-neutral-20);
    border-radius: 5px;

    &:focus-within {
        border-width: 2px;
        border-color: var(--color-primary-50);
        box-shadow: 0 0 0 2px var(--color-primary-10);
    }

    .password-input {
        border: none;
        outline: none;
        width: 85%;

        @include breakpoints.respond-to("medium") {
            width: 90%;
        }
    }

    .reveal-icon {
        position: absolute;
        right: 10px;
        top: 13px;
        width: fit-content;
        height: fit-content;
        padding: 0;
    }
}

.is-invalid {
    border: 2px solid var(--color-input-error);
    
    &:focus-within {
        outline: none;
    }
}
</style>