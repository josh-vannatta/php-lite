// Bundles
require('popper.js');
require('bootstrap');
window.$ = require('jquery');
require('./helpers/functions');

// Modules
import { ENV } from './env';
import { routes } from './routes';
import { dynamicForm, formatMasks, http, JSX } from './helpers/module';
import { googleMaps, instagram } from './apis/module';

// Elements
import { coreElements } from './elements/coreElements';
import { passiveElements } from './elements/passiveElements';

// Controllers
import { homeController, contactController } from './home/module';

// Lifecycle
$(document).ready(function(){

  // Enviroment
  ENV.PATH = window.location.pathname;
  ENV.CSRF = $('meta[name="csrf-token"]').attr('content');
  let search = window.location.search.replace('?', '').split('&');
  search.forEach(term => {
    let binding = term.split('=');
    ENV.GET[binding[0]] = binding;[1];
  })

  // Elements
  coreElements.bind();
  passiveElements.bind();

  // Routes
  routes.some(route => {
    if (route.path === ENV.PATH) {
      let action = route.controller.split('@');
      let method = action[1];
      let controller = window[action[0]];

      controller[method]();
      return true;
    }
  });

 });
