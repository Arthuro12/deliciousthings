<template>
    <TextField
        class="password-input"
        id="password"
        :type="showPassword ? 'text' : 'password'"
        label="Passwort *"
        :error="!!error"
        v-model="modelValue"
    >
        <template #icon>
            <AppButton
                class="password-input__icon"
                type="button"
                layout="icon"
                @click="showPassword = !showPassword"
            >
                <template #leading>
                    <EyeClosedIcon v-if="!showPassword" :size="24" />
                    <EyeIcon v-else :size="24" />
                </template>
            </AppButton>
        </template>
        <template #helper>
            <slot name="helper"></slot>
        </template>
    </TextField>
</template>

<script setup lang="ts">
import { ref } from "vue";

import { EyeIcon, EyeClosedIcon } from "lucide-vue-next"; 

import TextField from "./TextField.vue";
import AppButton from "./AppButton.vue";

defineProps<{
    error?: string;
}>();

const modelValue = defineModel<string | undefined>();
const showPassword = ref(false);
</script>

<style scoped lang="scss">
.password-input {
    position: relative;

    &__icon {
        position: absolute;
        right: 10px;
        top: 35px;
        width: fit-content;
        height: fit-content;
        padding: 0;
    }
}
</style>