<!---register--->
<div id="App-content-temporal-register" class="App-content-temporal-divs App-content-temporal-register">
    <div class="App-content-temporal-login-formDiv">
        <div class="backgroundLogin" id="backgroundRegister"></div>
        <form id="formRegister" class="App-content-temporal-login-form" autocomplete="on">
            
           <div class="insideFormLogin titleInsideformLogin"><h1>Register</h1></div>
        
            <input type="email" placeholder="Enter your email" id="emailRegister" name="emailRegister" class="App-content-temporal-login-form-input insideFormLogin" required>
            <p class="errorLogin" id="errorRegisterEmail"></p>

            <input type="text" placeholder="Enter a username" minlength="4" maxlength="10" id="usernameRegister" name="usernameRegister" class="App-content-temporal-login-form-input insideFormLogin" required>
            <p class="errorLogin" id="errorRegisterUsername"></p>

            <input type="password" id="password1Register" placeholder="Enter a password" name="passwordRegister1" minlength="4" required  class="App-content-temporal-login-form-input insideFormLogin">
            <p class="errorLogin" id="errorRegisterPassword1"></p>

            <input type="password" placeholder="Enter again your password" id="password2Register" name="passwordRegister2" minlength="4" required  class="App-content-temporal-login-form-input insideFormLogin">
            <p class="errorLogin" id="errorRegisterPassword2"></p>

            <div class="App-content-temporal-login-form-input-divCheck insideFormLogin">
                <input id="checkRegister" type="checkbox" name="checkRegister" required class="App-content-temporal-login-form-check">
                <p id="termsRegister">I have read and accept the <span><input type="button" value="terms"></span> of service</p>
            </div>

            <input type="hidden" name="dateRegister" value="<?php echo date('d/m/Y')?>">
            
             <hr> 
            
            <input type="submit" class="insideFormLogin" id="App-content-temporal-register-form-input-submit" value="Create account">
            
        </form>
    </div>
    <script type="text/javascript">
       
       function getAnswerRegister(form){

          return new Promise(function(resolve, reject){

                var xhr = new XMLHttpRequest();
                xhr.open('POST', './src/bot/register.php?cache=56');
                xhr.timeout = 2000;
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onload = function(){

                     if(xhr.readyState == 4 && xhr.status == 200){

                         setTimeout(() => {
                             
                             resolve(xhr.responseText);
                             
                         }, 2000);
                    
                     }else{

                         setTimeout(() => {
                             
                            reject({'errorReadyState' : xhr.readyState, 'errorStatus' : xhr.status});

                         }, 2000);
                     }
                }


                xhr.onreadystatechange = function(){
                            
                          
                          if(xhr.status !== 200){

                              setTimeout(() => {
                                  reject({'errorReadyState' : xhr.readyState, 'errorStatus' : xhr.status});
                              }, 2000);
                          }
                }




                xhr.ontimeout = function(){

                     setTimeout(() => {
                        reject({'errorReadyState' : xhr.readyState, 'errorStatus' : xhr.status});
                     }, 2000);
                }


                xhr.onerror = function(){

                     setTimeout(() => {
                        reject({'errorReadyState' : xhr.readyState, 'errorStatus' : xhr.status});
                     }, 2000);
                }


                xhr.send($(form).serialize());
          });
       }

       
       async function afterGetAnswerRegister(form){
           
           //show loading
           $('.divCenter').css({
               display : 'flex',
               backgroundImage : 'url(/src/images/loading.gif)'
            });
           //and hidden content from divcenter because is only loading
           $('.insideDivCenter').css({display : 'none'});
           $('#insideDivCenterClose').css({display : 'none'});
           var result = await getAnswerRegister(form);
           return result;
       }


       $('#formRegister').submit(function(e){
            
             e.preventDefault();

             //disabled submit until delete .divCenterLoad
             $('#App-content-temporal-register-form-input-submit').prop('disabled', true);

             afterGetAnswerRegister(this).then(function(resolve){
                 
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
                
                }, function(reject){
                    
                    alert(reject['errorStatus']);
                    $('.divCenterLoad').remove(); 
                });

       });
    </script>
</div>