<template>
    <AuthLayout>
        <Head>
            <title>Anmelden</title>
        </Head>
        <div :style="{ maxWidth: '500px' }" class="card-layout wrapper">
            <h1 class="heading">Anmelden</h1>
            <LoginForm />
        </div>
    </AuthLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import AuthLayout from "@/plattform/layout/AuthLayout.vue";
import LoginForm from "@/components/auth/LoginForm.vue";
</script>

<style scoped> 
.wrapper {
    border-radius: 16px;
}
</style>
