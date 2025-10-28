<template>
    <div>
        <h1>Profil erstellen</h1>

        <div>
            <label for="name">Name *</label>
            <input type="text" id="name" />
        </div>
        <div>
            <label>Firmenname (optional)</label>
            <input type="text" />
        </div>
        <div>
            <label>Telefonnummer (optional)</label>
            <input type="text" id="phone" />
        </div>
        <div>
            <label>E-Mail-Adresse</label>
            <input type="text" id="email" />
        </div>
        <div>
            <label>Biographie</label>
            <textarea></textarea>
        </div>
        <div>
            <select id="specialities">
                <option value="">Wählen Sie Ihre Spezialitäten aus</option>
                <option>Torten</option>
                <option>Kuchen</option>
                <option>Gebäck</option>
                <option>Praline</option>
                <option>Brot</option>
                <option>Brötchen</option>
                <option>Eis</option>
                <option>Schokoladen</option>
            </select>
        </div>
        <div>
            <h4>Adressdaten</h4>
            <div>
                <label>Straße</label>
                <input type="text" id="street" />
            </div>
            <div>
                <label>Hausnummer</label>
                <input type="text" id="house-number" />
            </div>
            <div>
                <label>PLZ</label>
                <input type="text" id="postal-code" />
            </div>
            <div>
                <label>Ort</label>
                <input type="text" id="city" />
            </div>
            <div>
                <label>Land</label>
                <!-- Défaut à Berlin et pas éditable -->
                <input type="text" id="country" />
            </div>
        </div>
        <div>
            <label>Fotos für Ihre Bildergalerie</label>
            <input type="file" />
            <div>Bildervorschau</div>
        </div>
        <div>
            <h4>Netzwerk</h4>
            <div>
                <span>Instagram-Profil: </span>
                <input type="text" />
            </div>
            <div>
                <span>Webseite: </span>
                <input type="text" />
            </div>
        </div>
        <div>
            <input type="checkbox" /> Ich kann liefern
            <div>
                <label>Preis</label>
                <input type="text" />
            </div>
        </div>

        <button type="button">Mein Profil erstellen</button>
        <p>Ihr Profil ist sofort nach der Erstellung sichtbar.</p>
    </div>
</template>