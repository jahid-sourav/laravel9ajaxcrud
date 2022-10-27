<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function(){
        // Error Clear
        function clearError() {
            $('.error-message').html(' ')
        }
        //Add Product
        $(document).on('click','.add_button',function (e) {
            e.preventDefault();
            let name = $('#productName').val();
            let price = $('#productPrice').val();
            // console.log(name+price);
            $.ajax({
                url : "{{ route('add.product') }}",
                method : 'post',
                data : {name:name,price:price},
                success:function (res) {
                    if(res.status == 'success'){
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        Command: toastr["success"]("Product Added", "Success")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },error:function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors,function (index, value) {
                        $('.error-message').append('<span class="d-block text-danger fw-bold">'+value+'</span>');
                    });
                },
            });
            clearError();
        });
        //Show Product Value
        $(document).on('click','.update-product-form',function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            $('#update_id').val(id);
            $('#update_name').val(name);
            $('#update_price').val(price);
        });
        //Update Product
        $(document).on('click','.update_button',function (e) {
            e.preventDefault();
            let update_id = $('#update_id').val();
            let update_name = $('#update_name').val();
            let update_price = $('#update_price').val();
            $.ajax({
                url : "{{ route('update.product') }}",
                method : 'post',
                data : {update_id:update_id,update_name:update_name,update_price:update_price},
                success:function (res) {
                    if(res.status == 'success'){
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        Command: toastr["success"]("Product Updated", "Success")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },error:function (err) {
                    let error = err.responseJSON;
                    $.each(error.errors,function (index, value) {
                        $('.error-message').append('<span class="d-block text-danger fw-bold">'+value+'</span>');
                    });
                }
            });
            clearError();
        });
        //Delete Product
        $(document).on('click','.delete_button',function (e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            if(confirm('Are you sure to delete?')){
                $.ajax({
                        url : "{{ route('delete.product') }}",
                        method : 'post',
                        data : {product_id:product_id},
                        success:function (res) {
                            if(res.status == 'success'){
                                $('.table').load(location.href+' .table');
                                Command: toastr["success"]("Product Deleted", "Success")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                            }
                        }
                });
            }
        });
        //Pagination
        $(document).on('click','.pagination a',function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            data(page);
        });
        function data(page) {
            $.ajax({
                url:"/pagination/paginate-data?page="+page,
                success:function (res) {
                    $('.table-data').html(res);
                }
            });
        }
        //Search
        $(document).on('keyup',function (e) {
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url:"{{ route('search.product') }}",
                method:'GET',
                data:{search_string:search_string},
                success:function (res) {
                    $('.table-data').html(res);
                    if(res.status=='nothing_found'){
                        $('.table-data').html('<p class="text-center fw-bold text-danger">'+'Nothing Found'+'</p>')
                    }
                }
            });
        });
    });
</script>
