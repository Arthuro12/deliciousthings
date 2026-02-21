<template>
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
			<form @submit.prevent="onSearch">
				<div class="artisans-search-form">
					<div class="address-autocomplete-form">
						<AddressSearchInput />
					</div>
					<div class="filter-options">
						<RekaSelect 
							class="search-filter"
							placeholder="Backwaren" 
							show-item-indicator
							:items="bakedGoodStore.bakedGoods"
							label-prop="label"
							value-prop="key"
							multiple
							v-model:selected-value="selectedBakedGoods"
						/>
						<RekaSelect 
							class="search-filter"
							placeholder="Ernährungsformen" 
							show-item-indicator
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
									<PlusIcon v-show="!servicesContentIsVisible" color="#696c70" />
									<MinusIcon v-show="servicesContentIsVisible" color="#696c70" />
								</header>
							</template>
							<template #content>
								<div class="service-options">
									<div>	
										<RekaCheckbox 
											id="pick-up-on-site"
											label="Lieferung angeboten"
											v-model="offersDelivery"
										/>
										<RekaCheckbox 
											id="offers-delivery"
											label="Abholung vor Ort"
											v-model="pickUpOnSite"
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
												v-model="minPrice"
											/>
											<TextField 
												class="price-input" 
												id="max-price" 
												type="number"
												label="Bis (€)"
												v-model="maxPrice"
											/>
										</div>
									</div>
								</div>
							</template>
						</RekaCollapsible>
					</div>
					<AppButton 
						class="search-artisans-button"
						type="submit"
						variant="primary"
						size="large"
					>
						<template #text>Suchen</template>
					</AppButton>
				</div>
			</form>
		</template>
	</RekaDialog>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import { router } from "@inertiajs/vue3";

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

export type PriceRange = {
	min_price: string;
	max_price: string;
};

export type FilterOptions = {
	offers_delivery?: boolean;
	pick_up_on_site?: boolean;
};

export type SearchFilters = {
	goods: string[];
	dietary_options?: string[];
	price_range?: PriceRange;
	options?: FilterOptions;
};

const bakedGoodStore = useBakedGoodStore();
const dietaryOptionStore = useDietaryOptionStore();

const selectedBakedGoods = ref<BakedGood[]>([]);
const selectedDietaryOptions = ref<DietaryOption[]>([]);
const minPrice = ref("");
const maxPrice = ref("");
const offersDelivery = ref(false);
const pickUpOnSite = ref(false);

const servicesContentIsVisible = ref(false);

function buildSearchParameters(filters: SearchFilters): string {
	const params = new URLSearchParams();

	params.set("goods", filters.goods.join(","))
	if (filters.dietary_options && filters.dietary_options.length > 0) {
		params.set("dietary_option", filters.dietary_options.join(","))
	}
	if (filters.dietary_options && filters.dietary_options.length > 0) {
		params.set("dietary_option", filters.dietary_options.join(","))
	}
	if (filters.price_range) {
		params.set("min_price", filters.price_range.min_price);
		params.set("max_price", filters.price_range.max_price);
	}
	if (filters.options) {
		const options = Object.entries(filters.options);
		options.forEach(([key, value]) => {
			params.set(key, JSON.stringify(value ? 1 : 0));
		});
	}

	return params.toString();
}

/**
 * Search for artisan profiles.
 */
function onSearch(): void {
	if (!selectedBakedGoods.value || selectedBakedGoods.value.length == 0) {
		return;
	}

	const filters: SearchFilters = {
		goods: selectedBakedGoods.value.map(good => good.key),
		dietary_options: selectedDietaryOptions.value.map(option => option.key),
		price_range: {
			min_price: minPrice.value, 
			max_price: maxPrice.value
		},
		options: {
			offers_delivery: offersDelivery.value,
			pick_up_on_site: pickUpOnSite.value,
		},
	};
	const urlParams = buildSearchParameters(filters);
	const searchURL = `/search?${urlParams}`;
	router.get(searchURL);
}

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
	padding: 14px 25px;
    border-radius: 24px;
}

.artisans-search-form {
	margin-top: 24px;

	.search-artisans-button {
		margin-top: 20px;
		width: 100%;
	}

	@media (max-height: 668px) {
		max-height: 420px;
		overflow-y: auto;
		scrollbar-width: none;
	}
}

.filter-options {
	display: flex;
	flex-direction: column;
	row-gap: 16px;

	:deep(> .select__dropdown-button) {
		border: 1px solid var(--color-neutral-30);
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
			margin: 12px 12px 24px 12px;
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

			> .price-input :deep(> input) {
				border: 1px solid var(--color-neutral-30);
			}

			> .price-input :deep(> label) {
				font-size: 14px;
			}

			@include breakpoints.respond-to('medium') {
				flex-direction: row;
			}
		}
	}
}
</style>