/**
 * Convert a date to a representation that is sensitive to the locale.
 * 
 * @param date - The date to be converted.
 * @param local - The local identifier.
 * @returns 
 */
export function toLocalDate(date: Date, local: string): string {
    return new Intl.DateTimeFormat(local, {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
    }).format(date);
}