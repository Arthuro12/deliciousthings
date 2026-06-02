<template>
    <header class="app-header">
        <div class="app-header__inner">
            <div class="app-header__mobile-menu">
                <AppNavigationMenu />
            </div>

            <Link class="app-header__logo" href="/" aria-label="Retour à l'accueil">
                <AppLogo />
            </Link>

            <nav class="app-header__nav" aria-label="Navigation principale">
                <Link
                    v-for="item in NAV_MENUS.PUBLIC"
                    :key="item.href"
                    class="app-header__nav-link"
                    :class="{ 'is-active': isActive(item.href) }"
                    :href="item.href"
                >
                    {{ item.title }}
                </Link>
            </nav>

            <div class="app-header__actions" v-if="!hasUserNavMenu">
                <Link
                    class="button button--ghost button--medium button--text-only"
                    href="/login"
                >
                    <span class="button__label">Anmelden</span>
                </Link>

                <Link
                    class="button button--primary button--medium button--text-only"
                    href="/register"
                >
                    <span class="button__label">Beitreten</span>
                </Link>
            </div>

            <UserNavigationMenu v-else />
        </div>
    </header>
</template>

<script setup lang="ts">
import { computed, } from "vue";

import { Link, usePage } from "@inertiajs/vue3";

import AppLogo from "@/components/icons/AppLogo.vue";
import AppNavigationMenu from "./AppNavigationMenu.vue";
import UserNavigationMenu from "../auth/UserNavigationMenu.vue";

import { useAuth, } from "@/composables/use-auth";
import { useDeviceSize, } from "@/composables/use-device-size";
import { NAV_MENUS, } from "@/constants.js";

const page = usePage();
const { isAuthenticated, } = useAuth();
const { isSmallDevice, } = useDeviceSize();

const hasUserNavMenu = computed(() => {
    return isAuthenticated.value || isSmallDevice.value;
});

const isActive = (href: string) => {
    return page.url === href || page.url.startsWith(`${href}`);
};
</script>
