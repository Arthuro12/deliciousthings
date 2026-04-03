<template>
    <footer class="app-footer">
        <div class="footer__content">
            <ul>
                <li class="footer__item">
                    <header class="footer__header">Kontakt</header>
                    <ul class="footer__contact">
                        <li>support@deliciousthings.de</li>
                    </ul> 
                    <ul class="footer__social-links">
                        <li>
                            <a 
                                class="footer__social-link"
                                href="https://www.instagram.com/deliciousthings.de?igsh=enJxa3NxcjU3amNv" 
                                target="_blank"
                            >
                                <Instagram />
                            </a>
                        </li>
                    </ul> 
                </li>
            </ul>
            <div class="footer__item copyright">&copy; 2026 deliciousthings</div>
        </div>
    </footer>
</template>

<script setup lang="ts">
import Instagram from "@/components/icons/Instagram.vue";
</script>
