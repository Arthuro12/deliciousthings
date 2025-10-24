<template>
    <nav class="navbar">
        <BurgerMenu class="icon--large cursor--pointer" @click="showMenu = true" />
        <ul v-show="showMenu" class="navbar__items">
            <Close class="icon--large close-button cursor--pointer" @click="showMenu = false" />
            <li class="navbar__item">
                <Link class="button button--primary" href="/login">Anmelden</Link>
            </li>
            <li class="navbar__item">
                <Link class="button button--secondary" href="/register">Beitreten</Link>
            </li>
            <li class="navbar__item" v-if="isAuthenticated">
                <Link as="button" href="/logout" method="post">Abmelden</Link>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

import BurgerMenu from "../icons/BurgerMenu.vue";
import Close from "../icons/Close.vue";

const isAuthenticated = usePage().props.auth.user != null;

const showMenu = ref(false);
</script>