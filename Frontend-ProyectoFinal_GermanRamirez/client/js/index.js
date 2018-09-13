$(function(){
  var l = new Login();
})


class Login {
  constructor() {
    this.submitEvent()
  }

  submitEvent(){
    $('form').submit((event)=>{
      event.preventDefault()
      this.sendForm()
    })
  }

  sendForm(){
      
    let params ={
            "username": $('#user').val(),
            "password": $('#password').val()
    };
    $.ajax({
        url: '../server/check_login.php',
        type: "POST",
        data: params,
        async: true,
        cache: false,
        dataType: "json",
      success: function(php_response){
          console.log(php_response);
        if (php_response.msg == "OK") {
          window.location.href = 'main.html';
        }else {
          alert(php_response.msg);
        }
      },
      error: function(xhr,status,errorr){
          console.log(xhr);
          console.log(status);
          console.log(errorr);
        alert("error en la comunicación con el servidor");
      }
    })
  }
}
