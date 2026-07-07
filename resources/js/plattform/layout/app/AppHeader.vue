<template>
    <header class="app-header">
        <div class="app-header__inner">
            <div class="app-header__mobile-menu">
                <AppNavigationMenu />
            </div>

            <a class="app-header__logo logo" href="/">
                DELICIOUSTHINGS
            </a>

            <nav class="app-header__nav" aria-label="Navigation principale">
                <Link
                    v-for="item in NAV_MENUS.PUBLIC"
                    :key="item.title"
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

import { Link, usePage, } from "@inertiajs/vue3";

import AppNavigationMenu from "./AppNavigationMenu.vue";
import UserNavigationMenu from "../auth/UserNavigationMenu.vue";

import { useAuth, } from "@/composables/use-auth";
import { useBreakpoints, } from "@/composables/use-breakpoints"
import { NAV_MENUS, } from "@/constants.js";

const page = usePage();
const { isAuthenticated, } = useAuth();
const { isAtMostMediumDevice, } = useBreakpoints();

const hasUserNavMenu = computed(() => {
    return isAuthenticated.value || isAtMostMediumDevice.value;
});

const isActive = (href: string) => {
    return page.url === href || page.url.startsWith(`${href}`);
};
</script>

<style scoped lang="scss">
@use '@css/abstracts/breakpoints';

.app-header {
    position: sticky;
    top: 0;
    z-index: var(--z-index-header);
    width: 100%;
    background-color: rgba(255, 255, 255);
    border-bottom: 1px solid var(--color-border-subtle);
    backdrop-filter: blur(16px);
}

.app-header__inner {
    display: grid;
    grid-template-columns: 2.75rem minmax(0, 1fr) 2.75rem;
    align-items: center;
    gap: var(--space-4);
    height: var(--layout-header-height-mobile);

    @include breakpoints.respond-to('large') {
        grid-template-columns: auto 1fr auto;
        gap: var(--space-6);
        padding: 0 1.5rem;
        height: var(--layout-header-height-desktop);
    }
}

.app-header__logo {
    display: inline-flex;
    align-items: center;
    justify-self: center;
    color: var(--color-brand-primary-500);
    text-decoration: none;

    svg {
        display: block;
        width: 10.25rem;
        height: auto;
    }

    @include breakpoints.respond-to('large') {
        justify-self: start;
    }
}

.app-header__nav {
    display: none;

    @include breakpoints.respond-to('large') {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-8);
    }
}

.app-header__nav-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    height: var(--layout-header-height-desktop);
    color: var(--color-text-primary);
    font-size: var(--font-size-sm);
    font-weight: var(--font-weight-semibold);
    text-decoration: none;
    transition: color var(--transition-base);
}

.app-header__nav-link::after {
    position: absolute;
    right: 0;
    bottom: 1.25rem;
    left: 0;
    height: 2px;
    background-color: var(--color-brand-primary-500);
    border-radius: var(--radius-full);
    content: "";
    opacity: 0;
    transform: scaleX(0.4);
    transition:
        opacity var(--transition-base),
        transform var(--transition-base);
}

.app-header__nav-link:hover,
.app-header__nav-link.is-active {
    color: var(--color-brand-primary-600);
}

.app-header__actions {
    display: none;

    @include breakpoints.respond-to('large') {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: var(--space-3);
    }
}

.app-header__mobile-menu {
    display: inline-flex;
    justify-self: start;

    @include breakpoints.respond-to('large') {
        display: none;
    }
}
</style>