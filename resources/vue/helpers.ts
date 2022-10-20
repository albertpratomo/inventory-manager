const formatDate = (value: string, hideTime = false) => {
    const date = new Date(value);

    return hideTime
        ? date.toLocaleDateString('en-NZ')
        : date.toLocaleString('en-NZ');
};

const formatNumber = (value: number) => new Intl.NumberFormat('en-NZ').format(value);

const formatPrice = (cents: number) => new Intl.NumberFormat('en-NZ', {
    style: 'currency', currency: 'NZD',
}).format(cents / 100);

export {
    formatDate,
    formatNumber,
    formatPrice,
};
