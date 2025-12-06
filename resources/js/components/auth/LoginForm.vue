<template>
    <form class="form__group auth-form">
        <ShowError v-if="authenticationFailed" :message="FORM_ERRORS.FAILED" />
        <div class="form__control">
            <label for="email">E-Mail *</label>
            <input 
                :class="{
                    'is-invalid': hasRequiredError(form.errors.email || '')
                }" 
                type="email" 
                id="email" 
                v-model.trim="form.email" 
            />
            <HelperText v-if="hasRequiredError(form.errors.email || '')" class="form__helper-text" :text="FORM_ERRORS.REQUIRED" />
        </div>
        <div class="form__control">
            <label for="password">Passwort *</label>
            <input 
                :class="{
                    'is-invalid': hasRequiredError(form.errors.password || '')
                }" 
                type="password" 
                id="password" 
                v-model.trim="form.password" 
            />
            <HelperText v-if="hasRequiredError(form.errors.password || '')" class="form__helper-text" :text="FORM_ERRORS.REQUIRED" />
            <Link href="">Passwort vergessen?</Link>
        </div>
        <AppButton
            type="submit"
            variant="primary"
            layout="text"
            @click.prevent="onSubmit"
        >
            <template #text>Einloggen</template>
        </AppButton>
        <Link href="/register">Neues Konto erstellen</Link>
    </form>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

import AppButton from "@/components/presentation/AppButton.vue";
import ShowError from "@/components/presentation/ShowError.vue";
import HelperText from "@/components/presentation/HelperText.vue";

import { FORM_ERRORS } from "@/constants";
import { hasRequiredError } from "@/utils/forms";

const form = useForm({
    email: '',
    password: '',
});

const authenticationFailed = ref(false);

async function onSubmit(): Promise<void> {
    form.clearErrors();
    if (!form.email) {
        form.setError('email', FORM_ERRORS.REQUIRED);
        return;
    }
    if (!form.password) {
        form.setError('password', FORM_ERRORS.REQUIRED);
        return;
    }

    await fetch("/sanctum/csrf-cookie");

    form.post('/login', {
        onError: () => {
            authenticationFailed.value = true;
        }
    });
}
</script>