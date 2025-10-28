<template>
    <div class="form auth-form">
        <div v-if="form.hasErrors">{{ form.errors }}</div>
        <div class="form__control">
            <label for="email">E-Mail *</label>
            <input type="email" id="email" v-model="form.email" />
        </div>
        <div class="form__control">
            <label for="password">Passwort *</label>
            <input type="password" id="password" v-model="form.password" />
            <Link class="button button--primary" href="">Passwort vergessen?</Link>
        </div>
        <button type="button" @click="onSubmit">Einloggen</button>
        <Link class="button button--primary" href="/register">Neues Konto erstellen</Link>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: '',
    password: '',
});

function onSubmit(): void {
    form.post('/login');
}
</script>
