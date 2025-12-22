<template>
    <AppButton
        type="button"
        layout="text"
        variant="secondary"
        @click="logout"
    >
        <template #text>Abmelden</template>
    </AppButton>
</template>

<script setup lang="ts">
import { router } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";

function logout() {
    router.post("/logout", {}, { preserveState: false });
}
</script>