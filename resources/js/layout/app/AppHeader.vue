<template>
    <header class="app-header">
        <AppNavigation class="app-nav" />
        <a class="logo" href="/"><AppLogo class="block" /></a>
        <nav class="navbar">
            <ul class="navbar__menu">
                <li>
                    <Link 
                        class="button--medium menu-link" 
                        :class="{ 'link--active': linkIsActive('artisans') }"
                        href="/artisans"
                    >Konditor:innen</Link>
                </li>
                <li>
                    <Link 
                        class="button--medium menu-link" 
                        :class="{ 'link--active': linkIsActive('creations') }"
                        href="/creations"
                    >Kreationen</Link>
                </li>
            </ul>
            <div class="header__separator"></div>
            <ul v-if="isAuthenticated">
                <li><LogoutButton /></li>
            </ul>
            <ul class="navbar__menu" v-else>
                <li>
                    <Link 
                        class="button button--secondary button--medium" 
                        href="/login"
                    >Anmelden</Link>
                </li>
                <li>
                    <Link 
                        class="button button--primary button--medium" 
                        href="/register"
                    >Beitreten</Link>
                </li>
            </ul>
        </nav>
        <UserNavigation class="user-nav" />
    </header>
</template>

<script setup lang="ts">
import { Link, usePage, } from "@inertiajs/vue3";

import AppLogo from "@/components/icons/AppLogo.vue";
import AppNavigation from "./AppNavigation.vue";
import UserNavigation from "../auth/UserNavigation.vue";
import LogoutButton from "@/components/auth/LogoutButton.vue";

import { useAuth } from "@/composables/use-auth";

const { isAuthenticated } = useAuth();

/**
 * Checks if the page link is active.

 * @param path - The path name included in the resource's Url.
 */
const linkIsActive = (path: string) => usePage().url.includes(path);
</script>
