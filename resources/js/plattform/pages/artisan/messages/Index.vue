<template>
    <AppLayout>
        <Head>
            <title>Nachrichten</title>
        </Head>

        <main class="show-messages-page">
            <header class="page-header"><h1>Nachrichten</h1></header>
            <MessagesList class="messages-list" :messages="messages" />
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted } from "vue";
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/plattform/layout/AppLayout.vue";
import MessagesList from "@/components/message/MessagesList.vue";

import { useBodyAppearance } from "@/composables/use-body-appearance";
import type { Message } from "@/types/users";

const { messages } = defineProps<{
    messages: Message[];
}>();

const {
    setBodyBackgroundColor,
    removeBodyBackgroundColor,
} = useBodyAppearance("#fcf1f5");

onMounted(() => {
    setBodyBackgroundColor();
});

onUnmounted(() => {
    removeBodyBackgroundColor();
});
</script>

<style scoped>
.show-messages-page {
    .page-header {
        padding: 24px 24px 0;
    }

    .messages-list {
        height: 900px;
    }
}
</style>