<template>
    <div class="form">
        <div v-if="form.hasErrors">{{ form.errors }}</div>
        <div class="form__control">
            <label>E-Mail *</label>
            <input type="email" v-model="form.email" />
        </div>
        <div class="form__control">
            <label>Passwort *</label>
            <input type="password" v-model="form.password" />
        </div>
        <button type="button" @click="onSubmit">Einloggen</button>
    </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
});

function onSubmit(): void {
    form.post('/login');
}
</script>

<style scoped lang="scss">
button {
    margin-top: 14px;
}
</style>
