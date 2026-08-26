<template>
    <div>
        <main>
            <h1>Projekte</h1>
            <EmptyProjectsFallback v-if="projects.length == 0" />
        </main>
    </div>
</template>

<script setup lang="ts">
import Layout from "@/platform/layout/AppLayout.vue";
import EmptyProjectsFallback from "@/platform/components/EmptyProjectsFallback.vue";

import type { Project } from "@/types/users";

defineOptions({ layout: Layout });

defineProps<{
    projects: Project[];
}>();
</script>
