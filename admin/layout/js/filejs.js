/*
   var emyInput = rootElement.getElementsByClassName(input);

   myInput.onblur = showPlaceholder;
   myInput.onfocus = hidePlaceholder;
   
   function hidePlaceholder(){
       // store placeholder value in backup attribute
       this.setAt('backup',this.getAttribute('placeholder') );
       
       // empty placeholder value
       this.setAttribute('placeholder','');
   }
   
   function showPlaceholder(){
       // get placeholder value from backup attribute
       this.setAttribute('placeholder',this.getAttribute('backup') );
   
       // empty backup attribute
       this.setAttribute('backup','');
   }
   */
  $(function () {
    'use strict';
     //hide palceholder
     $('[placeholder]').focus(function () {
     
     $(this).attr('data-text', $(this).attr('placeholder'));
     $(this).attr('placeholder', '');
     }).blur(function (){
     $(this).attr('placeholder',$(this).attr('data-text'));

     });


     $('.confirm').click(function()
     {
            return confirm ('are you sure?');

     });
   }); 
   