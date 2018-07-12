const dynamicForm = (function() {
  'use strict';
  let _this = {
    bind: bind,
    addValidation: addValidation
  }

  function bind(el, config) {
    let form = config.data;
    let callback = config.onSubmit;
    for (let input in form) {
      form[input]['state'] = ['pristine'];
      form[input]['element'] = $(el.find(`[name=${input}]`)[0]);
      form[input]['value'] = form[input].element.val();
      form[input].element.keyup(function() {
        if (!keyTimers[input]) keyTimeout(input, 100)
          .then( validateInput(form[input])
          .then( validateForm(form)) );
      });
      form[input].element.blur(function() {
        let pristine = form[input].state.indexOf('pristine');
        if (pristine >= 0) form[input].state[pristine] = 'dirty';
        validateInput(form[input]).then(validateForm(form));
      });
      validateInput(form[input]);
    }
    form['state'] = ['pristine'];
    form['element'] = el;
    let button = $(el.find(`[type='submit']`)[0]);
    if (button) {
      button.addClass('disabled');
      button.attr('disabled', 'disabled');
      form['submit'] = button;
      form.submit.click(e=>callback(constructForm(e, form)));
    }
    form.element.submit(e=>callback(constructForm(e, form)));
    validateForm(form, true);
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
    if (!validateForm(form)) return false;
    let formData = {};
    let inputs = form.element.find('input');
    for (let i = 0; i < inputs.length; i++) {
      formData[inputs[i].name] = inputs[i].value;
    }
    return formData;
  }

  function redundant(input) {
      return input == 'state' || input == 'element' || input == 'submit';
  }

  function setState(input, test) {
    if (!test) {
      let valid = input.state.indexOf('valid');
      if (valid >= 0) input.state[valid] = 'invalid';
      else if ( input.state.includes('invalid') ) return;
      else input.state.push('invalid');
      return;
    }
    let invalid = input.state.indexOf('invalid');
    if (invalid >= 0)input.state[invalid] = 'valid';
    else if ( input.state.includes('valid') ) return;
    else input.state.push('valid');
  }

  function setClass(element, input) {
    element.removeClass('pristine dirty valid invalid');
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
      if ((!result.approved || !response) && input.state.includes('dirty')) {
        parent.addClass('has-error');
        errors.html(renderErrors(input.error, result));
        return;
      }
      errors.html('');
      parent.removeClass('has-error');
    });
  }

  function validateForm(form, init = false) {
    let valid = true;
    for (var input in form) {
      if (redundant(input)) continue;
      if (form[input].state.includes('invalid')) valid = false;
    }
    let pristine = form.state.indexOf('pristine');
    if (pristine >= 0 && !init) form.state[pristine] = 'dirty';
    if (valid) {
      form.submit.removeClass('disabled');
      form.submit.attr('disabled', false);
    } else {
      form.submit.addClass('disabled');
      form.submit.attr('disabled', false);
    }
    setState(form, valid);
    setClass(form.element, form);
    return valid;
  }

  function renderErrors(errors, result) {
    let errorHTML = message => `<small class="text-danger">${message}</small>`
    if (typeof errors == 'string') return errorHTML(errors);
    for (let error in errors) {
      if (!result[error].approved) {
        return errorHTML(errors[error]);
        break
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
    rules: { required: true, email: true, newRule: {foo: 4, bar: 5} }
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
