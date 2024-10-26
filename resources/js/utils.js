export function formatMoney(money, showSymbol = true) {
    if (!money) return '';

    if (!showSymbol) return money.toLocaleString('pt-br', {minimumFractionDigits: 2});

    return money.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
}