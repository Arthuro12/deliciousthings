<template>
    <div>
        <div>
            <header>Produkte auswählen (optional)</header>
            <ul>
                <li v-for="good in artisan.baked_goods" :key="good.key">
                    <div>
                        <button type="button">{{ good.name }}</button>
                        <PlusIcon class="add-icon" color="ffffff" :size="12" />
                    </div>
                </li>
            </ul>
        </div>
        <div>
            <header>Leistungen auswählen (optional)</header>
            <ul>
                <li v-for="service in artisan.services" :key="service.key">
                    <button type="button">{{ service.name }}</button>
                </li>
            </ul>
        </div>
        <div>
            <TextField 
                type="date"
                id="withdrawal-date"
                label="Abholtermin"
                v-model="withdrawalAt"
            ></TextField>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import { PlusIcon } from "lucide-vue-next";

import SimpleEditor from "@/third-party/tiptap/SimpleEditor.vue";
import TextField from "../presentation/TextField.vue";

import type { ArtisanPublicProfile } from "@/types/users";

/**
 * Produit
 * - Nom
 * - Quantité
 * Nombre de personne
 * Services désiré
 * Message
 * Date de retrait
 */

type PreOrderGood = {
    name: string;
    quantity?: null | number;
};

const props = defineProps<{
    artisan: ArtisanPublicProfile;
}>();

const withdrawalAt = ref("");
const totalGuests = ref(null);
const message = ref("");
const good = ref<PreOrderGood[]>([]);
const services = ref<string[]>([]);
</script>

<style scoped lang="scss">
ul {
    list-style: none;
}
</style>