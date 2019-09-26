import inView from 'in-view';
import addYmapScript from './addYmapScript';

export default (selector, initFuncName = '') => {
  inView(selector).once('enter', () => addYmapScript(initFuncName));
};
