<template>
    <button
        class="button button--ghost button--medium button--text-only button--full"
        type="button"
        variant="secondary"
        size="medium"
        @click="logout"
    >
       <span class="button__label">Abmelden</span>
    </button>
</template>

<script setup lang="ts">
import { router } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";

function logout(): void {
    router.post("/logout", {}, { preserveState: false });
}
</script>