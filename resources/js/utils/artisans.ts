import type { Address, ArtisanProfile } from "@/types/users";

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
        medias: [],
        specialities: [],
        address: defaultAddress(),
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
        houseNumber: "",
        postalCode: null,
        city: "",
        country: "Deutschland",
        addressLine2: null
    };
}
