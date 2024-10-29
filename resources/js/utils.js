export function formatMoney(money, showSymbol = true) {
    if (!money) return '';

    if (!showSymbol) return parseFloat(money).toLocaleString('pt-br', {minimumFractionDigits: 2});

    return parseFloat(money).toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
}