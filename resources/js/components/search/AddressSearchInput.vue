<template>
    <div class="address-autocomplete-form">
        <div class="autocomplete-input-wrapper">
            <input
                class="truncate" 
                id="autocomplete-input" 
                type="text" 
                placeholder="Standort eingeben (optional)" 
            />
            <MapPinIcon :style="{ color: 'var(--color-neutral-30)' }" />
        </div>
        <div class="suggestion-list-wrapper">
            <ul v-show="false">
                <li 
                    v-for="result in FAKE_ADDRESS_SUGGESTIONS" 
                    :key="result.id"
                >
                    <StoreIcon :style="{ color: 'var(--color-primary-50)' }" />
                    <span>{{ result.city }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import { MapPinIcon, StoreIcon } from "lucide-vue-next";

import { FAKE_ADDRESS_SUGGESTIONS } from "@/fake-data";
</script>

<style scoped lang="scss">
.address-autocomplete-form {
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
		width: 97%;
		margin: auto auto 16px;

		ul {
			border: 1px solid var(--color-neutral-30);
			border-radius: 12px;
			list-style-type: none;

			li {
				display: flex;
				align-items: center;
				gap: 6px;
				padding: 8px;

				&:hover {
					background-color: var(--color-primary-0);
				}
			}
		}
	}
}
</style>