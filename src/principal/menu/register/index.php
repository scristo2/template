<!---register--->
<div id="App-content-temporal-register" class="App-content-temporal-divs App-content-temporal-register">
    <div class="App-content-temporal-login-formDiv">
        <div class="backgroundLogin" id="backgroundRegister"></div>
        <form id="formRegister" class="App-content-temporal-login-form" autocomplete="on">

            <input type="email" placeholder="Enter your email" id="emailRegister" name="emailRegister" class="App-content-temporal-login-form-input insideFormLogin" required>
            <p class="errorLogin" id="errorRegisterEmail"></p>

            <input type="text" placeholder="Enter a username" minlength="4" maxlength="10" id="usernameRegister" name="usernameRegister" class="App-content-temporal-login-form-input insideFormLogin" required>
            <p class="errorLogin" id="errorRegisterUsername"></p>

            <input type="password" id="password1Register" placeholder="Enter a password" name="passwordRegister1" minlength="4" required  class="App-content-temporal-login-form-input insideFormLogin">
            <p class="errorLogin" id="errorRegisterPassword1"></p>

            <input type="password" placeholder="Enter again your password" id="password2Register" name="passwordRegister2" minlength="4" required  class="App-content-temporal-login-form-input insideFormLogin">
            <p class="errorLogin" id="errorRegisterPassword2"></p>

            <div class="App-content-temporal-login-form-input-divCheck insideFormLogin">
                <input id="checkRegister" type="checkbox" name="checkRegister" class="App-content-temporal-login-form-check">
                <p id="termsRegister">I have read and accept the <span><input type="button" value="terms"></span> of service</p>
            </div>

            <input type="hidden" name="dateRegister" value="<?php echo date('d/m/Y')?>">
            
             <hr> 
            
            <input type="submit" class="insideFormLogin" id="App-content-temporal-register-form-input-submit" value="Create account">
            
        </form>
    </div>
    <script type="text/javascript">
       $('#formRegister').submit(function(e){
            
             e.preventDefault();

             $.ajax({

                 type : 'POST',
                 url : '/src/bot/register.php',
                 data : $(this).serialize(),
                 success: function(response){
                 
                    if(response === 'yes'){

                        $('#checkRegister').prop('checked', false);
                    }

                    alert(response);
                 },
                 error : function(response){

                    //
                 }

             });

       });
    </script>
</div>