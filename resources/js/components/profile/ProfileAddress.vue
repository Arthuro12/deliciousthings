<template>
    <div v-if="address">
        <PublicAddress 
            v-if="address.visibility == AddressVisibility.Public" 
            :address 
        />
        <div class="item-flex" v-else-if="address.visibility == AddressVisibility.City">
            <MapPinIcon color="#e680a5" :size="24"/> 
            {{ `${address.city} ${address.postal_code}` }}
        </div>
        <div class="item-flex" v-else>
            <LockIcon color="#e680a5" :size="24" />
            Dieses Profil hat die Adresssichtbarkeit verriegelt.
        </div>
    </div>
</template>


<script setup lang="ts">
import { MapPinIcon, LockIcon } from "lucide-vue-next";
import PublicAddress from "@/components/address/PublicAddress.vue";

import { AddressVisibility } from "@/enums";
import type { Address } from "@/types/users";

const { address } = defineProps<{
    address?: Address;
}>();
</script>

<style scoped>
.item-flex {
    display: flex;
    column-gap: 12px;
}
</style>