<template>
    <div>
        <div v-if="address" class="address-panel">
            <PublicAddress :address="address" />
            <RekaSwitch 
                class="address-visibility-switch"
                label="vollständige Adresse anzeigen"
                :model-value="showsFullAddress"
                @update:model-value="(value) => updateFullAddressVisibility(!!value)" 
            />
            <AppButton
                class="delete-button"
                type="button"
                variant="secondary"
                layout="icon"
                @click="deleteAddress"
            >
                <template #leading><TrashIcon /></template>
            </AppButton>
        </div>
        <RekaDialog title="Adresse bearbeiten">
            <template #trigger>
                <RekaDialogTrigger class="button button--tertiary button--with-icon">
                    <PencilIcon color="#e680a5" :size="16" />
                    Adresse bearbeiten         
                </RekaDialogTrigger>
            </template>
            <template #default>
                <ArtisanEditAddress class="address-form" :address="props.address" />
            </template>
        </RekaDialog>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

import { router } from "@inertiajs/vue3";

import { PencilIcon, TrashIcon } from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";
import RekaSwitch from "@/third-party/reka-ui/RekaSwitch.vue";
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
import RekaDialogTrigger from "@/third-party/reka-ui/RekaDialogTrigger.vue";
import ArtisanEditAddress from "./partials/ArtisanEditAddress.vue";
import PublicAddress from "../address/PublicAddress.vue";

import type { Address } from "@/types/users";

const props = defineProps<{
    address?: Address;
}>();

const showsFullAddress = ref(props.address?.shows_full_address || false);

function deleteAddress(): void {
    if (!props.address?.id) return;

    router.delete(`/artisan/profile/addresses/${props.address.id}`);
}

function updateFullAddressVisibility(showsFullAddress: boolean): void  {
    if (!props.address?.id) return;

    router.patch(`/artisan/profile/addresses/${props.address.id}/full-address-visibility`, 
        { shows_full_address: showsFullAddress },
        { preserveState: true }
    );
}

watch(() => props.address, (newAddress) => {
    showsFullAddress.value = !!newAddress?.shows_full_address;
});
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.address-form {
    margin-top: 16px;
}

.address-panel {
    display: flex;
    flex-direction: column;
    row-gap: 16px;
    border: 1px solid var(--color-neutral-10);
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 16px;

    .address-visibility-switch {
        min-width: 220px;
        width: fit-content;
    }

    .delete-button {
        align-self: end;
    }
}
</style>