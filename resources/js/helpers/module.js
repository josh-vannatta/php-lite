import { dynamicForm } from './components/dynamicForm';
import { formatMasks } from './components/formatMasks';
import { http } from './components/http';
import { JSX } from './components/jsxLite';

dynamicForm.addValidation({
  matches: {
    expects: ['el'],
    validate: function(value, pars) {
      return value == $(pars.el).val();
    }
  }
})

export { dynamicForm, formatMasks, http, JSX };
