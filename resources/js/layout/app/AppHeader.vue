<template>
    <header class="app-header">
        <AppSidebar class="header__sidebar" :z-index="1" />
        <a href="/"><AppLogo class="logo" /></a>
        <div class="header__separator"></div>
        <nav class="navbar">
            <ul v-if="isAuthenticated">
                <li>
                    <Link
                        class="button button--secondary button--text" 
                        as="button" 
                        href="/logout" 
                        method="post"
                    >
                        Abmelden
                    </Link>
                </li>
            </ul>
            <ul class="navbar__menu" v-else>
                <li>
                    <Link href="/login"><UserIcon color="#e680a5" /></Link>
                </li>
                <li>
                    <Link class="button button--primary button--text" href="/login">Beitreten</Link>
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

const { auth } = usePage().props;
const isAuthenticated = auth.user != null;
</script>