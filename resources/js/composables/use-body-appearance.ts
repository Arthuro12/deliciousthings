export function useBodyAppearance(color: string) {
    function removeBodyBackgroundColor() {
        document.body.style.backgroundColor = "";
    }
    
    function setBodyBackgroundColor(): void {
        document.body.style.backgroundColor = color;
    }

    return {
        setBodyBackgroundColor,
        removeBodyBackgroundColor,
    };
}