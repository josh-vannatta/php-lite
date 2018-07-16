let approve = require('approvejs');

const dynamicForm = (function() {
  'use strict';
  let _this = {
    bind: bind,
    addValidation: addValidation,
    errorElement: 'span',
    classes: {
      error: 'has-error',
      valid: 'valid',
      invalid: 'invalid',
      pristine: 'pristine',
      dirty: 'dirty',
      disabled: 'disabled'
    }
  }

  function bind(el, config) {
    let form = config.data;
    let callback = config.onSubmit;
    let controls = {};
    for (let input in form) {
      controls[input] = form[input];
      controls[input]['state'] = [this.classes.pristine];
      controls[input]['element'] = $(el.find(`[name=${input}]`)[0]);
      controls[input]['value'] = controls[input].element.val();
      controls[input].element.keyup(function() {
        if (!keyTimers[input]) keyTimeout(controls[input], 100)
          .then( validateInput(controls[input])
          .then( validateForm(form)) );
      });
      controls[input].element.blur(function() {
        let pristine = controls[input].state.indexOf(dynamicForm.classes.pristine);
        if (pristine >= 0) controls[input].state[pristine] = dynamicForm.classes.dirty;
        validateInput(controls[input]).then(validateForm(form));
      });
      delete(form[input]);
    }
    form['controls'] = controls;
    form['state'] = [this.classes.pristine];
    form['element'] = el;
    let button = $(el.find(`[type='submit']`)[0]);
    if (button) {
      form['submit'] = button;
      form.submit.click(e=>callback(constructForm(e, form)));
    }
    form.element.submit(e=>callback(constructForm(e, form)));
    form.element.addClass(dynamicForm.classes.pristine);
  }

    let keyTimers = {};
    function keyTimeout(input, amt) {
      return new Promise(function(resolve, reject) {
        keyTimers[input] = true;
        setTimeout(()=>{
          keyTimers[input] = false;
          resolve()
        }, amt);
      });
    }

  function constructForm(event, form) {
    event.preventDefault();
    for (let i in form.controls) {
        let input = form.controls[i];
        let p = input.state.indexOf(dynamicForm.classes.pristine);
        if (p >= 0) input.state[p] = dynamicForm.classes.dirty;
        validateInput(input);
    }
    let pristine = form.state.indexOf(dynamicForm.classes.pristine);
    if (pristine >= 0) form.state[pristine] = dynamicForm.classes.dirty;
    if (!validateForm(form)) return false;
    let formData = {};
    let inputs = form.element.find('input');
    for (let j = 0; j < inputs.length; j++) {
      formData[inputs[j].name] = inputs[j].value;
    }
    return formData;
  }

  function setState(input, test) {
    let __this = dynamicForm;
    if (!test) {
      let valid = input.state.indexOf(__this.classes.valid);
      if (valid >= 0) input.state[valid] = __this.classes.invalid;
      else if ( input.state.includes(__this.classes.invalid) ) return;
      else input.state.push(__this.classes.invalid);
      return;
    }
    let invalid = input.state.indexOf(__this.classes.invalid);
    if (invalid >= 0)input.state[invalid] = __this.classes.valid;
    else if ( input.state.includes(__this.classes.valid) ) return;
    else input.state.push(__this.classes.valid);
  }

  function setClass(element, input) {
    let __this = dynamicForm;
    element.removeClass(`
      ${__this.classes.pristine}
      ${__this.classes.dirty}
      ${__this.classes.valid}
      ${__this.classes.invalid}
    `);
    element.addClass(input.state.join(' '))
  }

  function addValidation(rules) {
    for (var rule in rules) {
      if (rules.hasOwnProperty(rule)) {
        if (!rules[rule].hasOwnProperty('expects')) rules[rule]['expects']= false;
        if (!rules[rule].hasOwnProperty('message')) rules[rule]['message'] = '';
        approve.addTest(rules[rule], rule);
      }
    }
  }

  function validateAsync(input, result) {
    return new Promise(function(resolve, reject) {
      if (!input.async) return resolve(true);
      let calls = 0;
      let success = 0;
      input.async.forEach(request=>{
        $.ajax(request.url)
          .done(response=>{
            calls++;
            if (request.callback(response)) success++;
            if (calls == input.async.length){
              if (success == calls) return resolve(true);
              return resolve(false);
            }
          })
          .fail(e=>resolve(false));
      })
    });
  }

  function validateInput(input) {
    input.value = input.element.attr('type') == 'checkbox' ? input.element.prop('checked') : input.element.val();
    let result = approve.value(input.value, input.rules);
    let parent = input.element.closest('.form-group');
    let errors = parent.find('.error-messages');
    setState(input, result.approved);
    setClass(parent, input);
    return validateAsync(input, result).then(response=>{
      let __this = dynamicForm;
      if ((!result.approved || !response) && parent.hasClass('dirty')) {
        parent.addClass(__this.classes.error);
        errors.html(renderErrors(input.error, result));
        return;
      }
      errors.html('');
      parent.removeClass(__this.classes.error);
    });
  }

  function validateForm(form, init = false) {
    let valid = true;
    let __this = dynamicForm;
    for (var input in form.controls) {
      if (form.controls[input].state.includes(__this.classes.invalid)) valid = false;
    }

    let pristine = form.state.indexOf(__this.classes.pristine);
    if (valid) {
      form.submit.removeClass(__this.classes.disabled);
      form.submit.attr('disabled', false);
    } else if (!valid && pristine == -1) {
      form.submit.addClass(__this.classes.disabled);
      form.submit.attr('disabled', true);
    }
    setState(form, valid);
    setClass(form.element, form);
    return valid;
  }

  function renderErrors(errors, result) {
    let errorHTML = message => `
      <${dynamicForm.errorElement} class="text-danger">
        ${message}
      </${dynamicForm.errorElement}>
    `
    if (typeof errors == 'string') return errorHTML(errors);
    for (let error in errors) {
      if (!result[error].approved) {
        return errorHTML(errors[error]);
        break;
      }
    }
  }

  return _this;

}());

export { dynamicForm };

/* USAGE:
let createForm = {
  email: {
    error: {
      required: 'Email is required',
      email: 'Please provide a valid email',
      newRule: 'Do a thing'},
    rules: { required: true, email: true, newRule: {foo: 4, bar: 5} },
    async: [
      { url: '/exists', callback: r => { return r == true; } },
      { url: '/valid', callback: r => { return r != false; }}
    ]
  },
  password: {
    error: 'The password you provided is invalid',
    rules: { required: true, newRule: true }
  },
  check: {
    error: 'Please check',
    rules: { required: true }
  },
}

  dynamicForm.addValidation({
    newRule: {
      expects: ['foo', 'bar'],
      message: '{foo' needs to be {bar}',
      validate: function(value, pars) {
        return value == pars.foo + pars.bar;
      }
    }
  })
  dynamicForm.bind($('#form'), {
    data: createForm,
    onSubmit: (formData) => {
      $.ajax({ url: '/send', data: formData,
         type: 'POST', headers: {'X-CSRF-TOKEN': ENV.CSRF} })
      .done(data => console.log(data))
      .fail(data => console.log(data))
    },
  });
}

*/
