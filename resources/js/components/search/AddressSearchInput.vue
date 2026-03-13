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
            <MapPinIcon color="#696c70" />
        </div>
        <div 
            class="suggestions-list-wrapper" 
            v-if="isOpen"
            v-click-outside="closeDropdownList"
        >
            <ul class="suggestions-list">
                <div class="suggestions-list-content">
                    <li 
                        v-for="result in suggestions" 
                        :key="`${result.formatted}`"
                    >
                        <button 
                            class="select-location-button"
                            type="button"  
                            @click="selectLocation(result)"
                        >
                            <MapPinIcon class="map-icon" color="#e680a5" />
                            <span class="location-text">{{ result.formatted }}</span>
                        </button>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";

import { MapPinIcon } from "lucide-vue-next";

import { vClickOutside } from "@/directives/v-click-outside";
import { get } from "@/api";
import type { AddressSuggestion } from "@/types/search";

const MIN_ADDRESS_LENGHT = 3;
const DEBOUNCE_DELAY = 200;
let currentTimeout = 0;

const props = defineProps<{
    text?: string | null;
}>();

const emit = defineEmits<{
    (e: "updated:text", value: string): void;
    (e: "selected", value: AddressSuggestion | null): void;
}>();

let controller: AbortController | null = null;

const locationText = ref(props.text ?? "");
const selectedLocation = ref<AddressSuggestion | undefined>(undefined);
const searchTerm = ref(locationText.value);

const suggestions = ref<AddressSuggestion[]>([]);
const isOpen = ref(false);

function closeDropdownList(): void {
    isOpen.value = false;
}

function handleInput(event: Event): void {
    const target = (event.target as HTMLInputElement);
    if (target.value.length == 0) {
        emit("selected", null);
    }

    locationText.value = target.value;
    searchTerm.value = locationText.value;
    emit("updated:text", locationText.value);
}

function selectLocation(location: AddressSuggestion): void {    
    selectedLocation.value = location;
    locationText.value = selectedLocation.value.formatted;
    emit("selected", selectedLocation.value);
    emit("updated:text", locationText.value);
    closeDropdownList();
}

async function triggerSuggestionSearch(input: string): Promise<void> {
    if (controller != null) {
        controller.abort({ 
            name: "AbortError",
            type: "AUTOCOMPLETE_ABORT", 
            message: "User query updated." 
        });
    }

    if (input.length == 0) {
        suggestions.value = [];
        return;
    } else if (input.length < MIN_ADDRESS_LENGHT) {
        return;
    }

    controller = new AbortController();
    try {
        const { data } = await get<AddressSuggestion[]>(`/api/addresses/autocomplete?text=${input}`, {
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

                    > .map-icon {
                        width: 24px;
                    }

                    > .location-text {
                        color: var(--color-neutral-50);
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