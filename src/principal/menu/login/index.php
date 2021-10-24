<div class="App-content-temporal-divs App-content-temporal-login"> 
    <div class="App-content-temporal-login-formDiv">
        <div id="backgroundLogin"></div>
        <form id="formLogin" class="App-content-temporal-login-form" autocomplete="on">
            <div class="insideFormLogin insideFormLogin2"><p>Email:</p></div>
            <input type="email" name="emailLogin" class="App-content-temporal-login-form-input insideFormLogin" required>
            <p class="errorLogin"></p>
            <div class="insideFormLogin insideFormLogin2"><p>Password:</p></div>
            <input type="password" name="passwordLogin" minlength="4" required  class="App-content-temporal-login-form-input insideFormLogin">
            <p class="errorLogin"></p>
            <div class="App-content-temporal-login-form-input-divCheck insideFormLogin">
                <input type="checkbox" name="checkLogin" class="App-content-temporal-login-form-check">
                <p>Remember sesion</p>
            </div>
            <input type="submit" class="insideFormLogin" id="App-content-temporal-login-form-input-submit" value="Log In">
            <hr>
            <input type="button" value="Reset password" class="insideFormLogin"  id="App-content-temporal-login-form-reset">
            <input type="button" value="Create account" class="insideFormLogin"  id="App-content-temporal-login-form-register">
        </form>
    </div>
    <script type="text/javascript">
       $('#formLogin').submit(function(e){
            
             e.preventDefault();

             $.ajax({

                 type : 'POST',
                 url : '/src/bot/logisn.php',
                 data : $(this).serialize(),
                 success: function(response){

                    console.log(response);
                 },
                 error : function(){

                    console.log('H aocurrio un error con la peticion');
                 }

             });

       });
    </script>
</div>