<template>
    <div class="wrapper">
        <div><a class="logo" href="/">DELICIOUS</a></div>
        <LoginForm />
        <Link class="button button--primary" href="/register">Neues Konto erstellen</Link>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import LoginForm from '@/components/auth/LoginForm.vue';
</script>