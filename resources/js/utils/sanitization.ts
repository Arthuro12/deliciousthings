/**
 * Removes tags from HTML text.
 */
export function stripTags(text: string): string {
    return text.replace(/<br\s*\/?>/gi, " ") // Replaces tags that represent a line break with a space
            .replace(/<\/(p|li|div|h[1-6])>/gi, " ")
            .replace(/<[^>]+>/g, " ") // Removes tags
            .replace(/\s+/g, " ") // Removes double empty spaces
            .trim();
} 