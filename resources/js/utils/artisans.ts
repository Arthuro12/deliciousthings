import { PriceLevel } from "@/enums";
import type { 
    Address, 
    ArtisanProfile,
    ArtisanPublicProfile, 
    BasicProfile,
    Media, 
    BakedGood,
    DietaryOption, 
} from "@/types/users";

/**
 * Gets a default address.
 * 
 * @returns A default default address.
 */
export function defaultAddress(): Address {
    return {
        street: "",
        house_number: "",
        postal_code: null,
        city: "",
        country: "",
        address_line_2: null,
        shows_full_address: false,
    };
}

/**
 * Gets a default artisan profile.
 * 
 * @returns A default artisan profile.
 */
export function defaultArtisan(): ArtisanProfile {
    return {
        name: "",
        company_name: "",
        main_occupation: "",
        short_description: "",
        about: "",
        medias: <Media[]>[],
        baked_goods: <BakedGood[]>[],
        dietary_options: <DietaryOption[]>[],
        addresses: <Address[]>[],
        first_address: defaultAddress(),
        average_rate: "",
        instagram_url: "",
        website_url: "",
        offers_delivery: false,
        pick_up_on_site: false,
    };
}

export function getBasicProfile(profile: ArtisanProfile | ArtisanPublicProfile): BasicProfile {
    return {
        name: profile.name,
        company_name: profile.company_name,
        main_occupation: profile.main_occupation,
        short_description: profile.short_description,
        about: profile.about,
    };
};

export function getPriceDisplay(price: string): string {
    if (! price.endsWith("€")) return `${price} €`;
    return price;
}

export function getPriceLevelSymbol(level: PriceLevel) {
    switch (level) {
        case PriceLevel.Inexpensive:
            return "€";
        case PriceLevel.Moderate:
            return "€€";
        case PriceLevel.HigherEnd:
            return "€€€";
        default:
            return "€€€";
    }
}
