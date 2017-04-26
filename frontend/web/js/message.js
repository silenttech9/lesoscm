$(function(){


      $('#btnchat').click(function() {


        var receiver = $('input#penerima').val();
        var chat = $('input#msgtxt').val();

          if (chat.length === 0) {
              return;
          }

          $.ajax({
              type: 'POST',
              url: 'send',
              data: {chat: chat,receiver: receiver},
              success: function()
              { 
  
              
                $('input#msgtxt').val(""); 
                location.reload();

                 
              }
          }); 

        
            
      });


        $('.msgtxt').keypress(function(e) {

          if(e.which == 13 ) {

                  var receiver = $('input#penerima').val();
                  var chat = $('input#msgtxt').val();

                    if (chat.length === 0) {
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: 'send',
                        data: {chat: chat,receiver: receiver},
                        success: function()
                        { 
            
                        
                          $('input#msgtxt').val(""); 
                          location.reload();

                           
                        }
                    }); 

            }
                      
       });




});








