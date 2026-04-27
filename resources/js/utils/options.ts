
export type Categories = Record<string, string>;

export type GroupType = Record<string, GroupOption[]>;

export type GroupOption = {
    category: string;
    [key: string]: any;
};

export function groupByCategories<I extends GroupOption>(items: I[]): GroupType {
    const result = Object.groupBy(items, item => item.category);
    return result as GroupType;
}

/**
 * Gets the display name of the category.
 * 
 * @param key 
 * @returns 
 */
export function getCategoryDisplayName(categories: Categories, key: string): string {
    if (isCategoryKey(categories, key)) {
        return categories[key];
    }

    return "";
}

/**
 * 
 * @param groups 
 * @returns 
 */
export function mapGroupsToDisplayName<G extends GroupType>(groups: G, categories: Categories): G {
    const result: GroupType = { };
    for (const key in groups) {
        result[getCategoryDisplayName(categories, key)] = groups[key];
    }

    return result as G;
}

/**
 * 
 * @param key 
 * @returns 
 */
function isCategoryKey(categories: Categories, key: string): boolean  {
    return Object.keys(categories).includes(key);
}