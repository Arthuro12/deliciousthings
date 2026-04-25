<template>
    <div>
        <div v-if="address" class="address-panel">
            <PublicAddress :address="address" />         
            <section class="form__group">
                <header class="form__group__header">Sichbartkeit der Adresse</header>
                <RekaRadioGroup 
                    :radios="addressVisibilityInputs"
                    :model-value="visibility"
                    @update:model-value="(value) => updateAddressVisibility(value as AddressVisibilityState)"
                />
            </section>
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
                    <PencilIcon color="#e680a5" :size="18" />
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
import RekaRadioGroup from "@/third-party/reka-ui/RekaRadioGroup.vue";
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
import RekaDialogTrigger from "@/third-party/reka-ui/RekaDialogTrigger.vue";
import ArtisanEditAddress from "./partials/ArtisanEditAddress.vue";
import PublicAddress from "../address/PublicAddress.vue";

import { AddressVisibility } from "@/enums";
import type { Address } from "@/types/users";
import type { Radio } from "@/types/ui";

type AddressVisibilityState = string | undefined | null;

const addressVisibilityInputs: Radio[] = [
    {
        id: "public",
        value: "public",
        name: "public",
        label: "Öffentlich"
    },
    {
        id: "private",
        value: "private",
        name: "private",
        label: "Privat"
    },
    {
        id: "city",
        value: "city",
        name: "city",
        label: "Nur Stadt"
    },
];

const props = defineProps<{
    address?: Address;
}>();

const visibility = ref<AddressVisibilityState>(props.address?.visibility.toString());

function deleteAddress(): void {
    if (!props.address?.id) return;

    router.delete(`/artisan/profile/addresses/${props.address.id}`);
}

function updateAddressVisibility(visibility: AddressVisibilityState): void  {
    if (!props.address?.id || !visibility) return;

    router.patch(`/artisan/profile/addresses/${props.address.id}/visibility`, 
        { visibility: visibility as AddressVisibility },
        { preserveState: true }
    );
}

watch(() => props.address, (newAddress) => {
    visibility.value = newAddress?.visibility;
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