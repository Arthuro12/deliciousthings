<template>
    <div class="app-content-wrapper creations-page">
        <Head title="Meine Kreationen" />
        <main class="app-content">
            <header class="creations-heading">
                <div><p class="creations-eyebrow">Dein Schaufenster</p><h1>Meine Kreationen</h1><p>Präsentiere deine Arbeit und entscheide, was öffentlich sichtbar ist.</p></div>
                <Link href="/app/artisan/creations/create" class="button button--primary button--lg">＋ Kreation hinzufügen</Link>
            </header>
            <section v-if="creations.length" class="creation-list" aria-label="Deine Kreationen">
                <article v-for="creation in creations" :key="creation.id" class="creation-card">
                    <div class="creation-card__photos">
                        <img v-if="creation.photos[0]" :src="creation.photos[0].url" :alt="creation.title" />
                        <span v-else aria-hidden="true">✳</span>
                    </div>
                    <div class="creation-card__body">
                        <div class="creation-card__title"><div><span :class="['creation-status', creation.is_published ? 'creation-status--live' : '']">{{ creation.is_published ? 'Veröffentlicht' : 'Entwurf' }}</span><h2>{{ creation.title }}</h2></div><span class="creation-card__price">{{ priceLabel(creation) }}</span></div>
                        <p>{{ creation.description }}</p>
                        <div class="creation-card__actions">
                            <Link :href="`/app/artisan/creations/${creation.id}/edit`" class="button button--outline">Bearbeiten</Link>
                            <button type="button" class="button button--outline" @click="toggle(creation)">{{ creation.is_published ? 'Ausblenden' : 'Veröffentlichen' }}</button>
                            <button type="button" class="creation-delete" @click="remove(creation)">Löschen</button>
                        </div>
                    </div>
                </article>
            </section>
            <section v-else class="creations-empty">
                <span class="creations-empty__icon" aria-hidden="true">✳</span>
                <h2>Dein Schaufenster wartet auf deine erste Kreation</h2>
                <p>Füge Fotos und eine Beschreibung hinzu. Du entscheidest, wann die Kreation öffentlich sichtbar wird.</p>
                <Link href="/app/artisan/creations/create" class="button button--primary button--lg">Erste Kreation hinzufügen</Link>
            </section>
        </main>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import Layout from '@/platform/layout/AppLayout.vue';

defineOptions({ layout: Layout });
type Photo = { id: number; url: string };
type Creation = { id: number; title: string; description: string; price: string | null; price_on_request: boolean; is_published: boolean; photos: Photo[] };
const props = defineProps<{ creations: Creation[] }>();
function priceLabel(creation: Creation) {
    if (creation.price_on_request) return 'Auf Anfrage';
    if (!creation.price) return 'Preis nach Absprache';
    return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Number(creation.price));
}
function toggle(creation: Creation) { router.patch(`/app/artisan/creations/${creation.id}/publication`, {}, { preserveScroll: true }); }
function remove(creation: Creation) {
    if (window.confirm(`„${creation.title}“ wirklich löschen?`)) router.delete(`/app/artisan/creations/${creation.id}`);
}
</script>

<style scoped lang="scss">
.creations-page { padding-bottom: var(--space-24); }
.creations-heading { display:flex; justify-content:space-between; align-items:flex-end; gap:var(--space-6); margin-bottom:var(--space-8); }
.creations-eyebrow { margin:0 0 var(--space-2); color:var(--color-text-brand); font-size:var(--font-size-xs); font-weight:var(--font-weight-bold); letter-spacing:.08em; text-transform:uppercase; }
.creations-heading h1 { margin:0; font-family:var(--font-heading); }
.creations-heading p:last-child { margin:var(--space-3) 0 0; color:var(--color-text-secondary); }
.creation-list { display:grid; gap:var(--space-5); }
.creation-card { display:grid; grid-template-columns:220px minmax(0,1fr); overflow:hidden; background:var(--card-background); border:1px solid var(--card-border); border-radius:var(--card-radius); box-shadow:var(--card-shadow); }
.creation-card__photos { display:grid; min-height:200px; place-items:center; color:var(--color-text-brand); background:var(--color-background-blush); font-size:2rem; }
.creation-card__photos img { width:100%; height:100%; min-height:200px; object-fit:cover; }
.creation-card__body { padding:var(--space-5); }
.creation-card__title { display:flex; justify-content:space-between; gap:var(--space-4); }
.creation-card h2 { margin:var(--space-2) 0 0; font-family:var(--font-heading); }
.creation-card__body>p { color:var(--color-text-secondary); white-space:pre-line; }
.creation-status { padding:5px 9px; color:var(--color-text-secondary); background:var(--color-background-muted); border-radius:var(--radius-full); font-size:var(--font-size-xs); }
.creation-status--live { color:var(--color-text-success); background:var(--color-success-50); }
.creation-card__price { color:var(--color-text-brand); font-size:var(--font-size-sm); font-weight:var(--font-weight-semibold); white-space:nowrap; }
.creation-card__actions { display:flex; align-items:center; flex-wrap:wrap; gap:var(--space-2); margin-top:var(--space-4); }
.creation-delete { padding:var(--space-2) var(--space-3); color:var(--color-text-danger); background:transparent; border:0; cursor:pointer; font:inherit; }
.creations-empty { display:grid; justify-items:center; padding:var(--space-16) var(--space-6); text-align:center; background:var(--color-surface-card); border:1px solid var(--color-border-subtle); border-radius:var(--radius-2xl); }
.creations-empty__icon { display:grid; width:56px; height:56px; place-items:center; color:var(--color-text-brand); background:var(--color-background-soft); border-radius:50%; font-size:1.8rem; }
.creations-empty h2 { margin:var(--space-5) 0 var(--space-2); font-family:var(--font-heading); }
.creations-empty p { max-width:520px; margin:0 0 var(--space-5); color:var(--color-text-secondary); }
@media(max-width:700px) { .creations-heading { align-items:stretch; flex-direction:column; } .creation-card { grid-template-columns:1fr; } .creation-card__photos,.creation-card__photos img { min-height:180px; max-height:260px; } }
</style>
