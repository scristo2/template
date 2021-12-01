<div class="divCenter">
    <div id="insideDivCenterClose"><img id="imgCloseDivCenter" class="closeWindowImg" src="./src/images/closeWindow.jpg" alt="Image close window"></div>
    <script type="text/javascript" defer async>
       $('#imgCloseDivCenter').on('click', function(){
           $('.divCenter').css({display : 'none'});
           //check button register disabled
           $('#App-content-temporal-register-form-input-submit').prop('disabled', false);
           $('#App-content-temporal-login-form-input-submit').prop('disabled', false);
           $('#App-content-temporal-login-form-reset-input-submit').prop('disabled', false);
           //recuperate .App opacity
           $('.App').css({'opacity' : 'initial'});
       });
    </script>
    <div class="insideDivCenter" id="insideDivCenter">
        <img  alt="Image info" class="insideDivCenterImg">
        <p class="insideDivCenterText"></p>
    </div>
</div>