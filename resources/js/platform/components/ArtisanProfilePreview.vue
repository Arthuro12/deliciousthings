<template>
    <aside class="artisan-preview" aria-label="Profilvorschau">
        <div class="artisan-preview__top">
            <span>Deine Vorschau</span>
            <span class="artisan-preview__live"><i></i> Live</span>
        </div>
        <div class="artisan-preview__cover">
            <img v-if="photos[0]" :src="photos[0]" alt="" />
            <div v-else class="artisan-preview__placeholder"><span aria-hidden="true">✳</span><small>Deine Kreationen erscheinen hier</small></div>
        </div>
        <div class="artisan-preview__body">
            <p class="artisan-preview__location">BERLIN · PATISSERIE & CAKE DESIGN</p>
            <h2>{{ name || 'Dein Ateliername' }}</h2>
            <p v-if="tagline" class="artisan-preview__tagline">{{ tagline }}</p>
            <p v-else class="artisan-preview__empty">Ein kurzer Satz über deine Arbeit</p>
            <div v-if="specialties.length" class="artisan-preview__tags"><span v-for="good in specialties.slice(0, 3)" :key="good.key">{{ good.label }}</span></div>
            <p class="artisan-preview__about">{{ about || 'Deine Vorstellung gibt Kund:innen einen persönlichen Einblick in dein Atelier und deine Arbeitsweise.' }}</p>
            <div class="artisan-preview__details"><span v-if="pickup">Abholung</span><span v-if="delivery">Lieferung nach Absprache</span></div>
            <div class="artisan-preview__preview-label">So sehen deine Bilder aus</div>
            <div class="artisan-preview__mini-gallery">
                <div v-for="photo in photos.slice(0, 3)" :key="photo"><img :src="photo" alt="" /></div>
                <div v-if="!photos.length" class="artisan-preview__empty-image">＋</div>
            </div>
            <button type="button" class="artisan-preview__cta" disabled>Anfrage senden <span aria-hidden="true">→</span></button>
            <p class="artisan-preview__footnote">Vorschau · Änderungen sind noch nicht gespeichert</p>
        </div>
    </aside>
</template>

<script setup lang="ts">
type Specialty = { key: string; label: string };

defineProps<{
    name: string;
    tagline: string;
    about: string;
    specialties: Specialty[];
    pickup: boolean;
    delivery: boolean;
    photos: string[];
}>();
</script>

<style scoped lang="scss">
.artisan-preview { position: sticky; top: calc(var(--app-header-height) + var(--space-5)); overflow: hidden; background: #fff; border: 1px solid var(--color-border-subtle); border-radius: var(--radius-2xl); box-shadow: var(--shadow-sm); }
.artisan-preview__top { display: flex; align-items: center; justify-content: space-between; padding: var(--space-4) var(--space-5); color: var(--color-text-secondary); border-bottom: 1px solid var(--color-border-subtle); font-size: var(--font-size-xs); font-weight: var(--font-weight-semibold); }
.artisan-preview__live { display: inline-flex; align-items: center; gap: 6px; color: var(--color-text-muted); font-weight: var(--font-weight-regular); }
.artisan-preview__live i { width: 6px; height: 6px; background: var(--color-success-500); border-radius: 50%; }
.artisan-preview__cover { height: 215px; overflow: hidden; background: var(--color-background-blush); }
.artisan-preview__cover img,.artisan-preview__mini-gallery img { width: 100%; height: 100%; object-fit: cover; }
.artisan-preview__placeholder { display: grid; height: 100%; align-content: center; justify-items: center; gap: var(--space-2); color: var(--color-text-brand); }
.artisan-preview__placeholder span { font-size: 40px; }
.artisan-preview__placeholder small { color: var(--color-text-muted); font-size: var(--font-size-xs); }
.artisan-preview__body { padding: var(--space-6); }
.artisan-preview__location { margin: 0 0 var(--space-2); color: var(--color-text-brand); font-size: 9px; font-weight: var(--font-weight-bold); letter-spacing: .1em; }
.artisan-preview__body h2 { margin: 0; color: var(--color-text-primary); font-family: var(--font-heading); font-size: clamp(1.6rem, 2vw, 2.1rem); font-weight: var(--font-weight-medium); letter-spacing: -.03em; line-height: 1.08; overflow-wrap: anywhere; }
.artisan-preview__tagline { margin: var(--space-2) 0 0; color: var(--color-text-secondary); font-family: var(--font-heading); font-size: var(--font-size-md); }
.artisan-preview__empty { margin: var(--space-2) 0 0; color: var(--color-text-muted); font-size: var(--font-size-sm); font-style: italic; }
.artisan-preview__tags { display: flex; flex-wrap: wrap; gap: 6px; margin-top: var(--space-4); }
.artisan-preview__tags span { padding: 6px 9px; color: var(--color-text-brand); background: var(--color-background-soft); border-radius: var(--radius-full); font-size: 10px; }
.artisan-preview__about { display: -webkit-box; overflow: hidden; margin: var(--space-4) 0; color: var(--color-text-secondary); font-size: var(--font-size-xs); line-height: var(--line-height-relaxed); -webkit-box-orient: vertical; -webkit-line-clamp: 4; }
.artisan-preview__details { display: flex; flex-wrap: wrap; gap: var(--space-2); }
.artisan-preview__details span { padding: 6px 8px; color: var(--color-text-secondary); background: var(--color-background-warm); border-radius: var(--radius-sm); font-size: 10px; }
.artisan-preview__preview-label { margin: var(--space-5) 0 var(--space-2); color: var(--color-text-primary); font-size: var(--font-size-xs); font-weight: var(--font-weight-semibold); }
.artisan-preview__mini-gallery { display: grid; grid-template-columns: repeat(3, 1fr); gap: 7px; }
.artisan-preview__mini-gallery > div { overflow: hidden; aspect-ratio: 1.12; background: var(--color-background-blush); border-radius: var(--radius-md); }
.artisan-preview__empty-image { display: grid; place-items: center; color: var(--color-text-brand); font-size: 24px; }
.artisan-preview__cta { display: flex; width: 100%; justify-content: center; gap: var(--space-3); margin-top: var(--space-5); padding: 13px; color: #fff; background: var(--color-brand-primary-500); border: 0; border-radius: var(--radius-full); font: inherit; font-size: var(--font-size-sm); font-weight: var(--font-weight-semibold); }
.artisan-preview__cta:disabled { cursor: default; }
.artisan-preview__footnote { margin: var(--space-3) 0 0; color: var(--color-text-muted); font-size: 10px; text-align: center; }
@media (max-width: 980px) { .artisan-preview { position: static; grid-row: 1; } .artisan-preview__cover { height: clamp(150px, 35vw, 250px); } }
@media (max-width: 600px) { .artisan-preview__body { padding: var(--space-5); } }
</style>
