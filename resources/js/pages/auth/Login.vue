<template>
    <AuthLayout>
        <Head>
            <title>Anmelden</title>
        </Head>
        <div :style="{ maxWidth: '500px' }" class="card-layout">
            <h1 class="heading">Anmelden</h1>
            <LoginForm />
        </div>
    </AuthLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import LoginForm from "@/components/auth/LoginForm.vue";
import AuthLayout from "@/layout/AuthLayout.vue";
</script>
