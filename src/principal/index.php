<?php

?>
<div class="App">
    <script type="text/javascript">
    </script>
    <div class="App-header">
        <div class="App-header-elements">
            <div class="App-header-elements-inside">
                <div class="App-header-elements-inside-div-MenuButton">
                    <img src="/src/images/menuImg.png" alt="Click menu button" class="App-header-elements-inside-div-imgButtonmenu">
                </div>
            </div>
            <div class="App-header-elements-inside">
                <div class="App-header-elements-inside-div-Logo">
                    <img src="/src/images/leagueOfLegends.png" alt="Click logo" class="App-header-elements-inside-div-imgLogo">
                </div>
            </div>
            <div class="App-header-elements-inside">
                <div class="App-header-elements-inside-div-blocked">
                    <div class="App-header-elements-inside-div-blockedDivImg">
                        <img class="App-header-elements-inside-div-imgBlocked" src="/src/images/blockedPng.png" alt="Image">
                    </div>
                    <div class="App-header-elements-inside-div-blockedDivText">
                        <input type="button" value="Log In" class="App-header-elements-inside-div-blockedDivTextP">
                    </div>
                    <div class="App-header-elements-inside-div-blockedDivImg" id="App-header-elements-inside-div-imgCloseSession" style="display: none;">
                        <img id="imgCloseSession" class="App-header-elements-inside-div-imgCloseSession" src="/src/images/closeSessionNew.jpg" alt="Image">
                    </div>
                    <script type="text/javascript">
                       $('.App-header-elements-inside-div-blockedDivTextP').on('click', function(){

                            var textVerifiedLogin = $(this).val();

                            if(textVerifiedLogin.toString().indexOf("Log In") > -1 && $('.App-header-elements-inside-div-imgBlocked').prop('src').indexOf('blockedPng') > -1){

                                var clickLoginElementHeader = document.querySelector('.App-menu-elements-login');
                            
                                if($('#formLoginReset').css('display') === 'flex'){

                                    $('#formLoginReset').css({display : 'none'});
                                    $('#formLogin').css({display : 'flex'});
                                }

                                $(clickLoginElementHeader).click();
                            
                            }else{

                                 var clickLoginElementHeader = document.querySelector('.App-menu-elements-account');

                                 $(clickLoginElementHeader).click();
                            }
                       });


                       $('#imgCloseSession').on('click', function(){



                             function getAnswerCloseSession(){

                                 return new Promise(function(resolve, reject){


                                        var xhr = new XMLHttpRequest();
                                        xhr.open('GET', './src/bot/closeSession.php?cache=123', true);
                                        xhr.timeout = 30000;
                                        xhr.onload = function(){

                                            if(xhr.readyState == 4 && xhr.status == 200){

                                                 setTimeout(() => {
                                                     resolve(xhr.responseText);
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
                                                reject('An ocurred an error!Try again!');
                                            }, 2000);
                                        }

                                        xhr.send(null);
                                 });
                             }


                             async function afterGetAnswerCloseSession(){

                                    //show loading
                                    $('.divCenter').css({
                                      display : 'flex',
                                      backgroundImage : 'url(/src/images/loading.gif)'
                                    });
                                  //and hidden content from divcenter because is only loading
                                  $('.insideDivCenter').css({display : 'none'});
                                  $('#insideDivCenterClose').css({display : 'none'});

                                  var result = await getAnswerCloseSession();
                                  return result;
                             }


                             afterGetAnswerCloseSession().then(function(resolve){
                                 
                                 window.location.reload();

                             }, function(reject){

                                   $('.divCenter').css({backgroundImage : 'none'});
                                   $('.insideDivCenter').css({display : 'flex'});
                                   $('#insideDivCenterClose').css({display : 'flex'});
                                   $('.insideDivCenterImg').prop('src', './src/images/errorDivcenter.png');
                                   $('.insideDivCenterText').text(reject);
                             });
                       });


                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="App-content">
        <div class="App-menu"></div>
        <script type="text/javascript">
           $('.App-header-elements-inside-div-MenuButton').on('click', function(){
               if($('.App-menu').css('display') === 'none'){

                     $('.App-menu').css({display : 'flex'});
               
                }else{

                    $('.App-menu').css({display : 'none'});
                }
           });
        </script>
        <div class="App-content-temporal">
          <div id="App-content-temporal-chat" class="App-content-temporal-divs App-content-temporal-chat">
            <script type="text/javascript" defer async>
               function getCodeChatPrincipal(){

                 return new Promise(function(resolve, reject){

                      var xhr = new XMLHttpRequest();
                      xhr.open('GET', './src/bot/principalChat', true);
                      xhr.onload = function(){

                           if(xhr.readyState == 4 && xhr.status == 200){

                                setTimeout(() => {
                                    resolve(xhr.responseText);
                                }, 10);
                           
                            }else{

                                setTimeout(() => {
                                    reject({readyStateError : this.readyState, StatusError : this.status});
                                }, 10);
                            }
                      }

                      xhr.onerror = function(){

                         setTimeout(() => {
                                reject({readyStateError : this.readyState, StatusError : this.status});
                             
                         }, 10);
                      }


                      xhr.ontimeout = function(){

                        setTimeout(() => {
                            reject({readyStateError : this.readyState, StatusError : this.status});
                        }, 10);
                      }


                      xhr.send(null);
                 });


               }


               async function afterGetCodePrincipalChat(){

                 var result = await getCodeChatPrincipal();
                 return result;
               }

               setInterval(() => {
               afterGetCodePrincipalChat().then(function(resolve){
                   $('#imgLoadingChat').remove();
                  $('.App-content-temporal-chat').html(resolve);
               }, function(reject){
                  $('.App-content-temporal-chat').html('<h1>An ocuured an error</h1>');
               });
           }, 2000);
               

            </script>
            </div>
        </div>
    </div>
    <div class="App-footer">
        <div class="App-footerElements">
            <input type="button" value="????" class="App-footerElements-input">
            <input type="button" value="&#128515;" class="App-footerElements-input">
            <textarea class="App-footerElements-textarea" placeholder="Tell us something"></textarea>
            <input type="button" value="&#10148;" class="App-footerElements-input">
            <script type="text/javascript">
               $('.App-footerElements-textarea').on('input',function(){
                    
                     if(this.scrollHeight < (16 * 6)){
                        this.style.height = 'auto';
                        this.style.height = this.scrollHeight + 'px';

                     }
               });
            </script>
        </div>
    </div>
</div>