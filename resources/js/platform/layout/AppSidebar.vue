<template>
    <aside class="app-sidebar" aria-label="Arbeitsbereich">
        <div class="app-sidebar__heading">
            <span class="app-sidebar__overline">Dein Bereich</span>
            <span class="app-sidebar__title">Workspace</span>
        </div>
        <nav class="app-sidebar__nav" aria-label="Hauptnavigation">
            <Link v-for="link in mainNavigationLinks" :key="link.href" :href="link.href"
                class="app-sidebar__link" :class="{ 'app-sidebar__link--active': isActive(link.href) }"
                :aria-current="isActive(link.href) ? 'page' : undefined">
                <component v-if="link.iconName && NAVIGATION_LINK_ICONS[link.iconName]"
                    :is="NAVIGATION_LINK_ICONS[link.iconName]" :size="19" :stroke-width="1.8" aria-hidden="true" />
                <span>{{ link.title }}</span>
            </Link>
        </nav>
        <section v-if="artisanNavigationLinks.length" class="app-sidebar__section" aria-labelledby="artisan-navigation-title">
            <h2 id="artisan-navigation-title" class="app-sidebar__section-title">Backprofi</h2>
            <nav class="app-sidebar__nav" aria-label="Backprofi">
                <Link v-for="link in artisanNavigationLinks" :key="link.href" :href="link.href"
                    class="app-sidebar__link" :class="{ 'app-sidebar__link--active': isActive(link.href) }"
                    :aria-current="isActive(link.href) ? 'page' : undefined">
                    <component v-if="link.iconName && NAVIGATION_LINK_ICONS[link.iconName]"
                        :is="NAVIGATION_LINK_ICONS[link.iconName]" :size="19" :stroke-width="1.8" aria-hidden="true" />
                    <span>{{ link.title }}</span>
                </Link>
            </nav>
        </section>
        <div class="app-sidebar__note">
            <span class="app-sidebar__note-mark" aria-hidden="true">✳</span>
            <p>Ein guter erster Eindruck beginnt mit deinem Profil.</p>
        </div>
    </aside>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { NAVIGATION_LINK_ICONS } from '@/constants';
import type { AppLinks } from '@/types/ui';

const props = defineProps<{ links: AppLinks }>();
const page = usePage();
const isArtisanLink = (link: { href: string }) => link.href.startsWith('/app/artisan/') || link.href.startsWith('/artisans/');
const mainNavigationLinks = computed(() => props.links.user.filter((link) => link.title !== 'Profil' && !isArtisanLink(link)));
const artisanNavigationLinks = computed(() => props.links.user.filter(isArtisanLink));

function isActive(href: string): boolean {
    const path = new URL(href, 'http://deliciousthings.local').pathname;
    return page.url === path || (path !== '/app' && page.url.startsWith(`${path}/`));
}
</script>

<style scoped lang="scss">
.app-sidebar { position: fixed; z-index: 2; inset: var(--app-header-height) auto 0 0; display: flex; width: var(--app-sidebar-width); flex-direction: column; padding: var(--space-8) var(--space-5) var(--space-6); background: var(--color-background-elevated); border-right: 1px solid var(--color-border-subtle); }
.app-sidebar__heading { display: grid; gap: var(--space-1); padding: 0 var(--space-3) var(--space-6); }
.app-sidebar__overline { color: var(--color-text-muted); font-size: var(--font-size-xs); letter-spacing: .08em; text-transform: uppercase; }
.app-sidebar__title { color: var(--color-text-primary); font-family: var(--font-heading); font-size: var(--font-size-xl); }
.app-sidebar__nav { display: grid; gap: var(--space-1); }
.app-sidebar__section { display:grid; gap:var(--space-2); margin-top:var(--space-7); padding-top:var(--space-5); border-top:1px solid var(--color-border-subtle); }
.app-sidebar__section-title { margin:0; padding:0 var(--space-3); color:var(--color-text-muted); font-size:var(--font-size-xs); font-weight:var(--font-weight-semibold); letter-spacing:.08em; text-transform:uppercase; }
.app-sidebar__link { display: flex; min-height: 46px; align-items: center; gap: var(--space-3); padding: 0 var(--space-3); color: var(--color-text-secondary); border-radius: var(--radius-lg); font-size: var(--font-size-sm); font-weight: var(--font-weight-medium); text-decoration: none; transition: color var(--transition-fast), background var(--transition-fast); }
.app-sidebar__link:hover { color: var(--color-text-brand); background: var(--color-background-soft); }
.app-sidebar__link--active { color: var(--color-text-brand); background: var(--color-surface-nav-active); font-weight: var(--font-weight-semibold); }
.app-sidebar__note { display: flex; gap: var(--space-3); align-items: flex-start; margin-top: auto; padding: var(--space-4); background: var(--color-background-warm); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-xl); }
.app-sidebar__note-mark { color: var(--color-text-brand); font-size: var(--font-size-xl); line-height: 1; }
.app-sidebar__note p { margin: 0; color: var(--color-text-secondary); font-size: var(--font-size-xs); line-height: var(--line-height-relaxed); }
@media (max-width: 767px) { .app-sidebar { display: none; } }
</style>
