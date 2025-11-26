<template>
    <div class="form auth-form">
        <div class="form__control">
            <label for="first-name">Vorname *</label>
            <input 
               :class="{
                    'is-invalid': hasRequiredError(form.errors.first_name || '')
                }" 
                type="text" 
                id="first-name" 
                v-model.trim="form.first_name" 
            />
            <HelperText v-if="hasRequiredError(form.errors.first_name || '')" class="form__helper-text" :text="FORM_ERRORS.REQUIRED" />
        </div>
        <div class="form__control">
            <label for="last-name">Nachname *</label>
            <input 
               :class="{
                    'is-invalid': hasRequiredError(form.errors.last_name || '')
                }" 
                type="text" 
                id="last-name"
                v-model.trim="form.last_name" 
            />
            <HelperText v-if="hasRequiredError(form.errors.last_name || '')" class="form__helper-text" :text="FORM_ERRORS.REQUIRED" />
        </div>
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
        </div>
        <p>Sie haben bereits ein Konto? <Link href="/login">Anmelden</Link></p>
        <p>Hier kommt ein infotext mit Erklärung zur AGBs und -Datenschutzerklärung-Genehmigung.</p>
        <AppButton
            type="button"
            variant="primary"
            layout="text"
            @click="onSubmit"
        >
            <template #text>Registrieren</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import AppButton from "@/components/presentation/AppButton.vue"; 
import HelperText from "../presentation/HelperText.vue";

import { FORM_ERRORS } from "@/constants";
import { hasRequiredError } from "@/utils/forms";

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
});

function onSubmit(): void {
    form.clearErrors();
    if (!form.first_name) {
        form.setError('first_name', FORM_ERRORS.REQUIRED);
        return;
    }
    if (!form.last_name) {
        form.setError('last_name', FORM_ERRORS.REQUIRED);
        return;
    }
    if (!form.email) {
        form.setError('email', FORM_ERRORS.REQUIRED);
        return;
    }
    if (!form.password) {
        form.setError('password', FORM_ERRORS.REQUIRED);
        return;
    }

    form.post('/register');
}
</script>

<style scoped lang="scss">
button {
    margin-top: 14px;
}

.info-text > a {
    display: inline;
}
</style>
