$(document).ready(function() {

  var _validateEmail = function(email) { 
    var re = /\w+@\w+\.\w+/;
    return re.test(email);
  }
  var _validatePwd = function(pwd) { 
    var re = /\w+/;
    return re.test(pwd);
  }

  var validateLoginForm = function() {
    $('#loginNotice').html('').hide();
    var form = document.forms["login"];
    var valid = true;
    if (_validateEmail(form["email"].value) === false)
    {
      valid = false;
      $('#loginNotice').append('E-mail is unvalid.<br/>').show();
    }
    if (_validatePwd(form["password"].value) === false)
    {
      valid = false;
      $('#loginNotice').append('Password must not be empty.<br/>').show();
    }
    return valid;
  }

  $('form').on('submit',
      function(e){
        if (validateLoginForm()===false) {
          e.preventDefault();
        }
      }
    );


  var str = $('#regex #source').html();
  $('#regex #result').html( 'Numbers of more than 4 digits are :'+ str.match(/\d{5,}/));
});