// export function sortBlocks() {
$(document).ready(function () {
    // Найти все карточки с data-атрибутом и отсортировать их по ширине
    let cardsWithDataAttr = $('.section_2 .card[data-attribute]');
    cardsWithDataAttr.sort(function (a, b) {
        let widthA = parseInt($(a).css('width'));
        let widthB = parseInt($(b).css('width'));
        return widthA - widthB;
    });

    // Найти карточку без data-атрибута внутри секции section_2
    let cardWithoutAttr = $('.section_2 .card:not([data-attribute])');

    // Переместил отсортированные карточки на место
    cardsWithDataAttr.detach().appendTo('.section_2');

    // Переместил карточку без data-атрибута в конец секции section_2
    cardWithoutAttr.detach().appendTo('.section_2');

    // Установил высоту всех карточек во второй секции равной высоте самой высокой карточки
    let maxHeight = 0;
    $('.section_2 .card').each(function () {
        let cardHeight = $(this).outerHeight();
        if (cardHeight > maxHeight) {
            maxHeight = cardHeight + 30;
        }
    });
    $('.section_2 .card').css('height', `${maxHeight}px`);
});
// }
