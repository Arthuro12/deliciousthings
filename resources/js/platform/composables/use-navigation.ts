import { computed } from "vue";

import { Link } from "@/types/ui";

export function useNavigation(links: Link[]) {
    const mainNavigationLinks = computed(() => {
        return links.filter(link => !["Profil"].includes(link.title));
    });

    return {
        mainNavigationLinks,
    }
}