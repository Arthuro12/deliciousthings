<template>
    <AppLayout>
        <Head>
            <title>Konditor/-innen und Bäcker/-innen online finden</title>
        </Head>

        <main>
            <div>
                <ul>
                    <li v-for="artisan in artisans" :key="artisan.id">
                        {{ artisan.name }}
                    </li>
                </ul>
            </div>
        </main>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import AppLayout from "@/layout/AppLayout.vue";

import type { ArtisanProfile } from "@/types/users";

 const { artisans } = defineProps<{
    artisans: ArtisanProfile[];
 }>();
</script>