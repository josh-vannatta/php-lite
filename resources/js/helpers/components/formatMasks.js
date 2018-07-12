const formatMasks = (function() {
  'use strict';
  let _this = {
    bind: bind
  }

  function bind() {
    $(".numbers-only").keypress(function(){
      return event.charCode >=48 && event.charCode <= 57;
    })
    $(".floats-only").keypress(function(){
      return (event.charCode >=48 && event.charCode <= 57) || event.charCode == 46;
    })
    $('.phone-format').mask('(000)000-0000');
    $('.currency-format').mask('$0.00');
    $('.credit-format').mask('0000-0000-0000-0000-000');
    $('.fulldate-format').mask('00/00/0000');
    $('.fulldate-format').keyup(function(){
      if ($(this).val().length > 10) return false;
    });
    $('.date-format').mask('00/00/00');
    $('.date-format').keyup(function(){
      if ($(this).val().length > 8) return false;
    })
    $('.date-format').bind('blur', function(){
      let num = '00000' + $(this).val().toString();
      if ($(this).val() == "" || $(this).val() < 1) num = "";
      $(this).val(num.slice(-2));
    })
    $(".zip-format").keyup(function(){
      if ($(this).val().length > 5) return false;
    })
    $(".titleCase-format").blur(function(){
      toTitleCase($(this));
    })
    $('.currency-format').bind('blur change', function(){
      let str = $(this).val();
      currArr = str.split('.');
      correct = currArr[0];
      if (currArr.length > 1)
        correct = currArr[0] + '.' + currArr[1];
      $(this).val(formatCurrency(correct));
    })
  }

  return _this;
}());

export { formatMasks };
