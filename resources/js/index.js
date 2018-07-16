require('./bootstrap');

// Modules
import { ENV } from './env';
import { routes } from './routes';

// Elements
import { coreElements } from './elements/coreElements';
import { passiveElements } from './elements/passiveElements';

// Controllers
import { homeController } from './controllers/homeController';
import { loginController } from './controllers/loginController';

// Lifecycle
$(document).ready(function(){

  // Enviroment
  ENV.PATH = window.location.pathname;
  ENV.CSRF = $('meta[name="csrf-token"]').attr('content');
  let search = window.location.search.replace('?', '').split('&');
  search.forEach(term => {
    let binding = term.split('=');
    ENV.GET[binding[0]] = binding[1];
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
