import { getProperty } from "@/utils/objects";
import type { SelectItem } from "@/types/ui";

/**
 * Gets the item prop value.
 * 
 * @param item 
 * @param prop 
 * @returns 
 */
export function getItemProp(item: SelectItem, prop?: string): string {
    if (prop && item && typeof item == "object") {
        return getProperty(item, prop, "");
    }

    return "";
}