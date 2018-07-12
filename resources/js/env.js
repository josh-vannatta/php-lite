const ENV = (function() {
  'use strict';

  return {
    BASE: 'http://127.0.0.1:8000/',
    PATH: null,
    GET: {},
    CSRF: null,
    INSTAGRAM: {
      client_id: '9debc23f0b5f43c189546dad7c3021f7',
      token: '8042519265.9debc23.de843fd90ae947f0929753c884ad1f1e'
    },
    GOOGLE: {
      client_id: 'AIzaSyAMCA4bdCOFRMScSDagfFwR5PplYok86ko'
    }
  }
}());

export { ENV };
