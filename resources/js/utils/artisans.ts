import type { Address, ArtisanProfile, Media, Speciality } from "@/types/users";

/**
 * Gets a default artisan profile.
 * 
 * @returns A default artisan profile.
 */
export function defaultProfile(): ArtisanProfile {
    return {
        username: "",
        company_name: "",
        e164phone: "",
        email: "",
        biography: "",
        medias: <Media[]>[],
        specialities: <Speciality[]>[],
        addresses: <Address[]>[],
        first_address: defaultAddress(),
        average_rate: "",
        instagram_url: "",
        website_url: "",
        offers_delivery: false
    };
}

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
