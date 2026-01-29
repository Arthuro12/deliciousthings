<template>
    <div class="wrapper">
        <div v-if="hasMessages">
            <header class="messages-list__header">
                <h4>Meine Nachrichten</h4>
            </header>
            <div class="messages-rows">
                <a 
                    class="card message-link"
                    v-for="message in messages" 
                    :key="message.id"
                    href=""
                >
                    <div class="message-details">
                        <p class="font-bold">{{ message.sender_name }}</p>
                         <p class="message-details--content truncate">{{ stripTags(message.content) }}</p>
                    </div>
                    <div class="message-details"><p>{{ toLocalDate(new Date(message.sent_at), "de-DE") }}</p></div>
                </a>
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

import { stripTags } from "@/utils/sanitization";
import { toLocalDate } from "@/utils/date";
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

        .message-link {
            display: flex;
            justify-content: space-between;

            .message-details {
                display: flex;
            }

            .message-details:first-of-type {
                flex-direction: column;
            }

            .message-details:last-of-type {
                align-items: end;
            }
            
            &:not(:last-of-type) {
                margin-bottom: 16px;
            }

            &:hover {
                box-shadow: 0 0 5px 3px light-dark(var(--color-primary-50), var(--color-neutral-50));
            }

            .message-details--content {
                width: 100px;

                @include breakpoints.respond-to('medium') {
                    width: 200px;
                }
            }
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
