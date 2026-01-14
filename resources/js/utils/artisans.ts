import type { 
    Address, 
    ArtisanPublicProfile, 
    BasicProfile,
    Media, 
    Speciality,
    DietType, 
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
        address_line_2: null
    };
}

/**
 * Gets a default artisan profile.
 * 
 * @returns A default artisan profile.
 */
export function defaultArtisan(): ArtisanPublicProfile {
    return {
        name: "",
        company_name: "",
        main_occupation: "",
        e164phone: "",
        email: "",
        short_description: "",
        about: "",
        medias: <Media[]>[],
        specialities: <Speciality[]>[],
        diet_types: <DietType[]>[],
        addresses: <Address[]>[],
        first_address: defaultAddress(),
        average_rate: "",
        instagram_url: "",
        website_url: "",
        offers_delivery: false,
        pick_up_on_site: false,
    };
}

export function getBasicProfile(profile: ArtisanPublicProfile): BasicProfile {
    return {
        name: profile.name,
        company_name: profile.company_name,
        main_occupation: profile.main_occupation,
        short_description: profile.short_description,
        about: profile.about,
    };
};
