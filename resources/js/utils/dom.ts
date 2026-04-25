export function contentOverflows(root: HTMLElement): boolean {
    const isOverflowed = root.clientHeight < root.scrollHeight;
    return isOverflowed;
}