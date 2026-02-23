<template>
    <div class="address-autocomplete-form">
        <div class="autocomplete-input-wrapper">
            <input
                class="truncate" 
                id="autocomplete-input" 
                type="text" 
                placeholder="Standort eingeben (optional)"
                v-model="searchTerm" 
            />
            <MapPinIcon :style="{ color: 'var(--color-neutral-30)' }" />
        </div>
        <div class="suggestion-list-wrapper">
            <ul class="suggestion-list" v-if="suggestions.length">
                <li 
                    v-for="result in suggestions" 
                    :key="result"
                >
                    <button class="select-location-button">
                        <StoreIcon :style="{ color: 'var(--color-primary-50)' }" />
                        <span>{{ result}}</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

import { MapPinIcon, StoreIcon } from "lucide-vue-next";

import { get } from "@/api";

const MIN_ADDRESS_LENGHT = 3;
const DEBOUNCE_DELAY = 500;
let currentTimeout = 0;

const searchTerm = ref("");
const suggestions = ref<string[]>([]);
const selectedLocation = ref("");

async function triggerSuggestionSearch(input: string): Promise<void> {
    if (searchTerm.value.length < MIN_ADDRESS_LENGHT) return;

    const { data } = await get<string[]>(`/api/addresses/autocomplete?text=${input}`);
    suggestions.value = [...data];
}

watch(searchTerm, (newTerm) => {
    if (currentTimeout > 0) {
        clearTimeout(currentTimeout);
    }
    
    currentTimeout = setTimeout(() => triggerSuggestionSearch(newTerm), DEBOUNCE_DELAY);
});
</script>

<style scoped lang="scss">
.address-autocomplete-form {
    display: flex;
    flex-direction: column;
    row-gap: 16px;

    .autocomplete-input-wrapper {
		position: relative;
		width: 100%;

        > input {
			width: 100%;
            border: 1px solid var(--color-neutral-30);
            padding: 14px 34px;
            border-radius: 24px;

            &:focus-visible {
                outline: none;
            }
        }

        > svg {
			position: absolute;
			top: 14px;
			left: 5px;
        }
    }

	.suggestion-list-wrapper {
        position: relative;;
		width: 97%;
		margin: auto auto 16px;

		ul {
            position: absolute;
			border: 1px solid var(--color-neutral-30);
			border-radius: 12px;
			list-style-type: none;
            width: 100%;
            background-color: var(--color-neutral-0);
            z-index: 1;

			li {
                padding: 12px;

                > .select-location-button {
                    display: flex;
                    align-items: center;
                    gap: 8px;

                    > span {
                        width: 100%;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        white-space: nowrap;
                    }
                }

				&:hover {
					background-color: var(--color-primary-0);
                    border-radius: 12px;
                    cursor: pointer;
				}
			}
		}
	}
}
</style>