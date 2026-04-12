<template>
    <form class="form__group" @submit.prevent="onSubmit">
        <div class="form__control">
            <TextField
                id="first-name"
                type="text"
                label="Vorname *"
                :error="!!form.errors.first_name"
                v-model.trim="form.first_name"
            >
                <template #helper>
                    <HelperText 
                        v-if="form.errors.first_name" 
                        class="form__helper-text" 
                        variant="error"
                        :text="form.errors.first_name" 
                    />
                </template>
            </TextField>
        </div>
        <div class="form__control">
            <TextField
                id="last-name"
                type="text"
                label="Nachname *"
                :error="!!form.errors.last_name"
                v-model.trim="form.last_name"
            >
                <template #helper>
                    <HelperText 
                        v-if="form.errors.last_name" 
                        class="form__helper-text" 
                        variant="error"
                        :text="form.errors.last_name" 
                    />
                </template>
            </TextField>
        </div>
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
                v-model="form.password"
                :error="!!form.errors.password"
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
        </div>
        <p>Sie haben bereits ein Konto? 
            <Link 
                class="link--primary" 
                :class="classes.inline" 
                href="/login"
            >
                Anmelden
            </Link>
        </p>
        <AppButton
            type="submit"
            variant="primary"
            size="medium"
        >
            <template #text>Registrieren</template>
        </AppButton>
    </form>
</template>

<script setup lang="ts">
import { useCssModule } from "vue";

import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

import AppButton from "@/components/presentation/AppButton.vue"; 
import TextField from "@/components/presentation/TextField.vue";
import PasswordInput from "../presentation/PasswordInput.vue";
import HelperText from "@/components/presentation/HelperText.vue";

import { FORM_ERRORS } from "@/constants";

const classes = useCssModule();

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
</style>

<style module>
.inline {
    display: inline;;
}
</style>
