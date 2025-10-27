<template>
    <AuthLayout>
        <div class="card-layout">
            <h1 class="heading">Anmelden</h1>
            <LoginForm />
            <Link class="button button--primary" href="/register">Neues Konto erstellen</Link>
        </div>
    </AuthLayout>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

import LoginForm from "@/components/auth/LoginForm.vue";
import AuthLayout from "@/layout/AuthLayout.vue";
</script>
