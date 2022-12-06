
 
     $('#contactForm').on('submit',function(event){
      event.preventDefault();
        var category_name = $('.category_name' ).val();
        var slug_category_product = $('.slug_category_product' ).val();
        var category_desc = $('.category_desc' ).val();
        var category_status = $('.category_status') .val();
        var meta_keywords = $('.meta_keywords' ).val();
      
        $.ajax({
          url: '{{url('/save-category')}}',
          method: 'POST',
          data:{
            "_token": "{{ csrf_token() }}",
            category_name:category_name,
            slug_category_product:slug_category_product,
            category_desc:category_desc,
            meta_keywords:meta_keywords,
            category_status:category_status
          },
          success:function(response){
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
     
            document.getElementById("contactForm").reset();
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },4000);
          },
         
         });
         
          
           
      });
   
