<template>
    <nav class="navbar">
        <BurgerMenu class="menu__button icon--large cursor--pointer" @click="toggleMenu(true)" />
        <ul v-show="showMenu" class="navbar__menu navbar__items">
            <Close class="menu__button icon--large cursor--pointer" @click="toggleMenu(false)" />
            <ul class="navbar__items" v-if="isAuthenticated">
                <li class="navbar__item" >
                    <Link class="navbar__link" href="/profile">Profil erstellen</Link>
                </li>
                <li class="navbar__item" v-if="isAuthenticated">
                    <Link class="button button--secondary" as="button" href="/logout" method="post">Abmelden</Link>
                </li>
            </ul>
            <ul class="navbar__items" v-else>
                <li class="navbar__item">
                    <Link class="navbar__link" href="/login">Anmelden</Link>
                </li>
                <li class="navbar__item">
                    <Link class="button button--primary" href="/register">Beitreten</Link>
                </li>
            </ul>
        </ul>
    </nav>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

import BurgerMenu from "../icons/BurgerMenu.vue";
import Close from "../icons/Close.vue";

import { useIsMobile } from "@/composables/is-mobile";

const isAuthenticated = usePage().props.auth.user != null;
const { isMobile } = useIsMobile();

const showMenu = ref(!isMobile.value);

watch(isMobile, (newValue) => {
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