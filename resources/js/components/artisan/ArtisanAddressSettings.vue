<template>
    <div>
        <div v-if="address" class="address-panel">
            <AddressPreview :address="address" />
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
                <AppButton
                    type="button"
                    variant="tertiary"
                    layout="with-icon"
                >
                    <template #leading><PencilIcon :size="16" /></template>
                    <template #text>Adresse bearbeiten</template>
                </AppButton>
            </template>
            <template #default>
                <ArtisanEditAddress class="address-form" :address="props.address" />
            </template>
        </RekaDialog>
    </div>
</template>

<script setup lang="ts">
import { router } from "@inertiajs/vue3";

import { PencilIcon, TrashIcon } from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
import ArtisanEditAddress from "./partials/ArtisanEditAddress.vue";
import AddressPreview from "../address/AddressPreview.vue";

import type { Address } from "@/types/users";

const props = defineProps<{
    address?: Address;
}>();

function deleteAddress(): void {
    if (!props.address?.id) return;

    router.delete(`/artisan/profile/addresses/${props.address.id}`);
}
</script>

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.address-form {
    margin-top: 16px;
}

.address-panel {
    display: flex;
    flex-direction: column;
    row-gap: 12px;
    border: 1px solid var(--color-neutral-10);
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 16px;

    .delete-button {
        align-self: end;
    }
}

.address-preview {
    display: flex;
    column-gap: 12px;
    align-items: center;
}
</style>