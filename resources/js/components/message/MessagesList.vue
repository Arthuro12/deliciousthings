<template>
    <div class="wrapper">
        <div v-if="hasMessages">
            <header class="messages-list__header">
                <h4>Meine Nachrichten</h4>
            </header>
            <div class="messages-rows">
                <button class="message-button" type="button" v-for="message in messages" :key="message.id">
                    <div class="message-row">
                        <div>{{ message.sender_name }}</div>
                        <div :class="$style.content" v-html="message.content"></div>
                        <div>{{ message.sent_at }}</div>
                    </div>
                </button>
            </div>
        </div>
        <div class="fallback-wrapper" v-else>
            <header class="fallback-header"><h4>0 Nachrichten</h4></header>

            <div class="fallback-content card card--flat">
                <MessageCircleIcon color="#e680a5" :size="100" />
                <div class="fallback-content__texts">
                    <h4 class="fallback-content__title">Willkommen bei DELICIOUSThings Nachrichten</h4>
                    <p>Sie haben noch keine Nachrichten</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { MessageCircleIcon } from "lucide-vue-next";

import type { Message } from "@/types/users";

const { messages } = defineProps<{
    messages: Message[];
}>();

const hasMessages = computed(() => messages.length > 0);
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.wrapper {
    .messages-list__header,
    .fallback-header {
        padding: 12px 24px 0;
        margin-bottom: 24px;

        @include breakpoints.respond-to('medium') {
            margin-bottom: 0;
        }
    }

    .messages-rows {
        padding: 24px;

        .message-button {
            text-align: start;
        }
    }

    .fallback-wrapper {
        display: flex;
        flex-direction: column;
        height: 100%;

        .fallback-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 17px;
            margin: 0;
            align-self: stretch;
            flex: 1;
            padding: 0 24px;

            > .fallback-content__texts {
                display: flex;
                flex-direction: column;
                align-items: center;

                > .fallback-content__title {
                    text-align: center;
                    font-size: 1.375rem;
                    font-weight: 500;
                }
            }

            @include breakpoints.respond-to('medium') {
                width: 50%;
                margin: 24px auto;
                border-radius: 16px;
            }
        }
    }
}
</style>

<style module>
.content {
    li {
        margin-left: 12px;
    }
}
</style>