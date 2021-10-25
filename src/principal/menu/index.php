<div class="App-menu-elements">
    <img src="/src/images/home.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Home</p>
</div>
<div class="App-menu-elements">
    <img src="/src/images/logoLogin.jpeg" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Log In</p>
</div>
<div class="App-menu-elements">
    <img src="/src/images/registerLogo.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Register</p>
</div>
<div class="App-menu-elements">
    <img src="/src/images/searchGame.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Game</p>
</div>
<div class="App-menu-elements">
    <img src="/src/images/bannedLogo.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Banned</p>
</div>
<div class="App-menu-elements">
    <img src="/src/images/runesLogo.jpeg" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Runes</p>
</div>
<div class="App-menu-elements">
    <img src="/src/images/forumLogo2.png" alt="Image" class="App-menu-elements-img">
    <p class="App-menu-elements-text">Forum</p>
</div>
<div class="App-menu-elements">
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


                   var allContent = document.querySelectorAll('.App-content-temporal-divs');

                   $(allContent[index]).css({display : 'flex'});

                   $('.App-menu').css({display : 'none'});

                    switch(index){

                        case 1://login

                            //if is clicked reset password
                            if($('#formLoginReset').css('display') === 'flex'){

                                      $('#formLoginReset').css({display : 'none'});
                                      $('#formLogin').css({display : 'flex'});
                            }
                    }
              });
              
              
   });
</script>
