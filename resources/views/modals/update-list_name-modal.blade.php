<div class="modal fade in" id="update-list_name-modal" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="agileinfo_sign">Update List</h3>
                </div>
                <div class="modal-body modal-body-sub_agile">
                    <div class="modal_body_left modal_body_left1">
                        <form action="" method="post" enctype="">
                            @csrf
                            <div class="styled-input agile-styled-input-top">
                                <p>List Name</p>
                                <input type="text" class="newsletter_input" placeholder="List Name" name="update_list_name" id="update_list_name" >
                                {{-- <input onfocusout="myFunction()" type="text" placeholder="Product Name" name="product_name" id="product_name" required=""> --}}
                            </div><br>
                            <div class="styled-input agile-styled-input-top">
                                <p>Remarks</p>
                                <input type="text" class="newsletter_input" placeholder="Remarks" name="update_remarks" id="update_remarks" >
                                {{-- <input onfocusout="myFunction()" type="text" placeholder="Product Name" name="product_name" id="product_name" required=""> --}}
                            </div><br>
                            <button data-dismiss="modal" id="update_list_name_btn" class="btn btn-info" type="button">Submit </button>
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        </form>
                    </div>
                </div>
            </div>
            <!-- //Modal content-->
        </div>
    </div>
    <script src="/js/import/jquery-library.js"></script>
    <script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
    <script src="/js/import/sweetalert.min.js"></script>
    
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    
    <!-- toaster notification -->
    <script type="text/javascript" src="/js/import/toastr.min.js"></script>
    <!-- toaster notification -->
    <link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/>
    <script src="/js/import/search.js"></script>
    
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Update Product
            $('#update_list_name_btn').unbind().click(function(){
                var list_id = $('#list_id_holder').val();
                var list_name = $('#update_list_name').val();
                var remarks = $('#update_remarks').val();
                swal({
                title: "Are you sure?",
                text: "Confirm to Update the Product",
                icon: "info",
                buttons: true,
                })
                .then((willUpdate) => {
                    if (willUpdate) {
                        // $(this).parent().parent().remove();
                        $.ajax({
                            type: 'POST',
                            url: '/update_list_name/'+ list_id,
                            data:{data: list_name, 
                                data1: remarks},
                            success:function(response){ 
                                console.log(response);
                                swal("Done!", "It was succesfully Updated!", "success");
                                setTimeout(location.reload(), 4000);
                            }
                        });
                    }else{
                       
                    }
                });
            });
        });
        
    </script>