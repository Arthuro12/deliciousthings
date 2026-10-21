<template>
    <div class="app-content-wrapper creation-form-page">
        <Head :title="creation ? 'Kreation bearbeiten' : 'Kreation hinzufügen'" />
        <main class="app-content">
            <Link href="/app/artisan/creations" class="creation-back">← Zurück zu meinen Kreationen</Link>
            <header class="creation-form-heading"><p class="creations-eyebrow">Dein Schaufenster</p><h1>{{ creation ? 'Kreation bearbeiten' : 'Erste Kreation hinzufügen' }}</h1><p>Zeige Kund:innen, was deine Arbeit besonders macht.</p></header>
            <form class="creation-form" @submit.prevent="submit">
                <label class="creation-field"><span>Titel <b>*</b></span><input v-model="form.title" maxlength="120" placeholder="z. B. Blumentorte zum Geburtstag" required /><small v-if="form.errors.title">{{ form.errors.title }}</small></label>
                <label class="creation-field"><span>Beschreibung <b>*</b></span><textarea v-model="form.description" rows="5" maxlength="3000" placeholder="Beschreibe Stil, Geschmack oder besondere Details." required /><small v-if="form.errors.description">{{ form.errors.description }}</small></label>
                <section class="creation-field"><span>Preisangabe</span><div class="creation-price"><label><input v-model="form.price_on_request" type="checkbox" /> Preis auf Anfrage</label><label class="creation-price__input"><span>Preis (optional)</span><span class="euro-input"><input v-model="form.price" type="number" min="0" step="0.01" placeholder="z. B. 85" :disabled="form.price_on_request" /><b>€</b></span></label></div><small v-if="form.errors.price">{{ form.errors.price }}</small></section>
                <label class="creation-field"><span>Fotos {{ creation ? '(weitere Fotos hinzufügen)' : '*' }}</span><input type="file" accept="image/*" multiple :required="!creation" @change="selectPhotos" /><small>Bis zu 6 Bilder, JPG, PNG oder WebP, maximal 5 MB je Bild.</small><small v-if="form.errors.photos">{{ form.errors.photos }}</small><small v-if="form.errors['photos.0']">{{ form.errors['photos.0'] }}</small><div v-if="creation?.photos.length" class="existing-photos"><img v-for="photo in creation.photos" :key="photo.id" :src="photo.url" :alt="creation.title" /></div></label>
                <label class="creation-publish"><input v-model="form.is_published" type="checkbox" /> Direkt auf meiner öffentlichen Vitrine veröffentlichen</label>
                <div v-if="form.hasErrors" class="creation-errors" role="alert">Bitte prüfe die markierten Angaben.</div>
                <div class="creation-actions"><Link href="/app/artisan/creations" class="button button--outline button--lg">Abbrechen</Link><button class="button button--primary button--lg" type="submit" :disabled="form.processing">{{ form.processing ? 'Wird gespeichert …' : 'Speichern' }}</button></div>
            </form>
        </main>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import Layout from '@/platform/layout/AppLayout.vue';

defineOptions({ layout: Layout });
type Creation = { id: number; title: string; description: string; price: string | null; price_on_request: boolean; is_published: boolean; photos: { id: number; url: string }[] };
const props = defineProps<{ creation: Creation | null }>();
const form = useForm({ title: props.creation?.title ?? '', description: props.creation?.description ?? '', price: props.creation?.price ?? '', price_on_request: props.creation?.price_on_request ?? false, is_published: props.creation?.is_published ?? true, photos: [] as File[] });
function selectPhotos(event: Event) { const input = event.target as HTMLInputElement; form.photos = Array.from(input.files ?? []).slice(0, 6); }
function submit() { props.creation ? form.put(`/app/artisan/creations/${props.creation.id}`) : form.post('/app/artisan/creations'); }
</script>

<style scoped lang="scss">
.creation-form-page { padding-bottom:var(--space-24); }
.creation-back { display:inline-block; margin-bottom:var(--space-5); color:var(--color-text-secondary); text-decoration:none; }
.creation-form-heading { margin-bottom:var(--space-6); }
.creation-form-heading h1 { margin:0; font-family:var(--font-heading); }
.creation-form-heading>p:last-child { color:var(--color-text-secondary); }
.creations-eyebrow { margin:0 0 var(--space-2); color:var(--color-text-brand); font-size:var(--font-size-xs); font-weight:var(--font-weight-bold); letter-spacing:.08em; text-transform:uppercase; }
.creation-form { display:grid; gap:var(--space-5); max-width:780px; padding:var(--card-padding-lg); background:var(--card-background); border:1px solid var(--card-border); border-radius:var(--card-radius); box-shadow:var(--card-shadow); }
.creation-field { display:grid; gap:var(--space-2); color:var(--color-text-primary); font-size:var(--font-size-sm); font-weight:var(--font-weight-semibold); }
.creation-field input:not([type=file]),.creation-field textarea { width:100%; padding:var(--space-3) var(--space-4); color:var(--input-text); background:var(--input-background); border:1px solid var(--input-border); border-radius:var(--radius-md); font:inherit; }
.creation-field textarea { resize:vertical; }
.creation-field small { color:var(--color-text-secondary); font-size:var(--font-size-xs); font-weight:var(--font-weight-regular); }
.creation-price { display:grid; gap:var(--space-4); }
.creation-price>label:first-child,.creation-publish { display:flex; align-items:center; gap:var(--space-2); color:var(--color-text-secondary); font-weight:var(--font-weight-regular); }
.creation-price__input { display:grid; gap:var(--space-2); max-width:260px; }
.euro-input { display:flex; align-items:center; gap:var(--space-2); }
.euro-input b { color:var(--color-text-secondary); }
.existing-photos { display:flex; flex-wrap:wrap; gap:var(--space-2); margin-top:var(--space-2); }
.existing-photos img { width:100px; height:100px; object-fit:cover; border-radius:var(--radius-md); }
.creation-errors { padding:var(--space-3); color:var(--color-text-danger); background:var(--color-danger-50); border-radius:var(--radius-md); }
.creation-actions { display:flex; justify-content:flex-end; gap:var(--space-3); padding-top:var(--space-2); }
@media(max-width:600px) { .creation-form { padding:var(--space-5); } .creation-actions>* { flex:1; justify-content:center; } }
</style>
