<template>
	<div v-if="open" class="overlay" @click.self="close">
		<div class="sheet" :class="{ open: open }">
			<!-- Handle -->
			<div class="handle"></div>

			<!-- Header -->
			<div class="header">
				<h3>{{ name }}</h3>
				<p class="location"><MapPinIcon />{{ location }}</p>
			</div>

			<!-- Description -->
			<p class="description">
				{{ short_description }}
			</p>

			<!-- Links -->
			<div class="links">
				<a v-if="website" :href="website" target="_blank">
					<GlobeIcon />{{ website }}
				</a>
				<a v-if="instagram" :href="instagram" target="_blank">
					<Instagram />{{ instagram }}
				</a>
			</div>

			<!-- Close -->
			<button class="close-btn" @click="close">✕</button>
		</div>
	</div>
</template>

<script setup lang="ts">
import { GlobeIcon, MapPinIcon } from "lucide-vue-next";

import Instagram from "@/components/icons/Instagram.vue";

const { open = false, } = defineProps<{
    open?: boolean;
	name: string;
	location?: string;
	short_description: string;
	website?: string;
	instagram?: string;
}>();

const emit = defineEmits<{
	(e: "close"): void;
}>();

const close = () => emit('close');
</script>

<style scoped lang="scss">
/* Overlay */
.overlay {
	position: fixed;
	inset: 0;
	background:  rgba(0,0,0,0.3);
	backdrop-filter: blur(6px);
	display: flex;
	justify-content: center;
	align-items: flex-end;
	z-index: 1;
}

/* Sheet */
.sheet {
	background: white;
	width: 100%;
	max-width: 480px;
	border-radius: 20px 20px 0 0;
	padding: 16px;
	transform: translateY(100%);
	transition: transform 0.3s ease;
	position: relative;
}

/* Open state */
.sheet.open {
	transform: translateY(0);
}

/* Desktop adaptation */
@media (min-width: 768px) {
  	.overlay {
		align-items: center;
  	}

  	.sheet {
		border-radius: 20px;
		transform: scale(0.95);
		opacity: 0;
  	}

  	.sheet.open {
		transform: scale(1);
		opacity: 1;
  	}
}

/* Handle */
.handle {
	width: 40px;
	height: 4px;
	background: #ddd;
	border-radius: 2px;
	margin: 0 auto 12px;
}

/* Header */
.header h3 {
	margin: 0;
	font-size: 18px;
}

.location {
	color: #666;
	font-size: 14px;
	margin-top: 4px;
}

/* Description */
.description {
	margin: 12px 0;
	font-size: 14px;
	line-height: 1.5;
}

/* Links */
.links {
	display: flex;
	flex-direction: column;
	gap: 8px;
}

.links a {
	text-decoration: none;
	color: #1877f2;
	font-weight: 500;
}

/* Close button */
.close-btn {
	position: absolute;
	top: 12px;
	right: 12px;
	border: none;
	background: #f5f5f5;
	border-radius: 50%;
	width: 32px;
	height: 32px;
	cursor: pointer;
}
</style>