<template>
    <div class="form">
        <div v-if="form.hasErrors">{{ form.errors }}</div>
        <div class="form__control">
            <label>E-Mail</label>
            <input type="email" v-model="form.email" />
        </div>
        <div class="form__control">
            <label>Passwort</label>
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
.form {
    display: flex;
    flex-direction: column;
    row-gap: 16px;

    &__control {
        display: flex;
        flex-direction: column;
        row-gap: 8px;
        margin-bottom: 14px;
    }
}

input {
    border: 1px solid black;
    border-radius: 5px;
    padding: 12px 22px;
    font-size: 17px;
}

button {
    font-size: 17px;
    line-height: 17px;
    padding: 12px 22px;
    background-color: #e680a5;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
}

button {
    margin-top: 14px;
}
</style>
