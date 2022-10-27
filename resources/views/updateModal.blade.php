<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Update Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="error-message mb-3"></div>
                <form action="{{ route('add.product') }}" method="post" id="updateProductForm">
                    @csrf
                    <input type="hidden" id="update_id">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="productName">Name</label>
                                <input type="text" name="update_name" id="update_name" class="form-control" placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="productPrice">Price</label>
                                <input type="text" name="update_price" id="update_price" class="form-control" placeholder="Enter Product Price">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success update_button">Submit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
