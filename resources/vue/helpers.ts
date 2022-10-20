const formatDate = (value: string) => (new Date(value)).toLocaleString('en-NZ');

const formatNumber = (value: number) => new Intl.NumberFormat('en-NZ').format(value);

const formatPrice = (cents: number) => new Intl.NumberFormat('en-NZ', {
    style: 'currency', currency: 'NZD',
}).format(cents / 100);

export {
    formatDate,
    formatNumber,
    formatPrice,
};
