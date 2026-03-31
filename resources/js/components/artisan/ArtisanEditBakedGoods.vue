<template>
    <div class="form__group">
        <slot name="header"></slot>
        <RekaSelectGroup 
            placeholder="Backwaren auswählen" 
            show-item-indicator
            :groups="options"
            label-prop="label"
            value-prop="key"
            multiple
            :select-value-option="{ as: 'p' }"
            v-model:selected-value="form.baked_goods"
        >
            <template #itemLabel="{ text }">
                <p>{{ text }}</p>
            </template>
        </RekaSelectGroup>
        <AppButton
            class="align-end"
            type="button"
            variant="primary"
            size="medium"
            @click="syncBakedGoods"
        >
            <template #text>Speichern</template>
        </AppButton>
    </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import AppButton from "../presentation/AppButton.vue";
import RekaSelectGroup from "@/third-party/reka-ui/RekaSelectGroup.vue";

import type { BakedGood, GroupedBakedGoods } from "@/types/users";

const props = defineProps<{
    options: GroupedBakedGoods;
    bakedGoods: BakedGood[];
}>();

const form = useForm({ baked_goods: [...props.bakedGoods] });

function syncBakedGoods(): void {
    form.put("/artisan/profile/baked-goods");
}
</script>