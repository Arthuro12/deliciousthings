<template>
    <header class="app-header">
        <div class="app-header__inner">
            <Link class="logo" :href="appHomeUrl?.href ?? '/app'">
                <DeliciousthingsLogo class="logo__image" />
            </Link>

            <nav
                class="app-header__navigation"
                aria-label="Hauptnavigation"
            >
                <Link
                    v-for="link in mainNavigationLinks"
                    :key="link.title"
                    :href="link.href"
                    class="app-header__navigation-link"
                    :class="{
                        'app-header__navigation-link--active':
                            isActiveLink(link.href),
                    }"
                >
                    <component
                        v-if="link.iconName"
                        :is="NAVIGATION_LINK_ICONS[link.iconName]"
                        :size="20"
                        :stroke-width="1.8"
                    />

                    <span>{{ link.title }}</span>
                </Link>
            </nav>

            <button
                type="button"
                class="app-header__user-button"
                aria-label="Benutzermenü öffnen"
            >
                <CircleUserRound
                    :size="23"
                    :stroke-width="1.7"
                />
            </button>
        </div>
    </header>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { Link, usePage } from "@inertiajs/vue3";

import { 
    CircleUserRound,
} from "@lucide/vue";

import DeliciousthingsLogo from "@/platform/components/icons/DeliciousthingsLogo.vue";

import { NAVIGATION_LINK_ICONS } from "@/constants";
import type { AppLinks } from "@/types/ui";

const props = defineProps<{
    links: AppLinks;
}>();

const page = usePage();

const appHomeUrl = props.links.user.find(link => link.title == "Startseite");

const mainNavigationLinks = computed(() => {
    return props.links.user.filter(link => !["Profil"].includes(link.title));
});

function isActiveLink(url: string): boolean {
    return page.url === new URL(url).pathname;
}
</script>

<style scoped lang="scss">
.app-header {
    position: fixed;
    z-index: 3;
    top: 0;

    width: 100%;
    height: var(--app-header-height);

    background: var(--color-neutral-50, #fdfbf9);
    border-bottom: 1px solid var(--color-chocolate-100, #f4e8df);
}

.app-header__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;

    width: 100%;
    max-width: 90rem;
    height: 100%;

    margin-inline: auto;
    padding-inline: 20px;

    @media (min-width: 768px) {
        padding-inline: 32px;
    }
}

.logo {
    position: relative;
    z-index: 1;
}

.app-header__navigation {
    display: none;

    @media (min-width: 768px) {
        position: absolute;
        display: flex;
        gap: 4px;
        justify-content: center;
        align-items: center;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
    }
}

.app-header__navigation-link {
    position: relative;

    display: inline-flex;
    gap: 8px;
    align-items: center;

    height: 44px;

    padding-inline: 14px;

    color: var(--color-neutral-500);
    border-radius: 999px;

    font-size: 14px;
    font-weight: 500;

    text-decoration: none;

    transition:
        color 140ms ease,
        background-color 140ms ease;
}

.app-header__navigation-link:hover,
.app-header__navigation-link--active {
    color: var(--color-brand-primary-500);
    background-color: var(--color-brand-primary-50);
}

.app-header__user-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 42px;
    height: 42px;

    padding: 0;

    color: var(--color-chocolate-700, #563d33);
    background: #fff;

    border: 1px solid var(--color-chocolate-200, #e8d5c8);
    border-radius: 50%;

    cursor: pointer;

    transition:
        background-color 140ms ease,
        border-color 140ms ease,
        transform 100ms ease;

    -webkit-tap-highlight-color: transparent;
}

.app-header__user-button:hover {
    background: var(--color-chocolate-50, #fbf6f2);
    border-color: var(--color-chocolate-300, #d8b9a6);
}

.app-header__user-button:active {
    transform: scale(0.96);
}
</style>