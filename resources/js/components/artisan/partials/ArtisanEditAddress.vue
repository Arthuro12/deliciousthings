<template>
    <div class="form__group">
        <AddressForm 
            :address="form" 
            @update:address="(address) => {
                Object.assign(form, address);
            }"
        />
        <AppButton
            class="align-end"
            type="button"
            layout="text"
            variant="primary"
            @click="submitAddress"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "@/components/presentation/AppButton.vue";
import AddressForm from "@/components/addresses/AddressForm.vue";

import type { Address } from "@/types/users";
import { defaultAddress } from "@/utils/artisans";

const props = defineProps<{
    address?: Address
}>();

const form = useForm(defaultAddress());
if (props.address) {
    Object.assign(form, props.address);
}

function submitAddress(): void {
    if (!props.address?.id) {
        form.post("/artisan/profile/addresses");
    } else {
        form.patch(`/artisan/profile/addresses/${props.address.id}`);
    }
}
</script>