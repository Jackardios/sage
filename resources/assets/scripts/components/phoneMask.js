const vanillaTextMask = require('vanilla-text-mask/dist/vanillaTextMask');

export default (selector = '.phone-mask') => {
  var phoneMask = [
    /[1-9]/,
    ' ',
    '(',
    /[1-9]/,
    /\d/,
    /\d/,
    ')',
    ' ',
    /\d/,
    /\d/,
    /\d/,
    '-',
    /\d/,
    /\d/,
    '-',
    /\d/,
    /\d/,
  ];

  // Assuming you have an input element in your HTML with the class .myInput
  $(selector)
    .each(function() {
      vanillaTextMask.maskInput({
        inputElement: this,
        mask: phoneMask,
      });
    })
    .attr('placeholder', '8 (999) 999-99-99');
};
