<template>
    <div class="form__group">
        <BasicProfileForm v-model:profile="artisan" />
        <slot name="action" :data="artisan"></slot>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

import BasicProfileForm from "../profile/BasicProfileForm.vue"; 

import type { BasicProfile } from "@/types/users";

const props = defineProps<{
    profile: BasicProfile;
}>();

const artisan = ref({ ...props.profile });
</script>