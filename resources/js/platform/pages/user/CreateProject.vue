<template>
    <div>
        <Head title="Neues Projekt" />

        <div class="app-content-wrapper">
            <main class="app-content">
                <div class="project-form-wrapper">
                    <form class="project-form">
                        <input 
                            id="project-name"
                            class="project-name-input"
                            placeholder="Projektname" 
                        />
                    </form>
                </div>
            </main> 
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Head, Link, setLayoutProps } from "@inertiajs/vue3";

import { MoveLeft } from "@lucide/vue";
import {   
    SelectContent,
    SelectGroup,
    SelectIcon,
    SelectItem,
    SelectItemIndicator,
    SelectLabel,
    SelectRoot,
    SelectScrollDownButton,
    SelectScrollUpButton,
    SelectSeparator,
    SelectTrigger,
    SelectValue,
    SelectViewport, 
} from "reka-ui"; 

import WorkspaceLayout from "@/platform/layout/WorkspaceLayout.vue";
import Banner from "@/platform/components/ForArtisansBanner.vue";
import ProjectStatusSelect from "@/platform/components/ProjectStatusSelect.vue";

defineOptions({ 
    layout: [WorkspaceLayout, { backLinkHref: undefined }] 
});

setLayoutProps({
    backLinkHref: "/app/projects",
});

const status = ref("");
</script>

<style scoped>
.page-wrapper {
    min-height: 100dvh;
}

.project-form-wrapper {
    /* margin-top: 1.5rem; */
}

.project-form {
    /* padding: 1.25rem; */
}

input.project-name-input {
    font-family: var(--font-heading);
    font-size: 1.75rem;
    font-weight: 600;
    line-height: 1.15;
    min-height: 1.5rem;
    outline: none;
    border-bottom: 1px solid var(--input-border);
    padding-bottom: 12px;
    width: 100%;

    &:focus-visible, &:focus {
        border-bottom-width: 3px;
        border-bottom-color: var(--color-border-focus);
    }

    @media (min-width: 768px) {
        font-size: 2.5rem;
    }
}
</style>