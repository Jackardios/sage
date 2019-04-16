import { DiaModal } from 'diamodal';

export default () => {
  return (window.__diamodalAlertModal = new DiaModal({
    zIndex: 10000,
  }));
};
