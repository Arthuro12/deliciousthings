<template>
    <nav class="navbar">
        <ul class="navbar__items">
            <li>
                <Link class="button button--primary" href="/login">Anmelden</Link>
            </li>
            <li>
                <Link class="button button--secondary" href="/register">Beitreten</Link>
            </li>
            <li v-if="isAuthenticated">
                <Link as="button" href="/logout" method="post">Abmelden</Link>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";

const isAuthenticated = usePage().props.auth.user != null;
</script>