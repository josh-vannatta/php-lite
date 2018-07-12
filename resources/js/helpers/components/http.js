const http = (function() {
  'use strict';
  let _this = {
    post: post
  }

  function post(path, formData) {
    let form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', path);
    if (!formData.hasOwnProperty['_token'])
      formData['_token'] = ENV.CSRF;
    for (var key in formData) {
      if(formData.hasOwnProperty(key)) {
          var hiddenField = document.createElement("input");
          hiddenField.setAttribute("type", "hidden");
          hiddenField.setAttribute("name", key);
          hiddenField.setAttribute("value", formData[key]);
          form.appendChild(hiddenField);
      }
    }
    document.body.appendChild(form);
    form.submit();
  }

  return _this;

}());

export { http };
