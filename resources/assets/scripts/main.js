// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import templateHome from './routes/templateHome';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Template home
  templateHome,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
