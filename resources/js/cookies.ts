export function getCookie(name: string): string {
    const pattern = new RegExp(`(^| )${encodeURIComponent(name)}=([^;]*)`);
    const match = document.cookie.match(pattern);

    return match ? match[2] : "";
};