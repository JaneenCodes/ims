$(function() {

    $(document).on('click', '.create-btn', function() {
        let domainUrl = window.location.origin; 

        $('#create-form').attr('action', domainUrl + '/products/store');
        $('#create-modal').modal('show');    
    });
   
    $('#create-form').on('submit', function(e) {
        e.preventDefault();
    
        let name = $('#create-form').find('#name').val(),
            quantity = $('#create-form').find('#quantity').val(),
            price = $('#create-form').find('#price').val(),
            supplier = $('#create-form').find('#supplier').val();

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: {name, quantity, price, supplier},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#create-modal').modal('hide');
                    $.ajax({
                        url: '/products/list',
                        type: 'GET',
                        success: function(newList) {
                            $('#product-list').html(newList); 
                        },
                        error: function() {
                            alert('Error fetching updated product list.');
                        }
                    });
                } else {
                    alert('Error adding the product!');
                }
            }          
        });
    });


    $(document).on('click', '.edit-stock-btn', function(){
        let stockId = $(this).attr('data-id'),
            stockName = $(this).attr('data-name'),  
            stockQty = $(this).attr('data-quantity'),   
            domainUrl = window.location.origin

            $('#edit-stock-modal').find('#name').val(stockName);
            $('#edit-stock-modal').find('#current-qty').text(stockQty);


            if ($(this).hasClass("rsk-btn")) {
                $('#edit-stock').attr('action', domainUrl + '/products/' + stockId + '/restock');
            } else {
                $('#edit-stock').attr('action', domainUrl + '/products/' + stockId + '/deduct');
            }
            
       
        $('#edit-stock-modal').modal('show');    
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


})

