import type { Link } from "./types/ui";

export const BUTTON_CLASSES = Object.freeze({
    LAYOUTS: {
        text: "button--text",
        icon: "button--icon",
        "with-icon": "button--with-icon",
    },
    VARIANTS: {
        primary: "button--primary",
        secondary: "button--secondary",
        tertiary: "button--tertiary",
    },
    SIZES: {
        small: "button--small",
        medium: "button--medium",
        large: "button--large",
    },
});

export const LINK_CLASSES = Object.freeze({
    VARIANTS: {
        primary: "link--primary",
        secondary: "link--secondary",
        tertiary: "link--tertiary",
    },
    SIZES: {
        medium: "link--medium",
    }
});

export const BREAKPOINTS = {
    SMALL_DEVICE: 767,
    MEDIUM_DEVICE: 991,
};

export const NAV_MENUS = {
    PUBLIC: [
        {
            href: '/artisans',
            title: 'Konditor:innen',
        },
        {
            href: '/creations',
            title: 'Kreationen',
        },
    ] as Link[],
    // USER: [] as Link[],
};

export const FORM_ERRORS = Object.freeze({
    REQUIRED: `Bitte füllen sie dieses Feld aus.`
});

export const BAKED_GOODS = {
    CATEGORY: {
        "breads_and_rolls": "Brot und Brötchen",
        "pastries": "Konditorei",
        "viennoiserie": "Feingebäck",
        "chocolate": "Schokolade",
        "fried_sweet_pastries": "Frittiertes / Süßes Gebäck",
    },
};

export const SERVICES_CATEGORIES = {
    pastry_shop: "Konditorei",
    bakery: "Bäckerei",
    catering: "Catering",
};