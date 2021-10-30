<!---login-->
<div id="App-content-temporal-login" class="App-content-temporal-divs App-content-temporal-login"> 
    <div class="App-content-temporal-login-formDiv">
        <div class="backgroundLogin" id="backgroundLogin"></div>
        <form id="formLogin" class="App-content-temporal-login-form" autocomplete="on">
            <div class="insideFormLogin titleInsideformLogin"><h1>Log In</h1></div>
            <div class="insideFormLogin insideFormLogin2"><p>Email:</p></div>
            <input type="email" name="emailLogin" class="App-content-temporal-login-form-input insideFormLogin" required>
            <p id="errorEmailLogin" class="errorLogin"></p>
            <div class="insideFormLogin insideFormLogin2"><p>Password:</p></div>
            <input type="password" name="passwordLogin" minlength="4" required  class="App-content-temporal-login-form-input insideFormLogin">
            <p id="errorPasswordLogin" class="errorLogin"></p>
            <div class="App-content-temporal-login-form-input-divCheck insideFormLogin">
                <input type="checkbox" name="checkLogin" class="App-content-temporal-login-form-check">
                <p>Remember sesion</p>
            </div>
            <input type="submit" class="insideFormLogin" id="App-content-temporal-login-form-input-submit" value="Log In">
            <hr>
            <input type="button" value="Reset password" class="insideFormLogin"  id="App-content-temporal-login-form-reset">
            <input type="button" value="Create account" class="insideFormLogin"  id="App-content-temporal-login-form-register">
        </form>
        <form id="formLoginReset" class="App-content-temporal-login-form" autocomplete="on">
            <div class="insideFormLogin titleInsideformLogin"><h1>Reset password</h1></div>
            <p class="insideFormLogin">Enter your email:</p>
            <input class="insideFormLogin" type="email" required>
            <p class=" insideFormLogin errorLogin">This email is wrong!</p>
            <input class="insideFormLogin" id="App-content-temporal-login-form-reset-input-submit" type="submit" value="Reset password">
        </form>
    </div>
    <script type="text/javascript">
       
       function getAnswerForm(url,form, timeout){

            return new Promise(function(resolve, reject){

                  var xhr = new XMLHttpRequest();
                  xhr.open('POST', url, true);
                  xhr.timeout = 3000;
                  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhr.onload = function(){

                     if(xhr.readyState == 4 && xhr.status == 200){

                         setTimeout(() => {
                             resolve(xhr.responseText);
                         }, timeout);
                     
                    }else{

                        setTimeout(() => {
                            reject({responseErrorStatus : this.status, responseErrorReadyState : this.readyState});
                        }, timeout);
                    }
                  }

                  xhr.ontimeout = function(){

                     setTimeout(() => {
                        reject({responseErrorStatus : this.status, responseErrorReadyState : this.readyState});
                     }, timeout);
                  }

                  xhr.onerror = function(){

                     setTimeout(() => {
                        reject({responseErrorStatus : this.status, responseErrorReadyState : this.readyState}); 
                     }, timeout);
                  }

                  xhr.send($(form).serialize());
            });
       }

       
       async function afterGetAnswerForm(url, form, timeout){
            
            $('#root').append("<div class='divCenterLoad'></div>")
            var result = await getAnswerForm(url, form, timeout);
            return result;
       }

       $('#formLogin').submit(function(e){
            
             e.preventDefault();
 
             afterGetAnswerForm("/src/bot/login.php", $(this), 10).then(function(resolve){
                 $('.divCenterLoad').remove();
                 alert(resolve);
             }, function(reject){
                 alert(reject['responseErrorStatus'] + '/ ' + reject['responseErrorReadyState']);
             })

       });


       $('#formLoginReset').submit(function(e){

             e.preventDefault();

             $.ajax({

                 type : 'POST',
                 url : '/src/bot/resetPassword.php',
                 data : $(this).serialize(),
                 success: function(response){
                     alert(response);
                 },
                 error : function(){
                     alert('error form reset');
                 }
             });
       });


       ///click create account
       
       $('#App-content-temporal-login-form-register').on('click', function(){

           var menuHiddenRegister = document.querySelectorAll('.App-menu-elements')[2];

           $(menuHiddenRegister).click();
       });

       
       //click reset password
       $('#App-content-temporal-login-form-reset').on('click', function(){

          //hidden form login
          $('#formLogin').css({display : 'none'}); 
          
          //show form login reset

          $('#formLoginReset').css({display : 'flex'});
       });

    </script>
</div>