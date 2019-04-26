import { DiaModal } from 'diamodal';

export default () => {
  const window.__diamodalAlertModal = new DiaModal({
    zIndex: 10000,
  });
  return window.__diamodalAlertModal;
};
