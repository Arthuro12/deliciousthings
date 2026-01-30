<template>
    <AppLayout>
        <Head>
            <title>Nachrich von {{ message.sender_name }}</title>
        </Head>

        <main class="card-layout message-wrapper">
            <header>
                 <AppLink
                    href="/artisan/messages"
                    variant="primary"
                 >
                    <template #leading><MoveLeftIcon /></template>
                    <template #text><p>Nachrichten</p></template>
                 </AppLink>
            </header>
            <div class="card message-card">
                <header class="message-card__header">
                    <div class="message-detail"><span class="font-bold">Von</span><span>{{ message.sender_name }}</span></div>
                    <div class="message-detail"><span class="font-bold">Am</span><span>{{ toLocalDate(new Date(message.sent_at), "de-DE") }}</span></div>
                </header>
                <div><p :class="$style.content" v-html="message.content"></p></div>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import { MoveLeftIcon } from "lucide-vue-next";

import AppLayout from "@/layout/AppLayout.vue";
import AppLink from "@/components/presentation/AppLink.vue";

import { toLocalDate } from "@/utils/date";
import type { Message } from "@/types/users";

const { message } = defineProps<{
    message: Message;
}>();
</script>

<style scoped lang="scss">
.message-wrapper {
    display: flex;
    flex-direction: column;
    row-gap: 24px;
    height: 900px;
    background: linear-gradient(
        to bottom right,
        var(--color-neutral-0),
        var(--color-primary-0),
        var(--color-primary-10),
        var(--color-primary-20),
        var(--color-primary-30),
        var(--color-primary-50), 
    );

    .message-card {
        display: flex;
        flex-direction: column;
        row-gap: 12px;
        margin: 0;

        &__header {
            background-color: var(--color-primary-10);
            border-radius: 8px;
            padding: 12px;

            & * {
                color: var(--color-primary-50);
            }
        }
    }

    .message-detail {
        display: flex;
        column-gap: 5px;
    }
}
</style>

<style module lang="scss">
.content {
    li p {
        // Prevents “p” elements from wrapping when the list item marker is visible. The code is necessary because Tiptap automatically inserts the content of a list item into a “p” element.
        display: inline;
    }
}
</style>