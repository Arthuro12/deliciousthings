<template>
    <AppButton
        type="button"
        variant="secondary"
        size="medium"
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