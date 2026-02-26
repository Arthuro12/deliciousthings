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
							v-model:selected-value="form.goods"
						/>
						<RekaSelect 
							class="search-filter"
							placeholder="Ernährungsformen" 
							show-item-indicator
							:items="dietaryOptionStore.dietaryOptions"
							label-prop="label"
							value-prop="key"
							multiple
							v-model:selected-value="form.dietary_options"
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
											v-model="form.offers_delivery"
										/>
										<RekaCheckbox 
											id="offers-delivery"
											label="Abholung vor Ort"
											v-model="form.pick_up_on_site"
										/>
									</div>
									<div class="price-levels-wrapper form__group">
										<header>Preiskategorie</header>
										<PriceLevelSelect v-model="form.price_levels" />
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
import { router, useForm } from "@inertiajs/vue3";

import { 
	MinusIcon,
	PlusIcon,
	SlidersHorizontalIcon 
} from "lucide-vue-next";

import AppButton from "../presentation/AppButton.vue";
import RekaCollapsible from "@/third-party/reka-ui/RekaCollapsible.vue";
import RekaDialog from "@/third-party/reka-ui/RekaDialog.vue";
import RekaSelect from "@/third-party/reka-ui/RekaSelect.vue";
import RekaCheckbox from "@/third-party/reka-ui/RekaCheckbox.vue";
import AddressSearchInput from "./AddressSearchInput.vue";
import PriceLevelSelect from "./PriceLevelSelect.vue";

import { useBakedGoodStore } from "@/stores/baked-good";
import { useDietaryOptionStore } from "@/stores/dietary-option";
import type { BakedGood, DietaryOption } from "@/types/users";

export type SearchFormData = {
	goods: BakedGood[];
	dietary_options?: DietaryOption[];
	price_levels: string[];
	offers_delivery?: boolean | null;
	pick_up_on_site?: boolean | null;
};

export type SearchFilters = {
	goods: string[];
	dietary_options?: string[];
	price_levels: string[];
	offers_delivery?: boolean | null;
	pick_up_on_site?: boolean | null;
};

const bakedGoodStore = useBakedGoodStore();
const dietaryOptionStore = useDietaryOptionStore();

const form = useForm<SearchFormData>("ArtisanSearch", {
	goods: [],
	dietary_options: [],
	price_levels: [],
	offers_delivery: null,
	pick_up_on_site: null,
});

const servicesContentIsVisible = ref(false);

/**
 * Builds search URL query string.
 * 
 * @param filters 
 */
function buildSearchParameters(filters: SearchFilters): string {
	const params = new URLSearchParams();

	params.set("goods", filters.goods.join(","))
	if (filters.dietary_options && filters.dietary_options.length > 0) {
		params.set("dietary_option", filters.dietary_options.join(","))
	}
	if (filters.dietary_options && filters.dietary_options.length > 0) {
		params.set("dietary_options", filters.dietary_options.join(","))
	}
	if (filters.price_levels.length > 0) {
		params.set("price_levels", filters.price_levels.join(","));
	}
	if (filters.offers_delivery != null) {
		params.set("offers_delivery", JSON.stringify(filters.offers_delivery ? 1 : 0));
	}
	if (filters.pick_up_on_site != null) {
		params.set("pick_up_on_site", JSON.stringify(filters.pick_up_on_site ? 1 : 0));
	}

	return params.toString();
}

/**
 * Search for artisan profiles.
 */
function onSearch(): void {
	if (!form.goods || form.goods.length == 0) {
		return;
	}

	const filters: SearchFilters = {
		goods: form.goods.map(good => good.key),
		dietary_options: form.dietary_options?.map(good => good.key),
		price_levels: form.price_levels,
		offers_delivery: form.offers_delivery,
		pick_up_on_site: form.pick_up_on_site,
	};
	const urlParams = buildSearchParameters(filters);
	const searchURL = `/search?${urlParams}`;
	router.visit(searchURL, { preserveState: true });
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

	.price-levels-wrapper {
		margin-top: 16px;
	}
}
</style>