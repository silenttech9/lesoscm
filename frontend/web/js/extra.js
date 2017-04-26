$(function(){
    
    $('.create').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });

    $('.update').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });

    $('.view').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });

    $('.showBg').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });



    $('.show').click(function(e, value, row){
        $('#modalsm').modal('show')
        .find('#modalContentsm')
        .load($(this).attr('value'));

    });

    $('.uploadExcel').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });

    $('.changestatus').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });

    $('#model_selangor').on("input", function() {
      var dInput = $(this).val(); 
      //console.log(dInput);
      $('#model_johor').val(dInput);
      $('#model_penang').val(dInput);

    });



    // quoation
    if ($('#qt-tender').is(':checked')) {
        $(".tender-temp").show();
    } else {
        $(".tender-temp").hide();
    }


    $('#qt-tender').click(function(){
        if($(this).is(':checked')){
            $(".tender-temp").show();  // checked
        }else {

            $(".tender-temp").hide();
            $("#qt-drop-tender option:selected").removeAttr("selected");
     
        }

    });

    $('#qt-customer').on('change', function() {
        var v = $(this).val();

          $.ajax({
               url: 'address',
               data: {id: v},
               success: function(data) {
             
                    $(".address-quotation-info").show();
                    $(".address-quotation-info").html(data);
                    $(".not-complete").hide();
                    $(".pic-info").hide();
                    //$("select#sales").html(data);

                   // process data
               }
            });
      
    });

    $('#qt-customer').on('change', function() {
        var v = $(this).val();

          $.ajax({
               url: 'sale',
               data: {id: v},
               success: function(data) {
             
                    $(".sale-quotation-info").show();
                    $(".sale-quotation-info").html(data);
                    //$("select#sales").html(data);

                   // process data
               }
            });
      
    });


    $('#qt-customer').on('change', function() {

        var v = $(this).val();

          $.ajax({
               url: 'stax',
               data: {id: v},
               success: function(data) {
              
                    $(".tax-quotation-info").show();
                    $(".tax-quotation-info").html(data);
               }
            });
      
    });

    $('#qt-customer').on('change', function() {

        var v = $(this).val();

          $.ajax({
               url: 'area',
               data: {id: v},
               success: function(data) {
              
                    $(".area-quotation-info").show();
                    $(".area-quotation-info").html(data);
               }
            });
      
    });




    $('.searchGlobal').keypress(function(e) {

      if(e.which == 13 ) {

        var v = $(this).val();
        $.ajax({
               url: 'all',
               data: {id: v},
  
               success: function(data) {
            
                  if (data == "" || data == "No Data") {
                   
                      $("#stockDiv").hide();
                  } else {

                      $("#stockDiv").show();
                      $("#stock-show").html(data);
                  }
               }
        });
      }
      
    }); 

    $('#goStock').click(function(e) {

        var v = $('#searchGlobal').val();
        $.ajax({
               url: 'all',
               data: {id: v},
  
               success: function(data) {
            
                  if (data == "" || data == "No Data") {
                   
                      $("#stockDiv").hide();
                  } else {

                      $("#stockDiv").show();
                      $("#stock-show").html(data);
                  }
 
               }
        });
      
    }); 

    $('.showDiscount').click(function(){
        $('#modalsm').modal('show')
        .find('#modalContentsm')
        .load($(this).attr('value'));

    });

    $('.picdetail').on('change', function() {

        var v = $(this).val();
        $.ajax({
               
               url: 'pic',
               data: {id: v}, 
               success: function(data) {
                    if (data == 'not complete') {
                      $('.not-complete').show();
                      $(".pic-info").hide();
                      $('.picnotcomplete').attr('disabled','disabled');
                    }
                    else{
                      $(".pic-info").show();

                      $('.not-complete').hide();
                      $('.pic-info').html(data);
                      $('.picnotcomplete').removeAttr('disabled');

                      $('.boxpic').hide();
                      $('.boxemail').hide();
                      $('#customer-country_code_phone').prop('disabled',true);
                      $('.area_code_phone').prop('disabled',true);
                      $('.telephone_no').prop('disabled',true);
                      $('.email').prop('disabled',true);
                    }
                    
                   // process data
               }
        });
      
    });



    $('#email').keyup(function() {
        if($(this).val() != '') {
           // $('.picnotcomplete').removeAttr('disabled');
           $('.picnotcomplete').prop('disabled',false);
        }
        if($(this).val() == '') {
           // $('.picnotcomplete').removeAttr('disabled');
          $('.picnotcomplete').prop('disabled',true);
        }
     });

    $('#email_comp').keyup(function() {
        if($(this).val() != '') {
           // $('.picnotcomplete').removeAttr('disabled');
          $('.picnotcomplete').prop('disabled',false);
        }

        if($(this).val() == '') {
           // $('.picnotcomplete').removeAttr('disabled');
          $('.picnotcomplete').prop('disabled',true);
        }
     });

    $('.editpic').click(function(){
        $('.boxpic').show();
        $('.boxemail').show();
        $('.savequote').show();
        $('#customer-country_code_phone').prop('disabled',false);
        $('.area_code_phone').prop('disabled',false);
        $('.telephone_no').prop('disabled',false);
        $('.email').prop('disabled',false);
    });

    $('.company_edit').click(function(){
        $('.boxcompany').show();
        $('.boxemail_company').show();
        $('.savequote').show();
        $('#customer-comp_country_code_phone').prop('disabled',false);
        $('.cust_area_code_phone').prop('disabled',false);
        $('.cust_telephone_no').prop('disabled',false);
        $('.email_comp').prop('disabled',false);
    });

    $('.checkpic').on('change', function() {

        var v = $(this).val();
        
          $.ajax({
               url: 'checkpic',
               data: {id: v},
               success: function(data) {
                    if (data == 'exist') {
                        $(".checkpicexist").hide();
                        $(".quote").show();
                         $('.addmorepic').show();
                        $('.linkcomp_not_complete').hide();
                        // $(".company-info").hide();
                        // $(".checkpicexist").html(data);
                    }
                    else{
                        $(".checkpicexist").show();
                        $(".quote").hide();
                        $(".checkpicexist").html(data);
                        $('.linkcomp_not_complete').hide();
                        $(".company-info").hide();
                         $('.addmorepic').hide();
                        $('.boxcompany').hide();
                        $('.boxemail_company').hide();
                        $('#customer-comp_country_code_phone').prop('disabled',true);
                        $('.cust_area_code_phone').prop('disabled',true);
                        $('.cust_telephone_no').prop('disabled',true);
                        $('.email_comp').prop('disabled',true);
                    }
                    
               }
            });
      
    });

    $('.checkpic').on('change', function() {

        var v = $(this).val();
          $.ajax({
               url: 'checkemail',
               data: {id: v},
               success: function(data) {
                    if (data == 'not complete') {
                      $('.companynot-complete').show();
                      $('.linkcomp_not_complete').show();
                      $(".company-info").hide();
                      $(".savequote").hide();
                      $('.picnotcomplete').attr('disabled','disabled');
                    }
                    else{
                      $(".company-info").show();
                      $('.companynot-complete').hide();
                      $('.company-info').html(data);
                      $('.picnotcomplete').removeAttr('disabled');

                      $('.boxcompany').hide();
                      $('.boxemail_company').hide();
                      $('#customer-comp_country_code_phone').prop('disabled',true);
                      $('.cust_area_code_phone').prop('disabled',true);
                      $('.cust_telephone_no').prop('disabled',true);
                      $('.email_comp').prop('disabled',true);
                    }
               }
            });
      
    });
    /* telemarketing */
    $('.customerCreate').click(function(){
      $("#show-customer").show();

    });


    $('.customerLog').click(function(){
        $('#full').modal('show')
        .find('.xxx')
        .load($(this).attr('value'));

    });

if($('#telemarketing-customer-reminder').is(":checked"))  {
        $("#telemarketing-reminder").show(); 
    } else{
        $('#telemarketingcustomer-datetime, #telemarketingcustomer-remark_reminder').val('');
        $("#telemarketing-reminder").hide();
    }


$('#telemarketing-customer-reminder').click(function(){
        if($(this).is(':checked'))
        {
            $("#telemarketing-reminder").show();  // checked

        }else {
            $('#telemarketingcustomer-datetime, #telemarketingcustomer-remark_reminder').val('');
            $("#telemarketing-reminder").hide();  // unchecked

        }

    });


    if($('#telemarketingcustomer-sales_visit').is(":checked"))  {
        $("#sales-visit").show(); 
    } else{
        $('#telemarketingcustomer-sales_visit_date,#telemarketingcustomer-sales_visit_information').val('');
         $("#sales-visit").hide(); 
    }


    $('#telemarketingcustomer-sales_visit').click(function(){
        if($(this).is(':checked')){
            $("#sales-visit").show();  // checked

        }else {
            $('#telemarketingcustomer-sales_visit_date,#telemarketingcustomer-sales_visit_information').val('');
            //selangortelemarketing-sales_specialist_id
            $("#sales-visit").hide();  // unchecked

        }

    });

    if($('#telemarketingcustomer-quotation').is(":checked"))  {
        $("#quotation-info").show(); 
    } else{
        $('#telemarketingcustomer-remark').val('');  
         $("#quotation-info").hide(); 
    }


    $('#telemarketingcustomer-quotation').click(function(){
        if($(this).is(':checked')){
            $("#quotation-info").show();  // checked

        }else {
            $('#telemarketingcustomer-remark').val('');
            $("#quotation-info").hide();  // unchecked

        }

    });

    //telemarketing
    $('#ship_to').on('change', function() {

        var v = $(this).val();
        $.ajax({
               url: 'pic',
               data: {id: v},
               success: function(data) {
              
                    $(".show-pic-details").show();
                    $('.pic-details').html(data);
                   // process data
               }
        });
      
    });


/* sales activity */


    $('#salesactivity-customer_id').on('change', function() {
        var v = $(this).val();

        $.ajax({
               url: 'address',
               data: {id: v},
               success: function(data) {
             
                    $(".address-saleactivity-info").show();
                    $(".address-saleactivity-info").html(data);

               }
        });
      
    });



  $('.activityCreate').click(function(){
      $("#show-activity").show();

    });

if($('#activity-customer-reminder').is(":checked"))  {
        $("#activity-reminder").show(); 
    } else{
        $('#salesactivitylog-reminder_time, #salesactivitylog-reminder_remark').val('');
        $("#activity-reminder").hide();
    }


$('#activity-customer-reminder').click(function(){
        if($(this).is(':checked'))
        {
            $("#activity-reminder").show();  // checked

        }else {
            $('#salesactivitylog-reminder_time, #salesactivitylog-reminder_remark').val('');
            $("#activity-reminder").hide();  // unchecked

        }

    });



    if($('#salesactivitylog-sales_visit').is(":checked"))  {
        $("#activity-visit").show(); 
    } else{
        $('#salesactivitylog-sales_visit_date,#salesactivitylog-sales_visit_information').val('');
         $("#activity-visit").hide(); 
    }


    $('#salesactivitylog-sales_visit').click(function(){
        if($(this).is(':checked')){
            $("#activity-visit").show();  // checked

        }else {
        $('#salesactivitylog-sales_visit_date,#salesactivitylog-sales_visit_information').val('');
            //selangortelemarketing-sales_specialist_id
            $("#activity-visit").hide();  // unchecked

        }

    });

    if($('#salesactivitylog-quotation').is(":checked"))  {
        $("#activity-info").show(); 
    } else{
        $('#salesactivitylog-remark').val('');  
         $("#activity-info").hide(); 
    }


    $('#salesactivitylog-quotation').click(function(){
        if($(this).is(':checked')){
            $("#activity-info").show();  // checked

        }else {
            $('#salesactivitylog-remark').val('');  
            $("#activity-info").hide();  // unchecked

        }

    });


    $('.activityView').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });

    $('.activityUpdate').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });


    $('#ship_to_activity').on('change', function() {

        var v = $(this).val();
        $.ajax({
               url: 'salepic',
               data: {id: v},
               success: function(data) {
              
                    $(".show-pic-activity").show();
                    $('.pic-activity').html(data);
                   // process data
               }
        });
      
    });





    /* customer */


    $('.picCreate').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });
    $('.picUpdate').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });
    $('.picView').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));

    });


    
    $('#customer-country_code_phone').on('change', function() {

        var v = $(this).val();

          $.ajax({
               url: 'country',
               data: {id: v},
               success: function(data) {
      
                    $('.country-info').html(data);
                   // process data
               }
            });
      
    });



    $("#searchTry").keyup(function() {


    var render_state = $('#render_state').attr('class');


    if (render_state == 13) {
            var searchid = $(this).val();
          if(searchid!='') {
            $.ajax({ 
              url: 'searchs',
              data: {id : searchid},
              cache: false,
              success: function(html) {
                
               $("#resultDiv").show();
                $("#result").html(html).show();
              }
            });
          } 

    } else if (render_state == 23) {

            var searchid = $(this).val();
          if(searchid!='') {
            $.ajax({ 
              url: 'searchp',
              data: {id : searchid},
              cache: false,
              success: function(html) {
                
               $("#resultDiv").show();
                $("#result").html(html).show();
              }
            });
          } 




    } else if (render_state == 22) {


            var searchid = $(this).val();
          if(searchid!='') {
            $.ajax({ 
              url: 'searchj',
              data: {id : searchid},
              cache: false,
              success: function(html) {
                
               $("#resultDiv").show();
                $("#result").html(html).show();
              }
            });
          } 
    }  else if (render_state == 3) {


            var searchid = $(this).val();
          if(searchid!='') {
            $.ajax({ 
              url: 'searcht',
              data: {id : searchid},
              cache: false,
              success: function(html) {
                
               $("#resultDiv").show();
                $("#result").html(html).show();
              }
            });
          } 
    }


    return false;
      
    });



    $('#goQuotation').click(function(e) {


      var qty = $('#quotation-searching').val();
      var mdl = $('#moduleQ').val();

        $.ajax({
          type: 'POST',
          url: 'item',
          data: {id: qty,module: mdl},

          success: function(data) {
        
              if (data == "" || data == "No Data") {
               
                  $("#itemDiv").hide();
              } else {

                  $("#itemDiv").show();
                  $("#item-show").html(data);
              }

    

           }

          })

    });

    $('.searchQt').keypress(function(e) {

      if(e.which == 13 ) {

        var v = $(this).val();
        var mdl = $('#moduleQ').val();

        $.ajax({
                type: 'POST',
               url: 'item',
               data: {id: v,module: mdl},
  
               success: function(data) {
            
                  if (data == "" || data == "No Data") {
                   
                      $("#itemDiv").hide();
                  } else {

                      $("#itemDiv").show();
                      $("#item-show").html(data);
                  }
 
        

               }
        });
      }

      
    }); 

    $('.msgfrm').click(function(){


      var idmsgfrm = $(this).attr('id');

      $.ajax({
          type: 'POST',
          url: 'return',
          data: {id: idmsgfrm},
          success: function()
          { 

   
          }
      })

    });


    $("#addmorewife").click(function(){
        var clone = $("#wife").clone();
        clone.find("input[type=text]").val("");
        clone.appendTo(".adddivwife");
        $('div#del').not(':first').show();
    });

    $(".adddivwife").on("click", "#remove", function(e) {
        e.preventDefault(); 
       $(this).closest("#wife").remove();  
    });



    $('#goInvoice').click(function(e) {


      var serial = $('#serial').val();
      var invoice = $('#invoice').val();
      var state = $('#state').val();

        $.ajax({
            type: 'POST',
            url: 'return',
            data: {vals: serial,vali: invoice,state: state},
              success: function(html) {
                
      
                $(".showinfo").html(html).show();
              }



          })

    });

    $('#ship_to_warranty').on('change', function() {

        var v = $(this).val();
        $.ajax({
               url: 'warrantypic',
               data: {id: v},
               success: function(data) {
              
                    $(".show-pic-warranty").show();
                    $('.pic-warranty').html(data);
                   // process data
               }
        });
      
    });





});