<template>
    <div class="app-sidebar">
        <AppButton
            class="sidebar__icon-button" 
            type="button"
            layout="icon"
            @click="showContent = true"
        >
            <template #leading><MenuIcon /></template>
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
                        <template #leading><XIcon /></template>
                    </AppButton>
                </div>
                <ul class="sidebar__menu" v-if="isAuthenticated">
                    <li class="sidebar__item" v-if="hasArtisanProfile">
                        <Link class="sidebar__link" href="/artisan/profile">Mein Profil</Link>
                    </li>
                    <li class="sidebar__item" v-else>
                        <Link class="sidebar__link" href="/artisan/profile/create">Profil erstellen</Link>
                    </li>
                    <li class="sidebar__item">
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
                <ul class="sidebar__menu" v-else>
                    <li class="sidebar__item">
                        <Link class="button button--primary button--text" href="/register">Beitreten</Link>
                    </li>
                    <li class="sidebar__item">
                        <Link class="button button--secondary button--text" href="/login">Anmelden</Link>
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
import { computed, ref } from "vue";

import { Link, usePage } from "@inertiajs/vue3";
import { MenuIcon, XIcon } from "lucide-vue-next";

import AppOverlay from "@/components/presentation/AppOverlay.vue";
import AppButton from "@/components/presentation/AppButton.vue";

const props = defineProps<{
    top?: string;
    left?: string;
    zIndex?: number;
}>();

const top = ref(props.top ?? 0);
const left = ref(props.left ?? 0);
const zIndex = ref(props.zIndex ?? 1);
const showContent = ref(false);

const authenticatedUser = computed(() => usePage().props.auth.user);

const hasArtisanProfile = computed(() => authenticatedUser.value?.artisan_profile != undefined);

const isAuthenticated = computed(() => authenticatedUser.value != null);
</script>

<style scoped lang="scss">
.sidebar {
    &__content {
        position: fixed;
        background-color: var(--color-neutral-0);
        padding: 1rem 2rem;
        left: v-bind(left);
        top: v-bind(top);
        height: 100%;
        max-width: 700px;
        min-width: 350px;
        z-index: v-bind(zIndex);

        > .icon-wrapper {
            display: flex;
            justify-content: end;

            > .sidebar__icon-button {
                margin-bottom: 24px;
            }
        }
    }

    &__icon-button {
        padding: 0;
    }

    &__menu,
    &__item {
        margin-bottom: 24px;
    }

    &__item > .button {
        width: 100%;
    }

    &__link {
        display: flex;
        color: var(--color-primary-50);
        padding: 6px;

        &:hover {
            background-color: var(--color-primary-10);
            border-radius: 5px;
        }
    }
}
</style>