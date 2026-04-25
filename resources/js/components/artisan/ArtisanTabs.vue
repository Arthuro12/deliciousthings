<template>
    <TabsRoot 
        class="tabs-root" 
        default-value="overview"
        v-model="modelValue"
    >
        <TabsList class="tabs__list">
            <TabsIndicator class="tabs__indicator"></TabsIndicator>
            <TabsTrigger class="tab-trigger" value="overview">
                <header>Übersicht</header>
            </TabsTrigger>
            <TabsTrigger class="tab-trigger" value="bestsellers">
                Bestsellers
            </TabsTrigger>
            <TabsTrigger class="tab-trigger" value="gallery">
                Galerie
            </TabsTrigger>
        </TabsList>
        <TabsContent class="tabs__content" value="overview">
            <slot name="overview">Übersicht</slot>
        </TabsContent>
        <TabsContent value="bestsellers">
            <slot name="bestsellers">
                <div>Bald verfügbar</div>
            </slot>
        </TabsContent>
        <TabsContent value="gallery">
            <slot name="gallery">
                Galerie
            </slot>
        </TabsContent>
    </TabsRoot>
</template>

<script setup lang="ts">
import { 
    TabsRoot, 
    TabsList, 
    TabsTrigger, 
    TabsContent, 
    TabsIndicator 
} from "reka-ui";

import type { ArtisanPublicProfile } from "@/types/users";

defineProps<{
    artisan: ArtisanPublicProfile;
}>();

const modelValue = defineModel<string>({ required: false, });
</script>

<style scoped lang="scss">
.tabs-root {
    --border-color: #e5e7eb;
    --text-color: #111827;
}

.tabs-root {
    display: block;
    width: 100%;
} 

.tabs__list {
    display: flex;
    position: relative;
    gap: 0.5rem;
    border-bottom: 1px solid var(--border-color);
    overflow-x: auto;
    scrollbar-width: none; /* Firefox */
}

.tabs__list::-webkit-scrollbar {
    display: none; /* Chrome/Safari */
}

.tabs__indicator {
    position: absolute;
    bottom: 0;
    width: var(--reka-tabs-indicator-size);
    height: 2px;
    background: var(--text-color);
    transition: transform 0.3s ease, width 0.3s ease;
    transform: translateX(var(--reka-tabs-indicator-position));
}

.tab-trigger {
    all: unset;
    cursor: pointer;
    padding: 0.75rem 1rem;
    white-space: nowrap;
    font-size: 0.95rem;
    color: var(--color-neutral-50);
    transition: color 0.2s ease;
    border-radius: 6px 6px 0 0;
}

.tab-trigger:hover {
    color: var(--text-color);
}

.tab-trigger[aria-selected="true"],
.tab-trigger[data-state="active"] {
    color: var(--text-color);
    font-weight: 600;
}

.tabs__content {
    padding: 16px;
}

/* =========================
   RESPONSIVE
   ========================= */

/* TABLETTE */
@media (max-width: 768px) {
  .tabs__list {
        gap: 0.25rem;
    }

  .tab-trigger {
        padding: 0.6rem 0.75rem;
        font-size: 0.9rem;
    }
}

/* MOBILE */
@media (max-width: 480px) {
  .tabs__list {
        justify-content: flex-start;
        flex-wrap: nowrap;
    }

  .tab-trigger {
        flex: 0 0 auto;
        font-size: 0.85rem;
        padding: 0.5rem 0.6rem;
    }
}
</style>
