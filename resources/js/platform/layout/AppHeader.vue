<template>
    <header class="app-header">
        <div class="app-header__inner">
            <Link class="logo" :href="appHomeUrl?.href ?? '/app'">
                <DeliciousthingsLogo class="logo__image" />
            </Link>

            <DropdownMenuRoot v-if="user">
                <DropdownMenuTrigger as-child>
                    <button
                        type="button"
                        class="app-header__user-button"
                        aria-label="Benutzermenü öffnen"
                    >
                        <span class="app-header__user-avatar" aria-hidden="true">{{ initials }}</span>
                        <span class="app-header__user-name">{{ user.full_name }}</span>
                    </button>
                </DropdownMenuTrigger>

                <DropdownMenuPortal>
                    <DropdownMenuContent class="user-menu" align="end" :side-offset="8">
                        <DropdownMenuLabel class="user-menu__name">
                            {{ user.full_name }}
                        </DropdownMenuLabel>
                        <DropdownMenuSeparator class="user-menu__separator" />
                        <DropdownMenuItem class="user-menu__item" @select="logout">
                            Abmelden
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenuPortal>
            </DropdownMenuRoot>
        </div>
    </header>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { Link, router, usePage } from "@inertiajs/vue3";

import {
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuPortal,
    DropdownMenuRoot,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "reka-ui";

import DeliciousthingsLogo from "@/platform/components/icons/DeliciousthingsLogo.vue";

import { getNameIntials } from "@/utils/users";
import type { AppLinks } from "@/types/ui";
import type { AppPageProps } from "@/types";

const props = defineProps<{
    links: AppLinks;
}>();

const page = usePage();
const user = computed(() => (page.props as AppPageProps).auth.user);
const initials = computed(() => user.value ? getNameIntials(user.value.full_name) : "");

const appHomeUrl = props.links.user.find(link => link.title == "Startseite");

function logout(): void {
    router.post("/logout");
}
</script>

<style scoped lang="scss">
.app-header {
    position: fixed;
    z-index: 3;
    top: 0;

    width: 100%;
    height: var(--app-header-height);

    background: rgb(255 250 248 / 94%);
    border-bottom: 1px solid var(--color-border-subtle);
    backdrop-filter: blur(16px);
}

.app-header__inner {
    display: flex;
    align-items: center;
    justify-content: space-between;

    width: 100%;
    max-width: 90rem;
    height: 100%;

    margin-inline: auto;
    padding-inline: var(--layout-page-padding-mobile);

    @media (min-width: 768px) {
        padding-inline: var(--space-8);
    }
}

.logo {
    position: relative;
    z-index: 1;
}

.app-header__user-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 42px;
    gap: 10px;

    padding: 4px 12px 4px 4px;

    color: var(--color-chocolate-700, #563d33);
    background: #fff;

    border: 1px solid var(--color-chocolate-200, #e8d5c8);
    border-radius: 999px;

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

.app-header__user-avatar {
    display: inline-flex;
    flex: 0 0 32px;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: #fff;
    background: var(--color-brand-primary-500, #ef6f86);
    border-radius: 50%;
    font-size: 12px;
    font-weight: 700;
}

.app-header__user-name {
    display: none;
    max-width: 180px;
    overflow: hidden;
    color: var(--color-chocolate-700, #563d33);
    font-size: 14px;
    font-weight: 600;
    text-overflow: ellipsis;
    white-space: nowrap;

    @media (min-width: 768px) {
        display: block;
    }
}

:global(.user-menu) {
    z-index: 10;
    min-width: 220px;
    padding: 6px;
    color: var(--color-chocolate-900, #36241d);
    background: #fff;
    border: 1px solid var(--color-chocolate-100, #f4e8df);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgb(54 36 29 / 12%);
}

:global(.user-menu__name) {
    padding: 10px 12px;
    font-size: 14px;
    font-weight: 600;
}

:global(.user-menu__separator) {
    height: 1px;
    margin: 4px 0;
    background: var(--color-chocolate-100, #f4e8df);
}

:global(.user-menu__item) {
    padding: 10px 12px;
    border-radius: 8px;
    cursor: pointer;
    outline: none;
}

:global(.user-menu__item[data-highlighted]) {
    color: var(--color-brand-primary-500, #ef6f86);
    background: var(--color-brand-primary-50, #fff1f3);
}
</style>
