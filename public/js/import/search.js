$('#search_product_side').keyup( function(){
    var query = $(this).val();
    if(query != ''){
        $.ajax({
            url: "/search_product/fetch",
            method: "POST",
            data: {query:query},
            success:function(data)
            {
                $('#product_list').fadeIn().html(data.output);
                $(document).on('click', '#searched_prod_name li a', function(){
                    $('#search_product_side').val($(this).text());
                    $('#search_product_list').fadeOut();
                });
            }
        });
    }else{
        $('#search_product_list').html("").fadeOut();
    }
});

$('#product_name').keyup( function(e){
    e.preventDefault();
    var query = $(this).val();
    if(query != ''){
        $.ajax({
            url: "/product_name/fetch",
            method: "POST",
            data: {query:query},
            success:function(data)
            {
                $('#product_list').fadeIn().html(data.output);
                $(document).on('click', '#searched_prod_name li a', function(){
                    $('#product_name').val($(this).text());
                    $('#product_list').fadeOut();
                });
            }
        });
       
    }else{
        $('#product_list').html("").fadeOut();
    }
});


$('#store_name').keyup( function(){
    // $('#store_name').focusout(function(){
    //     $('#store_list').fadeOut();
    // });
    var query = $(this).val();
    if(query != ''){
        $.ajax({
            url: "/store_name/fetch",
            method: "POST",
            data: {query:query},
            success:function(data)
            {
                $('#store_list').fadeIn().html(data.output);
                $(document).on('click', '#searched_store_item li a', function(){
                    $('#store_name').val($(this).text());
                    $('#store_list').fadeOut();
                });
                // $('#store_name').focusout(function(){
                //     $('#store_list').html("").fadeOut();
                // });
            }
        });
    }else{
        $('#store_list').html("").fadeOut();
    }
});

