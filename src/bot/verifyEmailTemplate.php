<?php
error_reporting(0);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;
$protocol = null;
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){

    $protocol = 'https://';
}else{

    $protocol = 'http://';
}
$emailUser = null;
if(preg_match('/QUERY(.*)/', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], $result)){

    $emailUser = $result[1];

}else{

     $emailUser = 'Error email';
}
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
    <title>Verify account</title>
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

        .App{
             position: fixed;
             width: 100%;
             display: flex;
             flex-direction: column;
        }

        .App-header{
             
             width: 100%;
             height: 100vh;
             background-color: black;
             display: flex;
             flex-direction: column;
             justify-content: center;
             align-items: center;
             background-image: url("/src/images/gifVerifyEmail.gif");
             background-size: 100% 100%;
             background-repeat: no-repeat;
             filter: brightness(1.1);
             mix-blend-mode: multiply;
        }

        .App-header-first{

             display: flex;
             flex-direction: row;
             flex-wrap: wrap;
             justify-content: center;
             align-items: center;
        }


        .img-error{

             width: 10vmin;
             height: 10vmin;
             filter: brightness(1.1);
             mix-blend-mode: multiply;
        }

        hr{

           width: 100%;
        }


        input[type=button]{

            cursor: pointer;
            margin-top: 2vmin;
            padding: 2vmin;
        }


        #register{

             background-color: green;
             color: white;
        }


        #retry{

             color: white;
             background-color: blue;
        }

       


    </style>
</head>
<body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <script type="text/javascript" async defer>
     
      $(document).ready(function(){
         
         //1
          function getAnswerVerifyEmail(){

             return new Promise(function(resolve, reject){

                   
                   var newForm = new FormData();
                   $(newForm).prop('id', 'form');
                   newForm.append('emailUser', '<?php echo $emailUser;?>');


                   var xhr = new XMLHttpRequest();
                   xhr.open('POST', '/src/bot/verifyEmail.php');
                   xhr.timeout = 30000;
                   xhr.onload = function(){

                      if(xhr.readyState == 4 && xhr.status == 200){

                          setTimeout(() => {
                              resolve(xhr.responseText);
                          }, 2000);
                      
                     }else{

                         setTimeout(() => {
                            reject("An error has occurred, please try again!");
                         }, 2000);
                     }
                   }

                   xhr.onreadystatechange = function(){

                      if(xhr.status !== 200 && xhr.status > 1){

                            ///change to status a 0 when send mail

                            setTimeout(() => {
                                reject(xhr.responseText)
                            }, 2000);
                      }
                   }

                   xhr.ontimeout = function(){

                      setTimeout(() => {
                        reject("The connection time has expired, try again!");
                       }, 2000);
                   }


                   xhr.onerror = function(){

                    setTimeout(() => {
                        reject("An error has occurred, please try again!");
                     }, 2000);
                   }

                   xhr.send(newForm);
             });
          }


          //2

          async function afterGetAnswerVerifyEmail(){
              
              $('#root').append('<div class="App"><div class="App-header"><div class="App-header-first"><h3>Verifying email, please wait!</h3></div><hr></div></div>')
              var result = await getAnswerVerifyEmail();
              return result;
          }


          afterGetAnswerVerifyEmail().then(function(resolve){
               
              document.location.href = "<?php echo Robot::getMyDomain()?>";
              
          }, function(reject){

              
                 $('.App-header').css({

                      backgroundImage : 'none',
                      backgroundColor : '#ffffff',
                     
                      
                 });

                 $('.App-header-first').prepend('<img class="img-error" src="/src/images/errorLoadPage.jpg">')
                 
                 
                 $('hr').css({

                     marginTop : '2vmin'
                 });
           
                
                 var textButton = null; 

                 switch(reject){

                     case 'Undefined email':
                         $('.App-header').append('<input id="register" type="button" value="Create account">');
                         $('#register').on('click', function(){
                             window.location.href = "<?php echo $protocol . $_SERVER['HTTP_HOST'];?>";
                         });
                         textButton = "This email is not registered";
                         break;
                     
                     default: 
                        $('.App-header').append('<input id="retry" type="button" value="retry">');
                        $('#retry').on('click', function(){
                            window.location.reload();
                        });
                        textButton = reject;
                        break;
                     
                 }


                 $(document.querySelectorAll('h3')[0]).text(textButton);
              
            });
      });    
    </script>
    <div id="root"></div>
</body>
</html>