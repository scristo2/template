<?php
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;
$path = $_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="">
    <meta http-equiv="content-type" content="text.html" charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="author" content="Sergio Cristobal Colino">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="index"/>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>League of Legends Premium-Reset password</title>
    <link rel="stylesheet" href="/src/principal/divCenter/index.css?cache=567">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }

        body{

            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
            'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue',
            sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }


        #root{

            position: fixed;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            
        }

      


        .App{

            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .App-header{

            height: 100%;
            display: flex;
            flex-direction: column;
            background-image: url(/src/images/test4.jpg);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            overflow-y: auto;

           
        }

        .App-header-div-logo{

           display: flex;
           margin-top: 2vmin;
          
           
        }

        .App-header-logo{

            width: 30vmin;
            height: 15vmin;
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            
        }

        .App-header-div-form{

            background-color: white;
            box-shadow: 0px 2px 5px black;
            display: flex;
            flex-direction: column;
            margin: 0px 2vmin 2vmin 2vmin;

        }

        .App-header-div-form-title{

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .App-header-div-form-title-title{

            margin: 10vmin 0px 0px 0px;
        }



        .App-header-form{

            margin: 5vmin 0px 5px 0px;
            display: flex;
            flex-direction: column;
            background-color: #f9f9f9;
        }

         
        
        .App-header-form-div-input:not(:first-child){

             margin: 2vmin 0px 0px 0px;
        }

        .App-header-form-div-input{

            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .App-header-form-input{

            width: 80%;
            cursor: pointer;
            font-size: 16px;
            outline: none !important;
            outline-width: 0 !important;
            box-shadow: none;
           -moz-box-shadow:none;
           -webkit-box-shadow:none;
            font-size: 16px;
            height: 50px;
            border: none;
            background-color: #ededed;
            padding: 2vmin;
        }

        .App-header-div-form-eye{

            width: 5vmin;
            height: 5vmin;
            filter: brightness(1.1);
            mix-blend-mode: multiply;
            cursor: pointer;
            margin-left: 1vmin;
        }


        .App-header-form-submit{


              padding: 2vmin;
              background-color: green;
              color: #ffffff;
              height: 50px;
              border-radius: 25%;
              cursor: pointer;
              margin-bottom: 5vmin;
        }

        .insideDivCenter:last-child{

            margin-top: 2vmin;
        }

        #logIn{
            
            padding: 2vmin;
            background-color: blue;
            color: white;
            font-weight:bolder;
            cursor: pointer;
            display: none;
        }



        @media screen and (min-width: 1000px){

            .App-header{

                align-items: center;
                
            }

             .App-header-div-form{


                   width: 50%;
             }
        }

       

    </style>
</head>
<body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <script type="text/javascript">
       if(window.navigator.userAgent.toString().toLocaleLowerCase().indexOf('msie') > -1 || window.navigator.userAgent.toString().toLocaleLowerCase().indexOf('trident') > -1){
           document.write('<p>This navigator dont support this app.<p>')
       }
    </script>
    <script type="text/javascript" async defer>
        $(document).ready(function(){

             function clickFormSubmit(){

                       

                       $('.App-header-form').submit(function(e){

                            e.preventDefault();

                            $('.App-header-form-submit').prop('disabled', true);

                            afterFetAnswerResetPassword('.App-header-form').then(function(resolve){

                                $('.divCenter').css({
                                    backgroundImage : 'none'
                                });

                                $('.App').css({'opacity' : '0.5'});


                                $('.insideDivCenter').css({display : 'flex'});

                                $('#insideDivCenterClose').css({display : 'flex'});

                                //add src img in this case is info beacuse is succesfully

                                $('.insideDivCenterImg').prop('src', '/src/images/info.png');

                                //and i insert text with the answer

                                $('.insideDivCenterText').text(resolve);

                                //show Button login

                                $('#logIn').css({display : 'flex'});

                                //hide close window

                                $('#insideDivCenterClose').remove();


                                $('#logIn').on('click', function(){

                                    document.location.href = "<?php echo Robot::getMyDomain();?>"; 
                                });


                                $()

                            }, function(reject){

                                $('.divCenter').css({
                                    backgroundImage : 'none'
                                });

                                $('.App').css({'opacity' : '0.5'});


                                $('.insideDivCenter').css({display : 'flex'});

                                $('#insideDivCenterClose').css({display : 'flex'});

                                //add src img in this case is info beacuse is error

                                $('.insideDivCenterImg').prop('src', '/src/images/errorDivcenter.png');

                                //and i insert text with the answer

                                $('.insideDivCenterText').text(reject);
                            });
                       });
                  
                }


             function eyesPasswords(){

                var listEyesPasswords = document.querySelectorAll('.App-header-div-form-eye');
                var listInputsForm = document.querySelectorAll('.App-header-form-input');

                $(listEyesPasswords).each(function(index, element){

                    $(this).on('click', function(){

                      if($(listEyesPasswords[index]).prop('src').toString().indexOf("showPassword.png") > -1){

                           $(listEyesPasswords[index]).prop('src', '/src/images/dontShowPassword.png');

                           $(listInputsForm[index]).prop('type', 'text');
                      
                      }else{

                        $(listEyesPasswords[index]).prop('src', '/src/images/showPassword.png');
                        $(listInputsForm[index]).prop('type', 'password');
                      }
                  });
               });
             }

             //1
             function getAnswerResetPassword(form){

                 return new Promise(function(resolve, reject){

                     var xhr = new XMLHttpRequest();
                     xhr.open('POST', "/src/bot/ultimateResetPassword.php");
                     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                     xhr.timeout = 30000;
                     xhr.onload = function(){

                        if(xhr.readyState == 4 && xhr.status == 200){

                            setTimeout(() => {
                                resolve(xhr.responseText);
                            }, 3000);
                        }
                     }

                     xhr.onreadystatechange = function(){

                          if(xhr.status !== 200 && xhr.status > 1){

                               setTimeout(() => {
                                   reject(xhr.responseText);
                               }, 3000);
                          }
                     }

                     xhr.onerror = function(){

                         setTimeout(() => {
                             reject("An ocurred an error.Try again!");
                         }, 3000);
                     }

                     xhr.ontimeout = function(){

                         setTimeout(() => {
                             reject('The connection time with the server has expired.Try again');
                         }, 3000);
                     }

                     xhr.send($(form).serialize());
                 });
             }

             //2 

             async function afterFetAnswerResetPassword(form){
                   
                   
                   $('.divCenter').css({
                       display : 'flex',
                       backgroundImage : 'url(/src/images/loading3.gif)'
                    });

                    $('.insideDivCenter').css({display : 'none'});
                    $('#insideDivCenterClose').css({display : 'none'});
                   var result = await getAnswerResetPassword(form);
                   return result;
             }

             //
            eyesPasswords();
            clickFormSubmit();

        });
    </script>
    <div id="root">
    <div class="divCenter">
        <div  id="insideDivCenterClose"><img id="imgCloseDivCenter" class="closeWindowImg" src="/src/images/closeWindow.jpg" alt="Image close window"></div>
        <script type="text/javascript" defer async>
            $('#imgCloseDivCenter').on('click', function(){
                 $('.divCenter').css({display : 'none'});
                   
           //recuperate .App opacity
           $('.App').css({'opacity' : 'initial'});

           $('.App-header-form-submit').prop('disabled', false);
       });
    </script>
    <div class="insideDivCenter" id="insideDivCenter">
        <img  alt="Image info" class="insideDivCenterImg">
        <hr class="insideDivCenterHr">
        <p class="insideDivCenterText"></p>
    </div>
    <div class="insideDivCenter">
        <input type="button" id="logIn" value="Log In">
    </div>
</div>
        <div class="App">
            <div class="App-header">
                <div class="App-header-div-logo">
                     <img src="/src/images/leagueOfLegends.png" alt="Logo League of Legends" class="App-header-logo">
                 </div>
                 <div class="App-header-div-form">
                     <div class="App-header-div-form-title">
                          <h2 class="App-header-div-form-title-title">Reset Password</h2>
                     </div>
                     <form class="App-header-form">
                         <div class="App-header-form-div-input">
                            <input name="path" type="hidden" value="<?php echo $_SERVER['DOCUMENT_ROOT'] . $path;?>">
                            <input name="temporalPassword" type="password" maxlength="15" minlength="5" class="App-header-form-input"  required autocomplete="no" placeholder="temporal password">
                            <img class="App-header-div-form-eye" src="/src/images/showPassword.png" alt="Click here show password">
                         </div>
                         <div class="App-header-form-div-input">
                              <input name="password1" type="password" minlength="5" maxlength="15" class="App-header-form-input" required autocomplete="no" placeholder="New Password">
                              <img class="App-header-div-form-eye" src="/src/images/showPassword.png" alt="Click here show password">
                         </div>
                         <div class="App-header-form-div-input">
                              <input name="password2" type="password" class="App-header-form-input" required autocomplete="no" placeholder="Reapeat new Password">
                              <img class="App-header-div-form-eye" src="/src/images/showPassword.png" alt="Click here show password">
                         </div>
                         <div class="App-header-form-div-input">
                             <input type="submit" name="App-header-form-submit" class="App-header-form-submit" value="Reset password">
                         </div>
                     </form>
                 </div>
            </div>
        </div>
    </div>
</body>
</html>