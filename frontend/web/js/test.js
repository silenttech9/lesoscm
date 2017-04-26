
$(document).ready(function(){
     
        waitForMsg();
     
});

function addmsg(type, msg){
     
    if (msg == 0) {

        var k = 0;
         $('#havechat').html(k);


    } else {

        $('#totalChat').html(msg);
        $('#havechat').html(msg);
        
    }
    
     
}
     
function waitForMsg(){
     
$.ajax({
        type: "GET",
        url: 'total',
         
        async: true,
        cache: false,
        timeout:50000,
         
        success: function(data){
            addmsg("new", data);
            setTimeout(
            waitForMsg,
            2000
            );
        },

    });
}