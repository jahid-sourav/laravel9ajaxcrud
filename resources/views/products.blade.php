<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products - Ajax CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>
<body>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h4 class="text-center mb-4">Laravel 9 AJAX CRUD</h4>
                <div class="my-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        Add Product
                    </button>
                </div>
                <div class="mb-3">
                    <input type="text" name="search" id="search" class="form-control shadow-none" placeholder="Search Here">
                </div>
                <div class="table-data">
                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key=>$product)
                        <tr>
                            <th>{{ $key+1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="javascript:void(0)" class="me-2 btn btn-success update-product-form" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                                    <i class="las la-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger delete_button" data-id="{{ $product->id }}">
                                    <i class="las la-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@include('addModal')
@include('updateModal')
@include('product_js')
{!! Toastr::message() !!}
</body>
</html>
