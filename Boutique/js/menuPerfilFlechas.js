   function showMenu(e){
          e.preventDefault();
          $("#menu").slideToggle();
          $(".rotate").toggleClass("down"); 
      }

      function hideMenu(){
          $("#menu").slideUp();
      }

