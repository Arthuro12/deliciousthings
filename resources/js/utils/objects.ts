/**
 * Gets the property value.
 * 
 * @param object 
 * @param key 
 * @param defaultValue 
 * @returns 
 */
export function getProperty<T extends object, K extends keyof T>(object: T, key: K, defaultValue?: T[K]): T[K] | undefined {
    if (typeof object == "object") {
        return object[key] ?? defaultValue;
    }

    return defaultValue;
}