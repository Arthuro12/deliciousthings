<template>
    <div class="public-shop">
        <Head :title="artisan.company_name || artisan.name" />
        <header class="shop-header"><Link href="/" class="shop-brand">Deliciousthings</Link><Link href="/app/requests/create" class="button button--primary">Kreation anfragen</Link></header>
        <main>
            <section class="shop-intro"><p class="shop-eyebrow">Dein Backprofi</p><h1>{{ artisan.company_name || artisan.name }}</h1><p v-if="artisan.short_description" class="shop-tagline">{{ artisan.short_description }}</p><p class="shop-about">{{ artisan.about }}</p><div class="shop-specialties"><span v-for="good in artisan.baked_goods" :key="good.key">{{ good.label }}</span></div><Link href="/app/requests/create" class="button button--primary button--lg">Individuelle Kreation anfragen <span aria-hidden="true">→</span></Link></section>
            <section v-if="artisan.creations.length" class="shop-section"><div class="shop-section__heading"><p class="shop-eyebrow">Aus dem Schaufenster</p><h2>Meine Kreationen</h2></div><div class="shop-creations"><article v-for="creation in artisan.creations" :key="creation.id" class="shop-creation"><div class="shop-creation__image"><img v-if="creation.photos[0]" :src="creation.photos[0]" :alt="creation.title" /><span v-else aria-hidden="true">✳</span></div><div class="shop-creation__body"><h3>{{ creation.title }}</h3><p>{{ creation.description }}</p><strong>{{ priceLabel(creation) }}</strong></div></article></div></section>
            <section v-if="artisan.gallery.length" class="shop-section"><div class="shop-section__heading"><p class="shop-eyebrow">Einblicke</p><h2>Weitere Eindrücke</h2></div><div class="shop-gallery"><img v-for="photo in artisan.gallery" :key="photo.id" :src="photo.url" alt="Einblick in die Arbeit" /></div></section>
        </main>
        <footer class="shop-footer">{{ artisan.name }} · Deliciousthings</footer>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

type Creation = { id: number; title: string; description: string; price: string | null; price_on_request: boolean; photos: string[] };
type ArtisanProfile = { id: number; name: string; company_name: string | null; short_description: string | null; about: string; baked_goods: { key: string; label: string }[]; gallery: { id: number; url: string }[]; creations: Creation[] };
const props = defineProps<{ artisan: ArtisanProfile }>();
function priceLabel(creation: Creation) {
    if (creation.price_on_request) return 'Preis auf Anfrage';
    if (!creation.price) return 'Preis nach Absprache';
    return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Number(creation.price));
}
</script>

<style scoped lang="scss">
.public-shop { min-height:100vh; color:var(--color-text-primary); background:var(--color-background-page); }
.shop-header { display:flex; align-items:center; justify-content:space-between; padding:var(--space-5) clamp(20px,6vw,88px); background:var(--color-surface-card); border-bottom:1px solid var(--color-border-subtle); }
.shop-brand { color:var(--color-text-brand); font-family:var(--font-heading); font-size:var(--font-size-xl); font-weight:var(--font-weight-bold); text-decoration:none; }
.public-shop main { width:min(1120px, calc(100% - 40px)); margin:0 auto; }
.shop-intro { max-width:760px; padding:clamp(56px,10vw,120px) 0 72px; }
.shop-eyebrow { margin:0 0 var(--space-3); color:var(--color-text-brand); font-size:var(--font-size-xs); font-weight:var(--font-weight-bold); letter-spacing:.1em; text-transform:uppercase; }
.shop-intro h1 { margin:0; font-family:var(--font-heading); font-size:clamp(2.5rem,7vw,5rem); line-height:1.02; }
.shop-tagline { margin:var(--space-4) 0 0; font-family:var(--font-heading); font-size:var(--font-size-xl); }
.shop-about { margin:var(--space-5) 0; color:var(--color-text-secondary); line-height:var(--line-height-relaxed); white-space:pre-line; }
.shop-specialties { display:flex; flex-wrap:wrap; gap:var(--space-2); margin:var(--space-5) 0 var(--space-6); }
.shop-specialties span { padding:7px 11px; color:var(--color-text-brand); background:var(--color-background-soft); border-radius:var(--radius-full); font-size:var(--font-size-xs); }
.shop-section { padding:var(--space-10) 0; border-top:1px solid var(--color-border-subtle); }
.shop-section__heading { margin-bottom:var(--space-5); }
.shop-section h2 { margin:0; font-family:var(--font-heading); font-size:clamp(1.8rem,4vw,2.8rem); }
.shop-creations { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:var(--space-5); }
.shop-creation { overflow:hidden; background:var(--card-background); border:1px solid var(--card-border); border-radius:var(--card-radius); box-shadow:var(--card-shadow); }
.shop-creation__image { display:grid; aspect-ratio:4/3; place-items:center; color:var(--color-text-brand); background:var(--color-background-blush); font-size:2rem; }
.shop-creation__image img { width:100%; height:100%; object-fit:cover; }
.shop-creation__body { padding:var(--space-5); }
.shop-creation h3 { margin:0; font-family:var(--font-heading); font-size:var(--font-size-xl); }
.shop-creation p { color:var(--color-text-secondary); white-space:pre-line; }
.shop-creation strong { color:var(--color-text-brand); }
.shop-gallery { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:var(--space-3); }
.shop-gallery img { width:100%; aspect-ratio:1; object-fit:cover; border-radius:var(--radius-lg); }
.shop-footer { padding:var(--space-8) 20px; color:var(--color-text-muted); text-align:center; }
@media(max-width:600px) { .shop-header { padding:var(--space-4) 20px; } .shop-header .button { font-size:var(--font-size-xs); } }
</style>
