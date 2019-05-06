import { DiaModal } from 'diamodal';

export default () => {
  const alertModal = new DiaModal({
    zIndex: 10000,
  });
  $(alertModal.contentContainer).on('click', '[data-diamodal-close]', e => {
    alertModal.close();
  });
  return (window.__diamodalAlertModal = alertModal);
};
