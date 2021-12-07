<!---login-->
<div id="App-content-temporal-login" class="App-content-temporal-divs App-content-temporal-login"> 
    <div class="App-content-temporal-login-formDiv">
        <div class="backgroundLogin" id="backgroundLogin"></div>
        <form id="formLogin" class="App-content-temporal-login-form" autocomplete="on">
            <div class="insideFormLogin titleInsideformLogin"><h1>Log In</h1></div>
            <div class="insideFormLogin insideFormLogin2"><p>Email:</p></div>
            <input type="email" id="emailLogin" name="emailLogin" class="App-content-temporal-login-form-input insideFormLogin" required>
            <p id="errorEmailLogin" class="errorLogin"></p>
            <div class="insideFormLogin insideFormLogin2"><p>Password:</p></div>
            <input type="password" id="passwordLogin" name="passwordLogin" minlength="4" required  class="App-content-temporal-login-form-input insideFormLogin">
            <p id="errorPasswordLogin" class="errorLogin"></p>
            <div class="App-content-temporal-login-form-input-divCheck insideFormLogin">
                <input type="checkbox" id="checkLogin" name="checkLogin" class="App-content-temporal-login-form-check">
                <p>Remember sesion</p>
            </div>
            <input type="submit" class="insideFormLogin" id="App-content-temporal-login-form-input-submit" value="Log In">
            <hr>
            <input type="button" value="Reset password" class="insideFormLogin"  id="App-content-temporal-login-form-reset">
            <input type="button" value="Create account" class="insideFormLogin"  id="App-content-temporal-login-form-register">
        </form>
        <form id="formLoginReset" class="App-content-temporal-login-form" autocomplete="on">
            <div class="insideFormLogin titleInsideformLogin"><h2>Reset password</h2></div>
            <p class="insideFormLogin">email:</p>
            <input class="App-content-temporal-login-form-input insideFormLogin" type="email" name="emailReset" required>
            <hr>
            <input class="insideFormLogin" id="App-content-temporal-login-form-reset-input-submit" type="submit" value="Reset password">
        </form>
    </div>
    <script type="text/javascript">
       
       //after login create div account
       function getCodeMenuAccount(){

          return new Promise(function(resolve, reject){

               var xhr = new XMLHttpRequest();
               xhr.open('GET', "./src/principal/menu/account/index.php?cache=4589");
               xhr.timeout = 30000;
               xhr.onload = function(){

                  if(xhr.readyState == 4 && xhr.status == 200){

                     setTimeout(() => {
                         resolve(xhr.responseText);
                     }, 2000);
                  }
               }

               xhr.onerror = function(){

                 setTimeout(() => {
                     reject('An ocurred an error!');
                 }, 2000);
               }

               xhr.ontimeout = function(){

                   setTimeout(() => {
                       reject("The connection time has expired, try again!");
                    }, timeout);
                }


                xhr.send(null);
          });
       }

       
       function getAnswerForm(url,form, timeout){

            return new Promise(function(resolve, reject){

                  var xhr = new XMLHttpRequest();
                  xhr.open('POST', url, true);
                  xhr.timeout = 30000;
                  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhr.onload = function(){

                     if(xhr.readyState == 4 && xhr.status == 200){

                         setTimeout(() => {
                            if(url.toString().includes('login')){
                                resolve(JSON.parse(xhr.responseText));
                            }else{
                                resolve(xhr.responseText);
                            }
                         }, timeout);
                     
                    }else{

                        setTimeout(() => {
                            reject("An ocurred an error!");
                        }, timeout);
                    }
                  }


                  xhr.onreadystatechange = function(){

                       if(xhr.status !== 200 && xhr.status > 1){

                           setTimeout(() => {
                               reject(xhr.responseText);
                           }, timeout);
                        
                        }
                  }

                  xhr.ontimeout = function(){

                     setTimeout(() => {
                        reject("The connection time has expired, try again!");
                     }, timeout);
                  }

                  xhr.onerror = function(){

                     setTimeout(() => {
                        reject("An error has occurred, please try again!"); 
                     }, timeout);
                  }

                  xhr.send($(form).serialize());
            });
       }

       //only login form
       async function afterGetAnswerForm(url, form, timeout){
            
             //show loading
           $('.divCenter').css({
               display : 'flex',
               backgroundImage : 'url(/src/images/loading.gif)'
            });
             //and hidden content from divcenter because is only loading
           $('.insideDivCenter').css({display : 'none'});
           $('#insideDivCenterClose').css({display : 'none'});
            var result = await getAnswerForm(url, form, timeout);
            var result1 = await getCodeMenuAccount();
            return {


                 result,
                 result1
            }
       }

       //for reset password

       async function afterGetAnswerFormResetPassword(url, form, timeout){

             //show loading
           $('.divCenter').css({
               display : 'flex',
               backgroundImage : 'url(/src/images/loading.gif)'
            });
             //and hidden content from divcenter because is only loading
           $('.insideDivCenter').css({display : 'none'});
           $('#insideDivCenterClose').css({display : 'none'});

           var result = await getAnswerForm(url, form, timeout);
           return result;
       }

       $('#formLogin').submit(function(e){
            
             e.preventDefault();
             
             //disabled submit until delete .divCenterLoad
             $('#App-content-temporal-login-form-input-submit').prop('disabled', true);
 
             afterGetAnswerForm("/src/bot/login.php", $(this), 2000).then(function(resolve){
                  
                   //hidden divCenter because succesfully login
                  $('.divCenter').css({
                       display : 'none',
                    });


                  $('#App-content-temporal-login-form-input-submit').prop('disabled', false);


                  //change text login by username
                  
                  $('.App-header-elements-inside-div-blockedDivTextP').val(resolve['result']['username']);


                  //change src image login by username image

                  $('.App-header-elements-inside-div-imgBlocked').prop('src', "./src/images/profileMenu.png");


                  //hidden menu login and register

                  var listMenuElements = document.querySelectorAll('.App-menu-elements');

                  $(listMenuElements[2]).css({display : 'none'});
                  $(listMenuElements[3]).css({display : 'none'});


                  //show my account menu

                  $(listMenuElements[1]).css({display :'flex'});


                  //hidden div login

                  $('#App-content-temporal-login').css({display : 'none'});


                  //show my accounnt after login

                  $('.App-content-temporal-chat').after(resolve['result1']); //append account


                  $('.App-content-temporal-account').css({display : 'flex'});
                  
                  
                  //show close session next to text username
                  $('#App-header-elements-inside-div-imgCloseSession').css({display : 'flex'});


                  //change url to my account

                  window.history.replaceState({'actions' : 'my account'}, "Make you own team or join to any", "?query=myaccount");


             }, function(reject){

                   //hidden background login because has show the answer register
                   $('.divCenter').css({

                     backgroundImage : 'none',

                   });

                   //opacity app because the .divCenter look like better 

                   $('.App').css({'opacity' : '0.5'});

                   //show inside beacuse i need close button and answer register 

                   $('.insideDivCenter').css({display : 'flex'});
                   $('#insideDivCenterClose').css({display : 'flex'});


                   //add src img in this case is errot beacuse is not succesfully

                    $('.insideDivCenterImg').prop('src', './src/images/errorDivCenter.png');

                    //and i insert text with the answer

                    $('.insideDivCenterText').text(reject);
             });

             //uncheked checkLogin

             //$('#checkLogin').prop('checked', false);
             
             //empty inputs form login
             //$('#emailLogin').val('');
             //$('#passwordLogin').val('');

       });


       $('#formLoginReset').submit(function(e){

             e.preventDefault();

             //disabled button after click

             $('#App-content-temporal-login-form-reset-input-submit').prop('disabled', true);


             afterGetAnswerFormResetPassword("/src/bot/resetPassword.php?cache=789", $(this), 2000).then(function(resolve){

                  if(resolve.toString().includes('succesfully')){

                     //disabled button after click

                     $('#App-content-temporal-login-form-reset-input-submit').prop('disabled', false);
                     $('#App-content-temporal-login-form-reset-input-submit').click();


                  }else{

                        

                       //hidden background login because has show the answer register
                       $('.divCenter').css({

                           backgroundImage : 'none',

                       });

                       //opacity app because the .divCenter look like better 

                       $('.App').css({'opacity' : '0.5'});

                       //show inside beacuse i need close button and answer register 

                         $('.insideDivCenter').css({display : 'flex'});
                         $('#insideDivCenterClose').css({display : 'flex'});


                        //add src img in this case is info beacuse is succesfully

                        $('.insideDivCenterImg').prop('src', './src/images/info.png');

                         //and i insert text with the answer

                        $('.insideDivCenterText').text(resolve);
                  }


             }, function(reject){

                 //hidden background login because has show the answer register
                 $('.divCenter').css({

                     backgroundImage : 'none',

                 });

                 //opacity app because the .divCenter look like better 

                 $('.App').css({'opacity' : '0.5'});

                 //show inside beacuse i need close button and answer register 

                 $('.insideDivCenter').css({display : 'flex'});
                 $('#insideDivCenterClose').css({display : 'flex'});


                 //add src img in this case is info beacuse is error

                 $('.insideDivCenterImg').prop('src', './src/images/errorDivCenter.png');

                 //and i insert text with the answer

                $('.insideDivCenterText').text(reject);

             });
       });


       ///click create account
       
       $('#App-content-temporal-login-form-register').on('click', function(){

           var menuHiddenRegister = document.querySelectorAll('.App-menu-elements')[3];

           $(menuHiddenRegister).click();

           
       });

       
       //click reset password
       $('#App-content-temporal-login-form-reset').on('click', function(){

          //hidden form login
          $('#formLogin').css({display : 'none'}); 
          
          //show form login reset

          $('#formLoginReset').css({display : 'flex'});

          window.history.replaceState({'actions' : 'Reset password'}, "Make you own team or join to any", "?query=reset&&password");
       });

    </script>
</div>