const DATA_ATTRIBUTES = {
  group: 'tab-group',
  button: 'tab-button',
  content: 'tab-content',
  tab: 'tab',
};

export default group => {
  const groupSelector = `[data-${DATA_ATTRIBUTES.group}="${group}"]`;
  const $group = $(groupSelector);
  const $contents = $(`[data-${DATA_ATTRIBUTES.content}]`, $group);
  const $buttons = $(`[data-${DATA_ATTRIBUTES.button}]`, $group);

  function activateTabContentByButton($button) {
    console.dir($button);
    const tab = $button.data(DATA_ATTRIBUTES.tab);
    $buttons.removeClass('active');
    $button.addClass('active');
    $contents
      .removeClass('active')
      .filter(`[data-${DATA_ATTRIBUTES.tab}="${tab}"]`)
      .addClass('active');
  }

  $(groupSelector).on('click', `[data-${DATA_ATTRIBUTES.button}]`, function(e) {
    e.preventDefault();
    const $this = $(this);
    activateTabContentByButton($this);
  });
  activateTabContentByButton($($buttons[0]));
};
