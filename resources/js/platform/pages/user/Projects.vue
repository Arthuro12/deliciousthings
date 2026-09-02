<template>
    <div>
        <Head title="Meine projekte" />

        <div class="app-content-wrapper">
            <main class="app-content">
                <h1>Projekte</h1>
                <EmptyProjectsFallback v-if="projects.length == 0" />
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import Layout from "@/platform/layout/AppLayout.vue";
import EmptyProjectsFallback from "@/platform/components/EmptyProjectsFallback.vue";

import type { Project } from "@/types/users";

defineOptions({ layout: Layout });

defineProps<{
    projects: Project[];
}>();
</script>
