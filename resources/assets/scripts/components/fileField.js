export default (selector = '.primary-file-field') => {
  $(selector + ' input[type="file"]').each(function() {
    const $input = $(this);
    const $labelText = $input
      .siblings('label')
      .find('.primary-file-field__text');
    const labelHtml = $labelText.html();

    $input.on('change', function(e) {
      let fileName = '';
      let fileSizeSum = 0;
      Array.prototype.forEach.call(this.files, file => {
        fileSizeSum += file.size;
      });

      if (fileSizeSum > 100 * 1024 * 1024) {
        $input.val('');
        window.__diamodalAlertModal.title = 'Ошибка';
        window.__diamodalAlertModal.content =
          'Общий размер файлов не должен превышать 100мб!';
        window.__diamodalAlertModal.open();
      }
      if (this.files && this.files.length > 1)
        fileName = (this.getAttribute('data-multiple-caption') || '').replace(
          '{count}',
          this.files.length
        );
      else if (this.files.length) fileName = this.files[0].name;

      $labelText.html(fileName || labelHtml);
    });
  });
};
