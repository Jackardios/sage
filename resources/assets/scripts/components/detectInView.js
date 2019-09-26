import inView from 'in-view';

export default sectionSelector => {
  if (sectionSelector) {
    inView(sectionSelector).on('enter', el => {
      $(el).addClass('in-view');
    });
  }
};
