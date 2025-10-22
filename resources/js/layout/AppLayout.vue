<template>
    <header class="app-header">
        <div><a class="logo" href="/">DELICIOUS</a></div>
        <nav class="navbar">
            <ul class="navbar__items">
                <li>
                    <Link class="button button--primary" href="/login">Anmelden</Link>
                </li>
                <li>
                    <Link class="button button--secondary" href="/register">Konto erstellen</Link>
                </li>
                <li>
                    <Link as="button" href="/logout" method="post">Abmelden</Link>
                </li>
            </ul>
        </nav>
    </header>

    <body>
        <slot></slot>
    </body>

    <AppFooter />
</template>

<script setup lang="ts">
import AppFooter from '@/components/AppFooter.vue';
import { Link } from '@inertiajs/vue3';
</script>
