<template>
    <nav class="navbar">
        <MenuIcon class="menu__button cursor--pointer" @click="toggleMenu(true)" />
        <ul v-show="showMenu" class="navbar__menu navbar__items">
            <XIcon class="menu__button cursor--pointer" @click="toggleMenu(false)" />
            <ul class="navbar__items" v-if="isAuthenticated">
                <li class="navbar__item" >
                    <Link class="navbar__link" :href='`/users/${userId}/profile/create`'>Profil erstellen</Link>
                </li>
                <li class="navbar__item" v-if="isAuthenticated">
                    <Link class="button button--text button--secondary" as="button" href="/logout" method="post">Abmelden</Link>
                </li>
            </ul>
            <ul class="navbar__items" v-else>
                <li class="navbar__item">
                    <Link class="navbar__link" href="/login">Anmelden</Link>
                </li>
                <li class="navbar__item">
                    <Link class="button button--text button--primary" href="/register">Beitreten</Link>
                </li>
            </ul>
        </ul>
    </nav>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

import { MenuIcon, XIcon } from "lucide-vue-next";

import { useDeviceSize } from "@/composables/use-devce-size.js";

const { auth } = usePage().props;
const { isSmallDevice } = useDeviceSize();

const isAuthenticated = auth.user != null;
const userId = auth.user?.id ?? "";

const showMenu = ref(!isSmallDevice.value);

watch(isSmallDevice, (newValue) => {
    toggleMenu(!newValue);
});

/**
 * Toggles the visibility of the navigation menu.
 * 
 * @param isVisible - Whether the menu should be displayed or hidden
 */
function toggleMenu(isVisible: boolean): void {
    showMenu.value = isVisible;
}
</script>