<template>
    <div>
        <RekaDialog title="Suche">
            <template #trigger>
                <button
                    class="search-button button button--with-icon button--medium"
                    type="button" 
                    variant="primary" 
                    layout="with-icon"
                    size="large"
                >
                    Suchen
                    <SlidersHorizontalIcon />
                </button>
            </template>
            <template #default>
                <div class="artisans-search-form">
                    <div class="address-autocomplete-form">
						<AddressSearchInput />
                    </div>
					<div class="filter-options">
						<RekaSelect 
							class="search-filter"
							placeholder="Backwaren" 
							:items="bakedGoodStore.bakedGoods"
							label-prop="label"
							value-prop="key"
							multiple
							v-model:selected-value="selectedBakedGoods"
        				/>
						<RekaSelect 
							class="search-filter"
							placeholder="Ernährungsformen" 
							:items="dietaryOptionStore.dietaryOptions"
							label-prop="label"
							value-prop="key"
							multiple
							v-model:selected-value="selectedDietaryOptions"
        				/>
						<RekaCollapsible 
							class="services-filter" 
							v-model:open="servicesContentIsVisible"
						>
							<template #trigger>
								<header class="services-filter-header">
									<span class="truncate">Abholart und Durchschnittspreis (in Euro)</span>
									<PlusIcon v-show="!servicesContentIsVisible" />
									<MinusIcon v-show="servicesContentIsVisible" />
								</header>
							</template>
							<template #content>
								<div class="service-options">
									<div>	
										<RekaCheckbox 
											id="pick-up-on-site"
											label="Lieferung angeboten"
										/>
										<RekaCheckbox 
											id="offers-delivery"
											label="Abholung vor Ort"
										/>
									</div>
									<div class="average-rate-wrapper form__group">
										<header>Preis</header>
										<div class="average-rate">
											<TextField 
												class="price-input" 
												id="min-price" 
												type="number" 
												label="Von (€)"
											/>
											<TextField 
												class="price-input" 
												id="max-price" 
												type="number"
												label="Bis (€)"
											/>
										</div>
									</div>
								</div>
							</template>
						</RekaCollapsible>
					</div>
					<AppButton 
						class="search-artisans-button"
						type="button"
						variant="primary"
						size="large"
					>
						<template #text>Suchen</template>
					</AppButton>
                </div>
            </template>
        </RekaDialog>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";

import { 
	MinusIcon,
	PlusIcon,
	SlidersHorizontalIcon 
} from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";
import TextField from "../presentation/TextField.vue";
import RekaCollapsible from "@/third-party/reka-ui/RekaCollapsible.vue";
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";
import RekaCheckbox from "@/third-party/reka-ui/RekaCheckbox.vue";
import AddressSearchInput from "./AddressSearchInput.vue";

import { useBakedGoodStore } from "@/stores/baked-good";
import { useDietaryOptionStore } from "@/stores/dietary-option";
import type { BakedGood, DietaryOption } from "@/types/users";

const bakedGoodStore = useBakedGoodStore();
const dietaryOptionStore = useDietaryOptionStore();

const selectedBakedGoods = ref<BakedGood[]>([]);
const selectedDietaryOptions = ref<DietaryOption[]>([]);

const servicesContentIsVisible = ref(false)

onMounted(async () => {
	await bakedGoodStore.getBakedGoods();
	await dietaryOptionStore.getDietaryOptions();
});
</script> 

<style scoped lang="scss">
@use '../../../css/abstracts/breakpoints' as breakpoints;

.search-button {
    background-color: var(--color-neutral-0);
    color: var(--color-primary-50);
    border-radius: 24px;
}

.artisans-search-form {
	margin-top: 24px;

	.search-artisans-button {
		margin-top: 20px;
		width: 100%;
	}
}

.filter-options {
	display: flex;
	flex-direction: column;
	row-gap: 16px;

	:deep(> .select__dropdown-button) {
		width: 100%;
	}

	.services-filter {
		border-bottom: 1px solid var(--color-neutral-30);

		:deep(> button) {
			padding: 12px;
			width: 100%;

			&:hover {
				background-color: var(--color-primary-10);
			}
		}

		.service-options {
			margin: 0 12px 24px 12px;
		}
	}

	.services-filter-header {
		display: flex;
		justify-content: space-between;
	}

	.average-rate-wrapper {
		margin-top: 16px;

		.average-rate {
			display: flex;
			flex-direction: column;
			gap: 12px;

			@include breakpoints.respond-to('medium') {
				flex-direction: row;
			}
		}

		> .price-input :deep(> input) {
			border: 1px solid var(--color-neutral-30);
		}

		> .price-input :deep(> label) {
			font-size: 14px;
		}
	}
}
</style>