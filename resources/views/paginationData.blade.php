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
