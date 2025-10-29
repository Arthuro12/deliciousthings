import type { ArtisanProfile } from "@/types";

export function defaultProfile(): ArtisanProfile {
    return {
        name: "",
        companyName: "",
        phone: "",
        email: "",
        biography: "",
        specialities: [],
        address: null,
        averageRate: "",
        instagramUrl: "",
        websiteUrl: "",
        offersDelivery: false
    };
}