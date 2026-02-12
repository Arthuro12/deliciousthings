<template>
    <header class="app-header">
        <AppSidebar class="header__sidebar" :z-index="1" />
        <a href="/"><AppLogo class="logo" /></a>
        <div class="header__separator"></div>
        <nav class="navbar">
            <ul v-if="isAuthenticated">
                <li><LogoutButton /></li>
            </ul>
            <ul class="navbar__menu" v-else>
                <li>
                    <Link href="/login"><UserIcon color="#e680a5" /></Link>
                </li>
                <li>
                    <Link class="button button--primary button--medium" href="/register">Beitreten</Link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";

import { UserIcon } from "lucide-vue-next";

import AppLogo from "@/components/icons/AppLogo.vue";
import AppSidebar from "./AppSidebar.vue";
import LogoutButton from "@/components/auth/LogoutButton.vue";

import { useAuth } from "@/composables/use-auth";

const { isAuthenticated } = useAuth(usePage().props.auth);
</script>