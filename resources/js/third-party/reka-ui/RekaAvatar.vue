<template>
    <div>
        <AvatarRoot>
            <AvatarImage 
                class="avatar__image" 
                :src="src" 
                :alt="alt" 
            />
            <AvatarFallback class="avatar__fallback">{{ avatarText }}</AvatarFallback>
        </AvatarRoot>
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

import { AvatarRoot, AvatarImage, AvatarFallback } from "reka-ui";

const { src, alt = "", name } = defineProps<{
    src: string;
    alt: string;
    /**
     * The name to use to derive the fallback text.
     */
    name?: string;
}>();

const avatarText = computed(() => getAvatarText(name ?? ""));

/**
 * Gets the fallback text to display in the when to image hasn't loaded.
 * 
 * @param text 
 */
function getAvatarText(text: string): string {
    const fragments = text.split(" ").slice(0, 2);
    const output = fragments.map(fragment => fragment.slice(0, 1).toUpperCase()).join("");
    return output;
}
</script>

<style scoped lang="scss">
@use "../../../css/abstracts/breakpoints" as breakpoints;

.avatar {
    &__image,
    &__fallback {
        border-radius: 50%;
        width: 120px;
        height: 120px;

        @include breakpoints.respond-to('medium') {
            width: 200px;
            height: 200px;
        }
    }

    &__fallback {
        font-size: 1.125rem;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: var(--color-primary-10);
    }
}
</style>