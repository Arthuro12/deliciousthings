/**
 * Gets name initials.
 * 
 * @param text 
 */
export function getNameIntials(text: string): string {
    const fragments = text.split(" ").slice(0, 2);
    const output = fragments.map(fragment => fragment.slice(0, 1).toUpperCase()).join("");
    return output;
}