<template>
    <div class="address-autocomplete-form">
        <div class="autocomplete-input-wrapper">
            <input
                class="truncate" 
                id="autocomplete-input" 
                type="text" 
                placeholder="Standort eingeben (optional)"
                :value="locationText"
                @input="handleInput"
            />
            <MapPinIcon :style="{ color: 'var(--color-neutral-30)' }" />
        </div>
        <div 
            class="suggestions-list-wrapper" 
            v-if="isOpen"
            ref="suggestionsListDropdown"
        >
            <ul class="suggestions-list">
                <div class="suggestions-list-content">
                    <li 
                        v-for="result in suggestions" 
                        :key="result"
                    >
                        <button 
                            class="select-location-button"
                            type="button"  
                            @click="selectLocation(result)"
                        >
                            <StoreIcon class="store-icon" :style="{ color: 'var(--color-primary-50)' }" />
                            <span>{{ result }}</span>
                        </button>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

import { MapPinIcon, StoreIcon } from "lucide-vue-next";

import { get } from "@/api";

const MIN_ADDRESS_LENGHT = 3;
const DEBOUNCE_DELAY = 300;
let currentTimeout = 0;

const emit = defineEmits<{
    (e: "selected", value: string): void;
}>();

let controller: AbortController | null = null;

const locationText = ref("");
const selectedLocation = ref("");
const searchTerm = ref(locationText.value);

const suggestions = ref<string[]>([]);
const isOpen = ref(false);

function handleInput(event: Event): void {
    locationText.value = (event.target as HTMLInputElement).value;
    searchTerm.value = locationText.value;
}

function selectLocation(location: string): void {    
    selectedLocation.value = location;
    locationText.value = selectedLocation.value;
    emit("selected", selectedLocation.value);
    isOpen.value = false;
}

async function triggerSuggestionSearch(input: string): Promise<void> {
    if (controller != null) {
        controller.abort({ type: "AUTOCOMPLETE_ABORT", message: "User query updated." });
    }

    if (input.length == 0) {
        suggestions.value = [];
        return;
    } else if (input.length < MIN_ADDRESS_LENGHT) {
        return;
    }

    controller = new AbortController();
    try {
        const { data } = await get<string[]>(`/api/addresses/autocomplete?text=${input}`, {
            signal: controller.signal,
        });
        suggestions.value = [...data];
    } catch (error: any) {
        console.error(error);
    }
}

watch(searchTerm, (newTerm) => {
    if (currentTimeout > 0) {
        clearTimeout(currentTimeout);
    }

    currentTimeout = setTimeout(() => triggerSuggestionSearch(newTerm), DEBOUNCE_DELAY);
});

watch(suggestions, (newSuggestions) => {
    isOpen.value = newSuggestions.length > 0;
});
</script>

<style scoped lang="scss">
.address-autocomplete-form {
    display: flex;
    flex-direction: column;
    row-gap: 16px;
    margin-bottom: 16px;

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

	.suggestions-list-wrapper {
        position: relative;
		width: 100%;

		.suggestions-list {
            position: absolute;
			border: 1px solid var(--color-neutral-30);
			border-radius: 12px;
			list-style-type: none;
            width: 100%;
            left: 0;
            right: 0;
            padding: 12px 8px;
            background-color: var(--color-neutral-0);
            z-index: 1;

            > .suggestions-list-content {
                max-height: 240px;
                overflow: auto;
            }

			li {
                width: 100%;
                padding: 8px;

                > .select-location-button {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    gap: 8px;

                    > .store-icon {
                        width: 24px;
                    }

                    > span {
                        width: 80%;
                        text-align: start;
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