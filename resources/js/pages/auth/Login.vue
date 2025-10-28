<template>
    <AuthLayout>
        <div class="card-layout">
            <h1 class="heading">Anmelden</h1>
            <LoginForm />
        </div>
    </AuthLayout>
</template>

<script setup lang="ts">
import LoginForm from "@/components/auth/LoginForm.vue";
import AuthLayout from "@/layout/AuthLayout.vue";
</script>
