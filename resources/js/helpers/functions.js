function listenFor(callback) {
  return new Promise((resolve, reject) => {
    setTimeout(()=>{
      if (callback()) resolve();
      else listenFor(callback);
    }, 100);
  });
}

function formatCurrency(val){
  return parseFloat(Math.round(val * 100) / 100).toFixed(2);
}

function toTitleCase(txt){
    return txt.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

// Styles payment amount into $0.00 format
function amtFloat(){
  if (!isNaN(paymentAmt.value) && paymentAmt.value != "") {
     paymentAmt.value = "$" + parseFloat(paymentAmt.value).toFixed(2);
  } else {
     paymentAmt.value = "";
     paymentAmt.className = "";
     paymentAmt.placeholder = "$0.00";
  }
};

// Verifies if input is a number & allows only numerical input
function isNumber(evt, id) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 45 || charCode > 57)) {
        return false;
    };
    if (id == "payment-amount"){
    	if (charCode == 47 || charCode == 45){
    		return false;
    	};
    } else if (id == "credit-cvcode" || id=="credit-num"){
    	if (charCode == 47 || charCode == 46 || charCode == 45){
    		return false;
    	};
    };
    return true;
};


function validEmail(input){
  userEmail = input;
  let isEmail = 0;
  for (i = 0; i <=userEmail.length; i++){
      if (userEmail.slice(0,1) != "@"){
          if (userEmail.slice(i, i+1) == "@") {
              isEmail += 1;
          } else if (userEmail.slice(i, i+1) == "."){
          	if (userEmail.slice(i-1, i) != "@"){
      	       isEmail *= 2;
            };
          };
      };
      if (userEmail.slice(i , i+1) == " "){
        return false;
      }
  };
  if (isEmail >= 2) {
    return true;
  } else {
   return false;
 }
}

function validPass(input) {
  let str = input;
  let spaces = false;
  for (let i = 0; i < str.length; i++) {
    if (str.slice(i, i+1) != ' ') spaces = true;
  }
  if (str != '' && spaces){
    return true
  } else {
    return false;
  }
}

function strongPass(input) {
  let str = input;
  let strong = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
  if (!strong.test(str)) {
    return false;
  } else {
    return true;
  }
}

function validString(input, type) {
    let str = input;

    if (str == undefined || str == "") {
      return false;
    } else {
      return true;
    }
}

function validZip(input) {
  let str = input;
  let regX = /(^\d{5}$)|(^\d{5}-\d{4}$)/;

  if (!regX.test(str)) {
    return false;
  } else {
    return true;
  }
}

function validPhone(input) {
  let num = input;
  if(num.length < 13) {
    return false;
  } else {
    return true;
  }
}

function validSelect(input) {
  let str = input;

  if (!str) {
    return false;
  } else {
    return true;
  }
}

function validDate(input) {
  let num = input;
  let str = num.split('/');
  let now = new Date();
  let mm = str[0];
  let dd = str[1];
  let yy = str[2];
  let yyNow = now.getFullYear();
  if (num.length < 10 || mm > 12 || dd > 31 || yy < 1900 || yy > yyNow) {
    return false;
  } else {
    return true;
  }
}

function clone(x) {
  let prefixPattern, exactPattern, dupe;

  if (!x) { return null; }

  prefixPattern = x.prefixPattern.source;
  exactPattern = x.exactPattern.source;
  dupe = JSON.parse(JSON.stringify(x));
  dupe.prefixPattern = prefixPattern;
  dupe.exactPattern = exactPattern;

  return dupe;
}

const creditCard = (function() {

  // CREDIT CARD type
  'use strict';

  let types = {};
  let VISA = 'visa';
  let MASTERCARD = 'master-card';
  let AMERICAN_EXPRESS = 'american-express';
  let DINERS_CLUB = 'diners-club';
  let DISCOVER = 'discover';
  let JCB = 'jcb';
  let UNIONPAY = 'unionpay';
  let MAESTRO = 'maestro';
  let CVV = 'CVV';
  let CID = 'CID';
  let CVC = 'CVC';
  let CVN = 'CVN';
  let testOrder = [
    VISA,
    MASTERCARD,
    AMERICAN_EXPRESS,
    DINERS_CLUB,
    DISCOVER,
    JCB,
    UNIONPAY,
    MAESTRO
  ];

  types[VISA] = {
    niceType: 'Visa',
    type: VISA,
    prefixPattern: /^4$/,
    exactPattern: /^4\d*$/,
    gaps: [4, 8, 12],
    lengths: [16, 18, 19],
    code: {
      name: CVV,
      size: 3
    }
  };

  types[MASTERCARD] = {
    niceType: 'MasterCard',
    type: MASTERCARD,
    prefixPattern: /^(5|5[1-5]|2|22|222|222[1-9]|2[3-6]|27|27[0-2]|2720)$/,
    exactPattern: /^(5[1-5]|222[1-9]|2[3-6]|27[0-1]|2720)\d*$/,
    gaps: [4, 8, 12],
    lengths: [16],
    code: {
      name: CVC,
      size: 3
    }
  };

  types[AMERICAN_EXPRESS] = {
    niceType: 'American Express',
    type: AMERICAN_EXPRESS,
    prefixPattern: /^(3|34|37)$/,
    exactPattern: /^3[47]\d*$/,
    isAmex: true,
    gaps: [4, 10],
    lengths: [15],
    code: {
      name: CID,
      size: 4
    }
  };

  types[DINERS_CLUB] = {
    niceType: 'Diners Club',
    type: DINERS_CLUB,
    prefixPattern: /^(3|3[0689]|30[0-5])$/,
    exactPattern: /^3(0[0-5]|[689])\d*$/,
    gaps: [4, 10],
    lengths: [14, 16, 19],
    code: {
      name: CVV,
      size: 3
    }
  };

  types[DISCOVER] = {
    niceType: 'Discover',
    type: DISCOVER,
    prefixPattern: /^(6|60|601|6011|65|64|64[4-9])$/,
    exactPattern: /^(6011|65|64[4-9])\d*$/,
    gaps: [4, 8, 12],
    lengths: [16, 19],
    code: {
      name: CID,
      size: 3
    }
  };

  types[JCB] = {
    niceType: 'JCB',
    type: JCB,
    prefixPattern: /^(2|21|213|2131|1|18|180|1800|3|35)$/,
    exactPattern: /^(2131|1800|35)\d*$/,
    gaps: [4, 8, 12],
    lengths: [16],
    code: {
      name: CVV,
      size: 3
    }
  };

  types[UNIONPAY] = {
    niceType: 'UnionPay',
    type: UNIONPAY,
    prefixPattern: /^((6|62|62\d|(621(?!83|88|98|99))|622(?!06)|627[02,06,07]|628(?!0|1)|629[1,2])|622018)$/,
    exactPattern: /^(((620|(621(?!83|88|98|99))|622(?!06|018)|62[3-6]|627[02,06,07]|628(?!0|1)|629[1,2]))\d*|622018\d{12})$/,
    gaps: [4, 8, 12],
    lengths: [16, 17, 18, 19],
    code: {
      name: CVN,
      size: 3
    }
  };

  types[MAESTRO] = {
    niceType: 'Maestro',
    type: MAESTRO,
    prefixPattern: /^(5|5[06-9]|6\d*)$/,
    exactPattern: /^(5[06-9]|6[37])\d*$/,
    gaps: [4, 8, 12],
    lengths: [12, 13, 14, 15, 16, 17, 18, 19],
    code: {
      name: CVC,
      size: 3
    }
  };

  function getType(cardNumber) {
    let type, value, i;
    let prefixResults = [];
    let exactResults = [];

    if (!(typeof cardNumber === 'string' || cardNumber instanceof String)) {
      return [];
    }

    for (i = 0; i < testOrder.length; i++) {
      type = testOrder[i];
      value = types[type];

      if (cardNumber.length === 0) {
        prefixResults.push(clone(value));
        continue;
      }

      if (value.exactPattern.test(cardNumber)) {
        exactResults.push(clone(value));
      } else if (value.prefixPattern.test(cardNumber)) {
        prefixResults.push(clone(value));
      }
    }

    return exactResults.length ? exactResults : prefixResults;
  }

  getType.getTypeInfo = function (type) {
    return clone(types[type]);
  };

  getType.types = {
    VISA: VISA,
    MASTERCARD: MASTERCARD,
    AMERICAN_EXPRESS: AMERICAN_EXPRESS,
    DINERS_CLUB: DINERS_CLUB,
    DISCOVER: DISCOVER,
    JCB: JCB,
    UNIONPAY: UNIONPAY,
    MAESTRO: MAESTRO
  };

  function luhnValidator(userInput){
    let backwards = "";
    let multiplyx2 = "";
    let total = 0;
    for(i = userInput.length-2; i >= 0; i-=2){
      backwards += userInput.charAt(i);
    }
    for(i = 0; i < backwards.length; i++){
      multiplyx2 += backwards.charAt(i)*2;
    }
    for(i = 0; i < multiplyx2.length; i++){
      total += parseInt(multiplyx2.charAt(i));
    }
    for(i = userInput.length-3; i >= 0; i-=2){
      total += parseInt(userInput.charAt(i));
    }
    total += parseInt(userInput.charAt(userInput.length-1))
    if((total % 10) == 0){
      return true;
    }
    return false;
  };

  return {
    type: getType,
    isValid: luhnValidator
  }
}());
