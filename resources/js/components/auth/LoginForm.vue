<template>
    <form class="form__group">
        <ShowError v-if="loginErrorMessage" :message="loginErrorMessage" />
        <div class="form__control">
            <label for="email">E-Mail *</label>
            <input 
                :class="{
                    'is-invalid': form.errors.email
                }" 
                type="email" 
                id="email" 
                v-model.trim="form.email" 
                required
            />
            <HelperText v-if="form.errors.email" class="form__helper-text" :text="form.errors.email" />
        </div>
        <div class="form__control">
            <label for="password">Passwort *</label>
            <input 
                :class="{
                    'is-invalid': form.errors.password
                }" 
                type="password" 
                id="password" 
                v-model.trim="form.password" 
            />
            <HelperText v-if="form.errors.password" class="form__helper-text" :text="form.errors.password" />
            <Link class="link--primary" href="">Passwort vergessen?</Link>
        </div>
        <AppButton
            type="submit"
            variant="primary"
            size="medium"
            @click.prevent="onSubmit"
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