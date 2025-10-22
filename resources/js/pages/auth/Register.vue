<template>
    <div class="wrapper">
        <div><a class="logo" href="/">DELICIOUS</a></div>
        <h1 class="heading">Erstelle dein kostenlose Konto</h1>
        <RegisterForm />
    </div>
</template>

<script setup lang="ts">
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
