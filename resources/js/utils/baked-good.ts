import type { BakedGood, GroupedBakedGoods } from "@/types/users";

const BAKED_GOODS = {
    CATEGORY: {
        "breads_and_rolls": "Brot und Brötchen",
        "pastries": "Konditorei",
        "viennoiserie": "Feingebäck",
        "chocolate": "Schokolade",
        "fried_sweet_pastries": "Frittiertes / Süßes Gebäck",
    },
};

/**
 * Groups baked goods by category.
 * 
 * @param goods 
 * @returns 
 */
export function bakedGoodsByCategory(goods: BakedGood[]): GroupedBakedGoods {
    const result = Object.groupBy(goods, good => good.category);
    return result as GroupedBakedGoods;
}

/**
 * Gets the display name of the category.
 * 
 * @param category 
 * @returns 
 */
export function getCategoryDisplayName(category: string): string {
    if (isCategoryKey(category)) {
        return BAKED_GOODS.CATEGORY[category];
    }

    return "";
}

/**
 * Transforms baked goods category keys into display text.
 * 
 * @param groups 
 * @returns 
 */
export function mapGroupsToDisplayName(groups: GroupedBakedGoods): GroupedBakedGoods {
    const result: GroupedBakedGoods = {};
    for (const key in groups) {
        result[getCategoryDisplayName(key)] = groups[key];
    }

    return result;
}

/**
 * Checks whether a key is a property key of baked good categories.
 * 
 * @param key 
 * @returns 
 */
function isCategoryKey(key: string): key is keyof typeof BAKED_GOODS.CATEGORY  {
    return Object.keys(BAKED_GOODS.CATEGORY).includes(key);
}