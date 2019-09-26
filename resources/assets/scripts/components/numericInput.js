export default (
  containerSelector = '[data-numeric-input]',
  buttonMinusSelector = '[data-numeric-input-minus]',
  buttonPlusSelector = '[data-numeric-input-plus]',
  inputSelector = '[data-numeric-input-input]'
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
