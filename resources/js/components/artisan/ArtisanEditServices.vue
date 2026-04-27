<template>
    <div class="form__group">
        <slot name="header"></slot>
            <div class="select-input-wrapper">
                <RekaSelectGroup
                    label="Besondere Leistungen (optional)"
                    :groups="servicesGroups"
                    show-item-indicator
                    multiple
                    value-prop="key"
                    label-prop="label"
                    placeholder="Leistungen auswählen"
                    :select-value-option="{ as: 'p' }"
                    v-model:selected-value="form.services"    
                >
                    <template #itemLabel="{ text }">
                        <p>{{ text }}</p>
                    </template>
                </RekaSelectGroup>
            </div>

            <TextField 
                type="text" 
                id="average-rate" 
                label="Durschnittlicher Einkaufspreis (€)"
                v-model="form.average_rate"
            />

        <AppButton
            class="align-end"
            type="button"
            variant="primary"
            size="medium"
            @click="updateServices"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { computed, onMounted } from "vue";

import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";
import RekaSelectGroup from "@/third-party/reka-ui/RekaSelectGroup.vue";

import { useServiceStore } from "@/stores/service";
import { SERVICES_CATEGORIES, } from "@/constants";
import { groupByCategories, mapGroupsToDisplayName, } from "@/utils/options";
import { Service } from "@/types/users";

const serviceStore = useServiceStore();

const props = defineProps<{
    rate: string;
    services?: Service[];
}>();

const form = useForm({
    average_rate: props.rate,
    services: [...(props.services ?? [])],
});

const servicesGroups = computed(() => {
    let groups = groupByCategories(serviceStore.services);
    groups = mapGroupsToDisplayName(groups, SERVICES_CATEGORIES);

    return groups;
});

function updateServices(): void {
    form.patch("/artisan/profile/services");
}

onMounted(async () => {
    await serviceStore.getServices();
});
</script>

<style scoped lang="scss">
.select-input-wrapper {
    width: 100%;

    :deep(.select__dropdown-button) {
        width: 100%;
    }
}
</style>