export function titleCase(text) {
    return text.toLowerCase().split(/[\s,\-_]+/).map(word => word.charAt(0).toUpperCase() + word.substring(1)).join(' ');
}