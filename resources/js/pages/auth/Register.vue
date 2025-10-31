<template>
    <AuthLayout>
        <div :style="{ width: '500px' }" class="card-layout">
            <h1 class="heading">Erstelle dein kostenlose Konto</h1>
            <RegisterForm />
        </div>
    </AuthLayout>
</template>

<script setup lang="ts">
import RegisterForm from "@/components/auth/RegisterForm.vue";
import AuthLayout from "@/layout/AuthLayout.vue";
</script>
