<template>
    <div class="form auth-form">
        <div class="form__control">
            <label for="first-name">Vorname *</label>
            <input type="text" id="first-name" v-model="form.first_name" />
        </div>
        <div class="form__control">
            <label for="last-name">Nachname *</label>
            <input type="text" id="last-name" v-model="form.last_name" />
        </div>
        <div class="form__control">
            <label for="email">E-Mail *</label>
            <input type="email" id="email" v-model="form.email" />
        </div>
        <div class="form__control">
            <label for="password">Passwort *</label>
            <input type="password" id="password" v-model="form.password" />
        </div>
        <p class="info-text">Sie haben bereits ein Konto? <Link href="/login">Anmelden</Link></p>
        <p>Hier kommt ein infotext mit Erklärung zur AGBs und -Datenschutzerklärung-Genehmigung.</p>
        <button class="button button--primary" type="button" @click="onSubmit">Registrieren</button>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
});

function onSubmit(): void {
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
