<template>
    <div class="app-sidebar">
        <AppButton
            class="sidebar__icon-button" 
            type="button"
            layout="icon"
            @click="showContent = true"
        >
            <template #leading><MenuIcon color="#e680a5" /></template>
        </AppButton>
        <Teleport to="body">
            <div v-show="showContent" class="sidebar__content">
                <div class="icon-wrapper">
                    <AppButton 
                        class="sidebar__icon-button"
                        type="button"
                        layout="icon"
                        @click="showContent = false"
                    >
                        <template #leading><XIcon color="#e680a5" /></template>
                    </AppButton>
                </div>
                <ul class="sidebar__menu" v-if="isAuthenticated">
                    <li class="sidebar__item">
                        <div class="artisan-settings">
                            <header class="settings-header">Für Anbietende</header>
                            <template v-if="hasArtisanProfile">
                                <Link class="sidebar__link" href="/artisan/profile/edit">Profil bearbeiten</Link>
                                <Link class="sidebar__link" href="/artisan/profile">Mein Profil</Link>
                                <Link class="sidebar__link" href="/artisan/messages">Nachrichten</Link>
                            </template>
                            <template v-else>
                                <Link class="sidebar__link" href="/artisan/profile/create">Profil erstellen</Link>
                            </template>
                        </div>
                    </li>
                    <AppDivider variant="horizontal" />
                    <li class="sidebar__item"><LogoutButton /></li>
                </ul>
                <ul class="sidebar__menu" v-else>
                    <li class="sidebar__item">
                        <Link class="button button--primary button--medium" href="/register">Beitreten</Link>
                    </li>
                    <li class="sidebar__item">
                        <Link class="button button--secondary button--medium" href="/login">Anmelden</Link>
                    </li>
                </ul>
            </div>
        </Teleport>
        <Teleport to="body">
            <AppOverlay v-show="showContent" />
        </Teleport>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import { Link, usePage } from "@inertiajs/vue3";

import { MenuIcon, XIcon } from "lucide-vue-next";

import AppDivider from "@/components/presentation/AppDivider.vue";
import AppOverlay from "@/components/presentation/AppOverlay.vue";
import AppButton from "@/components/presentation/AppButton.vue";
import LogoutButton from "@/components/auth/LogoutButton.vue";

import { useAuth } from "@/composables/use-auth";

const props = defineProps<{
    top?: string;
    left?: string;
    zIndex?: number;
}>();

const { isAuthenticated, hasArtisanProfile } = useAuth(usePage().props.auth);

const top = ref(props.top ?? 0);
const left = ref(props.left ?? 0);
const zIndex = ref(props.zIndex ?? 1);
const showContent = ref(false);
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.sidebar {
    &__content {
        position: fixed;
        background-color: var(--color-neutral-0);
        padding: 1rem 2rem;
        left: v-bind(left);
        top: v-bind(top);
        height: 100%;
        width: 90%;
        z-index: v-bind(zIndex);
        
        ul {
            list-style: none;
        }

        > .icon-wrapper {
            display: flex;
            justify-content: end;

            > .sidebar__icon-button {
                margin-bottom: 24px;
            }
        }

        @include breakpoints.respond-to('medium') {
            width: 40%;
        }
    }

    &__icon-button {
        padding: 0;
    }

    &__menu {
        display: flex;
        flex-direction: column;
        row-gap: 16px;
    }

    &__item > .button {
        width: 100%;
    }

    &__link {
        display: flex;
        color: var(--color-neutral-50);
        padding: 6px;

        &:hover {
            background-color: var(--color-neutral-10);
            border-radius: 5px;
        }
    }
}

.artisan-settings > .settings-header {
    color: var(--color-neutral-30);
}
</style>