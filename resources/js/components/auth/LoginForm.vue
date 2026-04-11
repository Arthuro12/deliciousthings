<template>
    <form 
        class="form__group"
        @submit.prevent="onSubmit"
    >
        <ShowError v-if="loginErrorMessage" :message="loginErrorMessage" />
        <div class="form__control">
            <TextField
                id="email"
                type="email"
                label="E-Mail *"
                :error="!!form.errors.email"
                v-model.trim="form.email" 
            >
                <template #helper>
                    <HelperText 
                        v-if="form.errors.email" 
                        class="form__helper-text" 
                        variant="error"
                        :text="form.errors.email" 
                    />
                </template>
            </TextField>
        </div>
        <div class="form__control">
            <PasswordInput 
                v-model.trim="form.password" 
                :error="form.errors.password" 
            >
                <template #helper>
                    <HelperText
                        v-if="form.errors.password" 
                        class="form__helper-text"
                        variant="error" 
                        :text="form.errors.password" 
                    />
                </template>
            </PasswordInput>
            <Link class="link--primary" href="">Passwort vergessen?</Link>
        </div>
        <AppButton
            type="submit"
            variant="primary"
            size="medium"
        >
            <template #text>Einloggen</template>
        </AppButton>
        <Link class="link--primary" href="/register">Neues Konto erstellen</Link>
    </form>
</template>

<script setup lang="ts">
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { usePage, useForm } from "@inertiajs/vue3";

import AppButton from "@/components/presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";
import PasswordInput from "@/components/presentation/PasswordInput.vue";
import ShowError from "@/components/presentation/ShowError.vue";
import HelperText from "@/components/presentation/HelperText.vue";

import { FORM_ERRORS } from "@/constants";

const form = useForm({
    email: '',
    password: '',
});

const page = usePage();

/**
 * The error message to display if the connection fails.
 */
const loginErrorMessage = computed(() => page.props.errors?.login?.message);

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
       onError: () => {}
    });
}
</script>