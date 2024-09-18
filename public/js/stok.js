document.addEventListener('DOMContentLoaded', () => {
    const stockElement = document.getElementsByClassName('stock-number');
    const stockValue = parseInt(stockElement.textContent, 10);
   console.log(stockValue);
   stockElement.classList.add('stock-green');
    if (stockValue >= 100) {
        stockElement.classList.add('stock-green');
    } else if (stockValue >= 50) {
        stockElement.classList.add('stock-yellow');
    } else if (stockValue >= 25) {
        stockElement.classList.add('stock-orange');
    } else {
        stockElement.classList.add('stock-red');
    }
});
