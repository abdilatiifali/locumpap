export function format(price) {
    return Intl.NumberFormat("en-In", { maximumSignificantDigits: 3 }).format(
        price
    );
}
