<template>
    <div class="artisan-create app-content-wrapper">
        <Head title="Profil erstellen" />
        <main class="artisan-create__main">
            <header class="artisan-create__page-heading">
                <div>
                    <Link class="artisan-create__back-link" href="/app">
                        <span aria-hidden="true">←</span> Zurück zum Workspace
                    </Link>
                    <p class="artisan-create__eyebrow">Dein Auftritt auf Deliciousthings</p>
                    <h1>Erzähl uns von deiner Backkunst.</h1>
                    <p class="artisan-create__intro">Ein gutes Profil hilft Kundinnen und Kunden, deinen Stil kennenzulernen und eine passende Anfrage zu stellen.</p>
                </div>
                <span class="artisan-create__draft"><span aria-hidden="true"></span> Noch nicht gespeichert</span>
            </header>

            <div class="artisan-create__columns">
                <form class="artisan-create__form" @submit.prevent="submit">
                    <section class="artisan-card artisan-card--intro" aria-labelledby="profile-section-title">
                        <div class="artisan-card__heading">
                            <span class="artisan-card__step">01</span>
                            <div><h2 id="profile-section-title">Dein Profil</h2><p>Die wichtigsten Informationen über dich und dein Atelier.</p></div>
                        </div>
                        <div class="artisan-fields">
                            <label class="artisan-field artisan-field--wide">
                                <span>Profilname <b>*</b></span>
                                <input v-model="form.name" autocomplete="organization" placeholder="z. B. Atelier Blütenrausch" required minlength="5" maxlength="100" />
                                <small v-if="form.errors.name" class="artisan-field__error">{{ form.errors.name }}</small>
                            </label>
                            <label class="artisan-field">
                                <span>Deine Rolle</span>
                                <input v-model="form.main_occupation" maxlength="150" placeholder="Cake Designer:in" />
                            </label>
                            <label class="artisan-field">
                                <span>Atelier oder Unternehmen <em>optional</em></span>
                                <input v-model="form.company_name" maxlength="150" placeholder="Name deiner Konditorei" />
                            </label>
                            <label class="artisan-field artisan-field--wide">
                                <span>In einem Satz <em>optional</em></span>
                                <input v-model="form.short_description" maxlength="200" placeholder="Individuelle Torten mit Liebe zum Detail" />
                            </label>
                            <label class="artisan-field artisan-field--wide">
                                <span>Über dich und deine Arbeit <b>*</b></span>
                                <textarea v-model="form.about" rows="5" minlength="20" maxlength="500" placeholder="Was machst du besonders gern? Was können Kund:innen von deiner Arbeit erwarten?" required />
                                <small class="artisan-field__meta"><span v-if="form.errors.about" class="artisan-field__error">{{ form.errors.about }}</span><span v-else>Mindestens 20 Zeichen</span><span>{{ form.about.length }} / 500</span></small>
                            </label>
                        </div>
                    </section>

                    <section class="artisan-card" aria-labelledby="offer-section-title">
                        <div class="artisan-card__heading">
                            <span class="artisan-card__step">02</span>
                            <div><h2 id="offer-section-title">Dein Angebot</h2><p>Wähle die Kreationen und Übergabeoptionen, die zu dir passen.</p></div>
                        </div>
                        <div class="artisan-field artisan-field--wide">
                            <span>Was backst du am liebsten? <b>*</b></span>
                            <p class="artisan-create__helper">Wähle alle Bereiche aus, die du anbietest.</p>
                            <div v-if="bakedGoods.length" class="artisan-goods">
                                <label v-for="good in bakedGoods" :key="good.key" class="artisan-good" :class="{ 'artisan-good--selected': isSelected(good.key) }">
                                    <input v-model="form.baked_goods" type="checkbox" :value="good" />
                                    <span>{{ good.label }}</span>
                                    <span v-if="isSelected(good.key)" class="artisan-good__check" aria-hidden="true">✓</span>
                                </label>
                            </div>
                            <p v-else class="artisan-create__notice" role="status">Die Angebotsauswahl ist gerade nicht verfügbar. Bitte lade die Seite später erneut.</p>
                            <small v-if="form.errors.baked_goods" class="artisan-field__error">{{ form.errors.baked_goods }}</small>
                        </div>

                        <div class="artisan-create__delivery">
                            <div><strong>Wie können Kund:innen deine Kreationen erhalten?</strong><span>Wähle mindestens eine Option.</span></div>
                            <label class="artisan-switch"><input v-model="form.pick_up_on_site" type="checkbox" /><span class="artisan-switch__track"></span><span>Abholung</span></label>
                            <label class="artisan-switch"><input v-model="form.offers_delivery" type="checkbox" /><span class="artisan-switch__track"></span><span>Lieferung nach Absprache</span></label>
                            <small v-if="!form.pick_up_on_site && !form.offers_delivery" class="artisan-field__error">Wähle Abholung oder Lieferung aus.</small>
                        </div>

                        <label class="artisan-field artisan-field--rate">
                            <span>Typischer Auftragswert in Euro <b>*</b></span>
                            <span class="artisan-input-euro"><input v-model="form.average_rate" type="number" min="0" step="1" placeholder="120" required /><span>€</span></span>
                            <small class="artisan-field__meta">Nur eine Orientierung für die Preisstufe in deinem Profil.</small>
                            <small v-if="form.errors.average_rate" class="artisan-field__error">{{ form.errors.average_rate }}</small>
                        </label>
                    </section>

                    <section class="artisan-card" aria-labelledby="gallery-section-title">
                        <div class="artisan-card__heading">
                            <span class="artisan-card__step">03</span>
                            <div><h2 id="gallery-section-title">Zeig deine Arbeit</h2><p>Gib Kund:innen einen ersten Eindruck von deinem Stil.</p></div>
                        </div>
                        <label class="artisan-upload" :class="{ 'artisan-upload--disabled': form.gallery.length >= 6 }">
                            <input ref="fileInput" type="file" accept="image/jpeg,image/png,image/webp" multiple :disabled="form.gallery.length >= 6 || compressingPhotos" @change="addPhotos" />
                            <span class="artisan-upload__icon" aria-hidden="true">＋</span>
                            <span class="artisan-upload__title">{{ compressingPhotos ? 'Fotos werden optimiert …' : 'Fotos hinzufügen' }}</span>
                            <span class="artisan-upload__hint">JPG, PNG oder WebP · bis zu 6 Bilder · werden beim Hochladen verkleinert</span>
                        </label>
                        <div v-if="photoPreviews.length" class="artisan-photo-grid" aria-label="Ausgewählte Fotos">
                            <figure v-for="(photo, index) in photoPreviews" :key="photo.url" class="artisan-photo">
                                <img :src="photo.url" :alt="`Ausgewähltes Foto ${index + 1}`" />
                                <button type="button" :aria-label="`Foto ${index + 1} entfernen`" @click="removePhoto(index)">×</button>
                            </figure>
                        </div>
                        <p v-if="form.errors.gallery" class="artisan-field__error" role="alert">{{ form.errors.gallery }}</p>
                        <p class="artisan-create__photo-count">{{ photoPreviews.length }} von 6 Fotos ausgewählt</p>
                    </section>

                    <div v-if="form.hasErrors" class="artisan-create__error-summary" role="alert">
                        <strong>Bitte prüfe diese Angaben:</strong>
                        <ul><li v-for="([key, message]) in Object.entries(form.errors)" :key="key">{{ errorLabel(key) }}: {{ message }}</li></ul>
                    </div>
                    <div class="artisan-create__actions">
                        <span class="artisan-create__save-note">Deine Angaben werden beim Erstellen gespeichert.</span>
                        <button class="button button--primary button--lg" type="submit" :disabled="form.processing || compressingPhotos || !bakedGoods.length || (!form.pick_up_on_site && !form.offers_delivery)">
                            {{ form.processing ? 'Profil wird erstellt …' : 'Profil erstellen' }} <span aria-hidden="true">→</span>
                        </button>
                    </div>
                    <p class="artisan-create__privacy">Dein Profil wird nach dem Erstellen öffentlich angezeigt. Persönliche Adressdaten werden hier nicht abgefragt.</p>
                </form>

                <ArtisanProfilePreview
                    :name="form.name"
                    :tagline="form.short_description"
                    :about="form.about"
                    :specialties="form.baked_goods"
                    :pickup="form.pick_up_on_site"
                    :delivery="form.offers_delivery"
                    :photos="photoPreviews.map((photo) => photo.url)"
                />
            </div>
        </main>
    </div>
</template>

<script setup lang="ts">
import { computed, onBeforeUnmount, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ArtisanProfilePreview from '@/platform/components/ArtisanProfilePreview.vue';
import Layout from '@/platform/layout/AppLayout.vue';

defineOptions({ layout: Layout });

type BakedGood = { key: string; name: string; label: string; category: string };
type PhotoPreview = { file: File; url: string };
const props = defineProps<{ bakedGoods: BakedGood[] }>();
const bakedGoods = computed(() => props.bakedGoods ?? []);
const fileInput = ref<HTMLInputElement | null>(null);
const photoPreviews = ref<PhotoPreview[]>([]);
const compressingPhotos = ref(false);

const form = useForm({
    name: '', company_name: '', main_occupation: 'Cake Designer', short_description: '', about: '',
    average_rate: '120', website_url: '', instagram_url: '', offers_delivery: false, pick_up_on_site: true,
    addresses: [] as unknown[], medias: [] as unknown[], baked_goods: [] as BakedGood[], dietary_options: [] as unknown[],
    gallery: [] as File[],
});

function isSelected(key: string): boolean { return form.baked_goods.some((good) => good.key === key); }
async function addPhotos(event: Event): Promise<void> {
    const input = event.target as HTMLInputElement;
    const incoming = Array.from(input.files ?? []);
    const available = Math.max(0, 6 - form.gallery.length);
    const accepted = incoming.slice(0, available);
    input.value = '';

    if (incoming.length > available) form.setError('gallery', 'Du kannst bis zu 6 Fotos hinzufügen.');
    else form.clearErrors('gallery');
    if (!accepted.length) return;

    compressingPhotos.value = true;
    try {
        const optimized = await Promise.all(accepted.map(compressPhoto));
        form.gallery = [...form.gallery, ...optimized];
        photoPreviews.value = [...photoPreviews.value, ...optimized.map((file) => ({ file, url: URL.createObjectURL(file) }))];
    } catch {
        form.setError('gallery', 'Mindestens ein Foto konnte nicht verkleinert werden. Bitte nutze JPG, PNG oder WebP und versuche es erneut.');
    } finally {
        compressingPhotos.value = false;
    }
}

async function compressPhoto(file: File): Promise<File> {
    const targetBytes = 500 * 1024;
    if (file.size <= targetBytes) return file;

    const bitmap = await createImageBitmap(file);
    try {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        if (!context) throw new Error('Canvas unavailable');

        let result: Blob | null = null;
        for (const maxDimension of [1600, 1280, 1024, 800]) {
            const scale = Math.min(1, maxDimension / Math.max(bitmap.width, bitmap.height));
            canvas.width = Math.max(1, Math.round(bitmap.width * scale));
            canvas.height = Math.max(1, Math.round(bitmap.height * scale));
            context.drawImage(bitmap, 0, 0, canvas.width, canvas.height);
            for (const quality of [0.82, 0.72, 0.62, 0.52, 0.42]) {
                result = await new Promise((resolve) => canvas.toBlob(resolve, 'image/webp', quality));
                if (result && result.size <= targetBytes) break;
            }
            if (result && result.size <= targetBytes) break;
        }
        if (!result || result.size > targetBytes) throw new Error('Image could not be reduced enough');

        const extension = result.type === 'image/webp' ? 'webp' : 'jpg';
        const baseName = file.name.replace(/\.[^.]+$/, '');
        return new File([result], `${baseName}.${extension}`, { type: result.type, lastModified: Date.now() });
    } finally {
        bitmap.close();
    }
}

function errorLabel(key: string): string {
    if (key.startsWith('gallery')) return 'Portfolio-Fotos';
    if (key.startsWith('baked_goods')) return 'Angebot';
    if (key.startsWith('first_address')) return 'Adresse';
    const labels: Record<string, string> = { name: 'Profilname', about: 'Über dich', average_rate: 'Typischer Auftragswert', offers_delivery: 'Lieferung', pick_up_on_site: 'Abholung' };
    return labels[key] ?? key;
}
function removePhoto(index: number): void {
    URL.revokeObjectURL(photoPreviews.value[index].url);
    photoPreviews.value.splice(index, 1);
    form.gallery.splice(index, 1);
    form.clearErrors('gallery');
}
function submit(): void { form.post('/app/artisan/profile', { preserveScroll: true }); }

onBeforeUnmount(() => photoPreviews.value.forEach((photo) => URL.revokeObjectURL(photo.url)));
</script>

<style scoped lang="scss">
.artisan-create { max-width: 1440px; }
.artisan-create__main { width: min(100%, 1260px); margin: 0 auto; }
.artisan-create__page-heading { display: flex; align-items: flex-start; justify-content: space-between; gap: var(--space-6); margin-bottom: var(--space-8); }
.artisan-create__back-link { display: inline-flex; align-items: center; gap: var(--space-2); margin-bottom: var(--space-5); color: var(--color-text-secondary); font-size: var(--font-size-sm); text-decoration: none; }
.artisan-create__back-link:hover { color: var(--color-text-brand); }
.artisan-create__eyebrow { margin: 0 0 var(--space-2); color: var(--color-text-brand); font-size: var(--font-size-xs); font-weight: var(--font-weight-bold); letter-spacing: .11em; text-transform: uppercase; }
.artisan-create h1,.artisan-create h2 { font-family: var(--font-heading); }
.artisan-create__page-heading h1 { max-width: 700px; margin: 0; color: var(--color-text-primary); font-size: clamp(2rem, 4vw, 3.25rem); font-weight: var(--font-weight-medium); letter-spacing: -.035em; line-height: 1.05; }
.artisan-create__intro { max-width: 660px; margin: var(--space-4) 0 0; color: var(--color-text-secondary); font-size: var(--font-size-md); line-height: var(--line-height-relaxed); }
.artisan-create__draft { display: inline-flex; align-items: center; gap: var(--space-2); flex: 0 0 auto; padding: 9px 13px; color: var(--color-text-secondary); background: var(--color-background-elevated); border: 1px solid var(--color-border-default); border-radius: var(--radius-full); font-size: var(--font-size-xs); }
.artisan-create__draft span,.artisan-preview__live i { width: 8px; height: 8px; border-radius: 50%; background: var(--color-warning-500); }
.artisan-create__columns { display: grid; grid-template-columns: minmax(0, 1.45fr) minmax(300px, .8fr); gap: var(--space-6); align-items: start; }
.artisan-create__form { display: grid; gap: var(--space-5); min-width: 0; }
.artisan-card { display: grid; gap: var(--space-6); padding: clamp(var(--space-5), 3vw, var(--space-8)); background: var(--color-surface-card); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-2xl); box-shadow: var(--shadow-xs); }
.artisan-card__heading { display: flex; gap: var(--space-4); align-items: flex-start; }
.artisan-card__step { display: grid; width: 42px; height: 42px; flex: 0 0 42px; place-items: center; color: var(--color-text-brand); background: var(--color-background-soft); border-radius: 50%; font-size: var(--font-size-xs); font-weight: var(--font-weight-bold); }
.artisan-card__heading h2 { margin: 0; color: var(--color-text-primary); font-size: var(--font-size-xl); font-weight: var(--font-weight-semibold); }
.artisan-card__heading p { margin: var(--space-1) 0 0; color: var(--color-text-secondary); font-size: var(--font-size-sm); line-height: var(--line-height-normal); }
.artisan-fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-5); }
.artisan-field { display: grid; min-width: 0; gap: var(--space-2); color: var(--color-text-primary); font-size: var(--font-size-sm); font-weight: var(--font-weight-semibold); }
.artisan-field--wide { grid-column: 1 / -1; }
.artisan-field b { color: var(--color-text-brand); }
.artisan-field em { color: var(--color-text-muted); font-size: var(--font-size-xs); font-style: normal; font-weight: var(--font-weight-regular); }
.artisan-field input,.artisan-field textarea { width: 100%; min-height: 48px; padding: 12px 14px; color: var(--input-text); background: var(--input-background); border: 1px solid var(--input-border); border-radius: var(--radius-lg); font: inherit; font-weight: var(--font-weight-regular); transition: border-color var(--transition-fast), box-shadow var(--transition-fast); }
.artisan-field textarea { min-height: 140px; resize: vertical; line-height: var(--line-height-relaxed); }
.artisan-field input::placeholder,.artisan-field textarea::placeholder { color: var(--input-placeholder); }
.artisan-field input:focus,.artisan-field textarea:focus { border-color: var(--input-border-focus); outline: none; box-shadow: var(--shadow-focus); }
.artisan-field__meta { display: flex; justify-content: space-between; gap: var(--space-3); color: var(--color-text-muted); font-size: var(--font-size-xs); font-weight: var(--font-weight-regular); }
.artisan-field__error { color: var(--color-text-danger); font-size: var(--font-size-xs); font-weight: var(--font-weight-medium); }
.artisan-create__helper { margin: calc(-1 * var(--space-1)) 0 0; color: var(--color-text-muted); font-size: var(--font-size-xs); font-weight: var(--font-weight-regular); }
.artisan-goods { display: flex; flex-wrap: wrap; gap: var(--space-2); }
.artisan-good { position: relative; display: inline-flex; min-height: 40px; align-items: center; gap: var(--space-2); padding: 8px 12px; color: var(--color-text-secondary); background: var(--color-background-elevated); border: 1px solid var(--color-border-default); border-radius: var(--radius-full); cursor: pointer; font-size: var(--font-size-xs); font-weight: var(--font-weight-medium); transition: background var(--transition-fast), border-color var(--transition-fast), color var(--transition-fast); }
.artisan-good input { position: absolute; width: 1px; height: 1px; opacity: 0; }
.artisan-good:focus-within { outline: 2px solid var(--color-border-focus); outline-offset: 2px; }
.artisan-good--selected { color: var(--color-text-brand); background: var(--color-background-soft); border-color: var(--color-border-brand); }
.artisan-good__check { font-weight: var(--font-weight-bold); }
.artisan-create__notice { margin: 0; padding: var(--space-3); color: var(--color-text-warning); background: var(--color-warning-50); border-radius: var(--radius-md); font-size: var(--font-size-sm); }
.artisan-create__delivery { display: grid; gap: var(--space-3); padding-top: var(--space-5); border-top: 1px solid var(--color-border-subtle); }
.artisan-create__delivery>div { display: grid; gap: var(--space-1); margin-bottom: var(--space-1); }
.artisan-create__delivery strong { font-size: var(--font-size-sm); }
.artisan-create__delivery>div span { color: var(--color-text-muted); font-size: var(--font-size-xs); }
.artisan-switch { display: inline-flex; width: fit-content; align-items: center; gap: var(--space-3); color: var(--color-text-secondary); cursor: pointer; font-size: var(--font-size-sm); }
.artisan-switch input { position: absolute; width: 1px; height: 1px; opacity: 0; }
.artisan-switch__track { position: relative; width: 38px; height: 22px; background: var(--color-neutral-200); border-radius: var(--radius-full); transition: background var(--transition-fast); }
.artisan-switch__track::after { position: absolute; top: 3px; left: 3px; width: 16px; height: 16px; background: #fff; border-radius: 50%; content: ''; transition: transform var(--transition-fast); }
.artisan-switch input:checked + .artisan-switch__track { background: var(--color-brand-primary-500); }
.artisan-switch input:checked + .artisan-switch__track::after { transform: translateX(16px); }
.artisan-switch input:focus-visible + .artisan-switch__track { outline: 2px solid var(--color-border-focus); outline-offset: 3px; }
.artisan-field--rate { max-width: 320px; }
.artisan-input-euro { position: relative; display: flex; align-items: center; }
.artisan-input-euro input { padding-right: 42px; }
.artisan-input-euro>span { position: absolute; right: 15px; color: var(--color-text-muted); font-weight: var(--font-weight-regular); }
.artisan-upload { display: grid; min-height: 160px; place-content: center; justify-items: center; gap: var(--space-2); padding: var(--space-5); color: var(--color-text-secondary); background: var(--color-background-warm); border: 1px dashed var(--color-border-strong); border-radius: var(--radius-xl); cursor: pointer; text-align: center; transition: border-color var(--transition-fast), background var(--transition-fast); }
.artisan-upload:hover { background: var(--color-background-soft); border-color: var(--color-border-brand); }
.artisan-upload input { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; clip-path: inset(50%); }
.artisan-upload:focus-within { outline: 2px solid var(--color-border-focus); outline-offset: 3px; }
.artisan-upload--disabled { opacity: .55; cursor: not-allowed; }
.artisan-upload__icon { display: grid; width: 36px; height: 36px; place-items: center; color: var(--color-text-brand); background: #fff; border-radius: 50%; font-size: 24px; }
.artisan-upload__title { color: var(--color-text-primary); font-size: var(--font-size-sm); font-weight: var(--font-weight-semibold); }
.artisan-upload__hint,.artisan-create__photo-count { margin: 0; color: var(--color-text-muted); font-size: var(--font-size-xs); }
.artisan-photo-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: var(--space-3); }
.artisan-photo { position: relative; overflow: hidden; aspect-ratio: 1; margin: 0; background: var(--color-background-muted); border-radius: var(--radius-lg); }
.artisan-photo img,.artisan-preview__cover img,.artisan-preview__mini-gallery img { width: 100%; height: 100%; object-fit: cover; }
.artisan-photo button { position: absolute; top: 7px; right: 7px; display: grid; width: 30px; height: 30px; place-items: center; color: var(--color-text-primary); background: #fff; border: 0; border-radius: 50%; box-shadow: var(--shadow-sm); cursor: pointer; font-size: 20px; }
.artisan-create__photo-count { text-align: right; }
.artisan-create__actions { display: flex; align-items: center; justify-content: space-between; gap: var(--space-4); padding-top: var(--space-2); }
.artisan-create__actions .button { display: inline-flex; align-items: center; gap: var(--space-3); }
.artisan-create__save-note { color: var(--color-text-muted); font-size: var(--font-size-xs); }
.artisan-create__privacy { margin: calc(-1 * var(--space-3)) 0 0; color: var(--color-text-muted); font-size: var(--font-size-xs); line-height: var(--line-height-relaxed); }
.artisan-create__error-summary { padding: var(--space-4); color: var(--color-text-danger); background: var(--color-danger-50); border: 1px solid var(--color-border-danger); border-radius: var(--radius-lg); font-size: var(--font-size-sm); }
@media (max-width: 980px) { .artisan-create__columns { grid-template-columns: minmax(0, 1fr); } }
@media (max-width: 600px) { .artisan-create__page-heading { flex-direction: column; margin-bottom: var(--space-6); } .artisan-create__page-heading h1 { font-size: 2.25rem; } .artisan-fields { grid-template-columns: minmax(0,1fr); } .artisan-field--wide { grid-column: auto; } .artisan-card { padding: var(--space-5); border-radius: var(--radius-xl); } .artisan-card__heading { gap: var(--space-3); } .artisan-card__step { width: 36px; height: 36px; flex-basis: 36px; } .artisan-create__actions { align-items: stretch; flex-direction: column; } .artisan-create__actions .button { justify-content: center; width: 100%; } .artisan-create__save-note { text-align: center; } }
</style>
