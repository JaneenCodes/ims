$(function() {

    $(document).on('click', '.create-btn', function() {
        let domainUrl = window.location.origin; 

        $('#create-form').attr('action', domainUrl + '/products/store');
        $('#create-modal').modal('show');    
    });

    $('#create-form').on('submit', function(e) {
        e.preventDefault(); 

        let formData = new FormData(this); 

        $.ajax({
            url: $(this).attr('action'),  
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#create-modal').modal('hide');
                  
                    window.location.href = '{{ route('+products.index+') }}'; 
                } else {
                    alert('Error adding the product!');
                }
            }
        });
    });


    $(document).on('click', '.delete-btn', function () {
        let url = $(this).data('url'),
            postObj = $(this).closest('.product-list'); 
    
        $.ajax({
            url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {  
                postObj.fadeOut("slow", function () { $(this).remove(); }); 
            }
        });       
    });



    $(document).on('click', '.edit-btn', function () {
        let productId = $(this).attr('data-id'),
            productName = $(this).attr('data-name'),
            productPrice = $(this).attr('data-price'),
            productQty = $(this).attr('data-quantity'),
            productSupplier = $(this).attr('data-supplier'),
            domainUrl = window.location.origin;

            $('#edit-form').attr('action', domainUrl +'/products/' + productId+ '/update')

            $('#edit-modal').find('#name').val(productName);
            $('#edit-modal').find('#quantity').val(productQty);
            $('#edit-modal').find('#price').val(productPrice);
            $('#edit-modal').find('#supplier').val(productSupplier);

            $('#edit-modal').modal('show');
    });

})

