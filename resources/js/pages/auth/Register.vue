<template>
    <div class="wrapper">
        <div><a href="/"><AppLogo /></a></div>
        <h1 class="heading">Erstelle dein kostenlose Konto</h1>
        <RegisterForm />
    </div>
</template>

<script setup lang="ts">
import AppLogo from '@/components/icons/AppLogo.vue';
import RegisterForm from '@/components/auth/RegisterForm.vue';
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
