require('jquery-mask-plugin');

export default (selector = '.phone-mask') => {
  // Assuming you have an input element in your HTML with the class .myInput
  $(selector).mask('0 (000) 000-0000', { placeholder: '8 (999) 999-9999' });
};