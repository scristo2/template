<div class="App-menu-elements App-menu-elements-chat">
    <img src="/src/images/home.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Chat</p>
</div>
<div class="App-menu-elements App-menu-elements-account" style="display: none;">
    <img src="/src/images/profileMenu.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Account</p>
</div>
<div class="App-menu-elements App-menu-elements-login">
    <img src="/src/images/logoLogin.jpeg" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Log In</p>
</div>
<div class="App-menu-elements App-menu-elements-register">
    <img src="/src/images/registerLogo.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Register</p>
</div>
<div class="App-menu-elements App-menu-elements-game">
    <img src="/src/images/searchGame.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Game</p>
</div>
<div class="App-menu-elements App-menu-elements-best">
    <img src="/src/images/theBest.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">The Best</p>
</div>
<div class="App-menu-elements App-menu-elements-banned">
    <img src="/src/images/bannedLogo.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Banned</p>
</div>
<div class="App-menu-elements App-menu-elements-runes">
    <img src="/src/images/runesLogo.jpeg" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Runes</p>
</div>
<div class="App-menu-elements App-menu-elements-forum">
    <img src="/src/images/forumLogo2.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Forum</p>
</div>
<div class="App-menu-elements App-menu-elements-contact">
    <img src="/src/images/contactLogo.jpeg" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Contact</p>
</div>
<div class="App-menu-elements App-menu-elements-last">
    <img src="/src/images/advertsimentLogo.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Ads</p>
</div>
<script type="text/javascript">
   $('.App-menu-elements').each(function(index, element){

              $(this).on('click', function(){

                   $('.App-content-temporal-divs').css({
                       display : 'none',
                   });
                   

                   var allcontents = document.querySelectorAll('.App-content-temporal-divs');
                   
                   var result = null;   
                   
                   if($('.App-header-elements-inside-div-imgBlocked').prop('src').toString().includes('/src/images/blockedPng.png')){

                       if(index > 0){

                           result = index - 1;
                       
                       }else{

                         result = index;
                       }
                   }else{

                     result = index;
                   }

                   $(allcontents[result]).css({display : 'flex'});

                   $('.App-menu').css({display : 'none'});


                   //change url query=

                   var query = null;

                   switch(true){

                        
                        case element.className.toString().includes('chat'):

                            query = 'chat';
                            break;

                        case element.className.toString().includes('account'):

                             query = 'myAccount';
                             break;    

                        case element.className.toString().includes('login')://login

                            //if is clicked reset password
                            if($('#formLoginReset').css('display') === 'flex'){

                                      $('#formLoginReset').css({display : 'none'});
                                      $('#formLogin').css({display : 'flex'});
                            }
                            query = 'login';
                            break;
                        
                            case element.className.toString().includes('register'):

                                query = 'register';
                                break; 


                            case element.className.toString().includes('game'):

                                query = 'searchGame';
                                break;


                            
                            case element.className.toString().includes('best'):
                                
                                query = 'theBest';
                                break;
                            
                            
                            case element.className.toString().includes('banned'):

                               query = 'banned';
                               break;


                            case element.className.toString().includes('runes'):

                                 query = 'runes';
                                 break; 

                             
                            case element.className.toString().includes('forum'):

                                 query = 'forum';
                                 break;

                            
                            case element.className.toString().includes('contact'):

                                 query = 'contactUs';
                                 break;
                            
                            
                            case element.className.toString().includes('last'):

                                 query = 'advertisements';
                                 break;
                        
                          
                    }

                    window.history.replaceState({'action' : 'Login'}, 'Make you own team or join to any', '?query=' + query);

              });
              
              
   });
</script>
