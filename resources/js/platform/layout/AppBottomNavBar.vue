<template>
    <nav
        class="bottom-navbar"
        aria-label="Mobile Hauptnavigation"
    >
        <Link
            v-for="link in mainNavigationLinks"
            :key="link.title"
            :href="link.href"
            class="bottom-navbar__link"
            :class="{
                'bottom-navbar__link--active':
                    isActiveLink(link.href),
            }"
        >
            <component
                v-if="link.iconName"
                :is="NAVIGATION_LINK_ICONS[link.iconName]"
                :size="22"
                :stroke-width="
                    isActiveLink(link.href) ? 2.1 : 1.8
                "
            />

            <span class="bottom-navbar__link-text">
                {{ link.title ?? link.title }}
            </span>
        </Link>
    </nav>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

import type { AppLinks } from "@/types/ui";

import { useNavigation } from "../composables/use-navigation";
import { isActiveLink } from "../utils";
import { NAVIGATION_LINK_ICONS } from "@/constants";

const props = defineProps<{
    links: AppLinks;
}>();

const { mainNavigationLinks } = useNavigation(props.links.user);
</script>

<style scoped>
.bottom-navbar {
    position: fixed;
    z-index: 40;

    right: 0;
    bottom: 0;
    left: 0;

    display: grid;
    grid-template-columns: repeat(4, 1fr);

    min-height: 70px;

    padding:
        7px
        10px
        calc(7px + env(safe-area-inset-bottom));

    background: rgb(255 255 255 / 96%);
    border: 1px solid var(--color-chocolate-100);
    border-radius: 22px;
    box-shadow:
        0 8px 28px rgb(54 36 29 / 10%),
        0 2px 8px rgb(54 36 29 / 4%);

    right: 8px;
    bottom: 8px;
    left: 16px;

    box-shadow: 0 -4px 20px rgb(54 36 29 / 4%);

    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);

    @media (min-width: 768px) {
        display: none;
    }
}

.bottom-navbar__link {
    position: relative;

    display: flex;
    flex-direction: column;
    gap: 4px;
    align-items: center;
    justify-content: center;

    min-width: 0;

    padding: 4px 6px;

    color: var(--color-neutral-500);

    border-radius: 10px;

    font-size: 11px;
    font-weight: 500;

    text-decoration: none;

    transition:
        color 140ms ease,
        background-color 140ms ease;

    -webkit-tap-highlight-color: transparent;
}

.bottom-navbar__link:active {
    background: var(--color-chocolate-50, #fbf6f2);
}

.bottom-navbar__link--active {
    color: var(--color-brand-primary-500);
}

.bottom-navbar__link-text {
    overflow: hidden;

    max-width: 100%;

    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>