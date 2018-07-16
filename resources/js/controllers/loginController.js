import { dynamicForm } from '../helpers/module';
import { http } from '../helpers/module';

const loginController = (function() {
  'use strict';

  let _this = {
    create: create,
    index: index
  }

  function create() {
    console.log('Register controller working!');
    dynamicForm.bind($('#register-form'), {
      data: {
        first: {
          error: 'Enter your first name',
          rules: { required: true }
        },
        last: {
          error: 'Enter your last name',
          rules: { required: true }
        },
        email: {
          error: {
            required: 'A valid email is required',
            email: 'Your email is not valid'
          },
          rules: { required: true, email: true }
        },
        password: {
          error: {
            required: 'You must enter a password',
            min: 'Use 8 characters or more for your password'
          },
          rules: { required: true, min: 8 }
        },
        passwordconfirm: {
          error: 'Passwords do not match',
          rules: { matches: {el: '#register-pass'} }
        }
      },
      onSubmit: function(formData) {
        http.post('/account/store', formData);
      }
    });
  }

  function index() {
    dynamicForm.bind($('#login-form'), {
      data: {
        email: {
          error: {
            required: 'A valid email is required',
            email: 'Please enter a valid email'
          },
          rules: { required: true, email: true }
        },
        password: {
          error: {
            required: 'You must enter a password'
          },
          rules: { required: true }
        }
      },
      onSubmit: function(formData) {
        http.post('/login', formData);
      }
    });
    console.log('Login controller working!');
  }

  return _this;

}());

window['loginController'] = loginController;
export { loginController };
