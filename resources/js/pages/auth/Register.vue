<template>
    <AuthLayout>
        <Head>
            <title>Registrieren</title>
        </Head>
        <div :style="{ maxWidth: '500px' }" class="card-layout wrapper">
            <h1 class="heading">Erstelle dein kostenloses Konto</h1>
            <RegisterForm />
        </div>
    </AuthLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import RegisterForm from "@/components/auth/RegisterForm.vue";
import AuthLayout from "@/layout/AuthLayout.vue";
</script>

<style scoped> 
.wrapper {
    border-radius: 16px;
}
</style>