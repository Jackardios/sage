export default (
  containerSelector = '[data-numeric-field]',
  buttonMinusSelector = '[data-numeric-field-minus]',
  buttonPlusSelector = '[data-numeric-field-plus]',
  inputSelector = '[data-numeric-field-input]'
) => {
  $(buttonMinusSelector).on('click', function() {
    const $input = $(this)
      .closest(containerSelector)
      .find(inputSelector);
    let min = parseInt($input.attr('min') || 0);
    let step = parseInt($input.attr('step') || 1);
    let value = parseInt($input.val() || min);

    value = value - step;

    $input.val(value >= min ? value : min);
    $input.change();
  });
  $(buttonPlusSelector).on('click', function() {
    const $input = $(this)
      .closest(containerSelector)
      .find(inputSelector);
    let min = parseInt($input.attr('min') || 0);
    let step = parseInt($input.attr('step') || 1);
    let value = parseInt($input.val() || min);

    $input.val(value + step);
    $input.change();
  });
};
