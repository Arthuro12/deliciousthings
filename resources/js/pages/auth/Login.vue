<template>
    <div class="wrapper">
        <div><a href="/"><AppLogo /></a></div>
        <LoginForm />
        <Link class="button button--primary" href="/register">Neues Konto erstellen</Link>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import AppLogo from '@/components/icons/AppLogo.vue';
import LoginForm from '@/components/auth/LoginForm.vue';
</script>

<style scoped>
.wrapper {
    padding: 2rem;
}

.logo {
    text-align: center;
}

.heading {
    margin-top: 48px;
    margin-bottom: 40px;
}
</style>
