<template>
    <div class="tabs__root">
        <header class="tabs__header">Was möchten SIe tun?</header>
        <div class="tabs__list">
            <button 
                class="tabs__trigger" 
                :class="{
                    'is-active': tab == 'question'
                }"
                @click="setTab('question')"
            >
                <MessageSquareMoreIcon 
                    class="trigger-icon"
                    color="#0f0f0f" 
                    :size="24" 
                />
                Frage senden
            </button>
            <button 
                class="tabs__trigger" 
                :class="{
                    'is-active': tab == 'pre-order'
                }"
                @click="setTab('pre-order')"
            >
                <ShoppingBagIcon 
                    class="trigger-icon"
                    color="#0f0f0f" 
                    :size="24"
                />
                Vorbestellung 
            </button>
        </div>
        <div>
            <div 
                class="tabs__content"
                v-if="tab == 'question'"
            >
                <slot name="question"></slot>
            </div>
            <div 
                class="tabs__content" 
                v-else-if="tab == 'pre-order'"
            >
                <slot name="preOrder"></slot>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import { MessageSquareMoreIcon, ShoppingBagIcon, } from "lucide-vue-next";

type TabValue = "question" | "pre-order";

const tab = ref<TabValue>("pre-order");

function setTab(value: TabValue): void {
    tab.value = value;
}
</script>

<style scoped lang="scss">
.tabs__header {
    margin-bottom: 14px;
}

.tabs__list {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.tabs__trigger {
    color: var(--color-neutral-40);
    display: flex;
    justify-content: center;
    flex: 1 0 auto;
    border: 1px solid var(--color-neutral-20);
    border-radius: 10px;
    column-gap: 12px;
    padding: 10px;

    &:hover {
        border: 2px solid var(--color-primary-50);
    }

    &.is-active {
        border: 2px solid var(--color-primary-50);
        background-color: var(--color-primary-10);
    }
}

// > svg.trigger-icon {
//     color: var(--color-neutral-0);
// }
</style>