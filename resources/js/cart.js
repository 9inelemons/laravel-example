jQuery(document).ready(function ($) {
    updateSubTotalData($);

    function updateSubTotalData($) {
        var subTotal;
        $.ajax( {
           type: "POST",
           url: "/orders/new/subTotalData",
           success: function (response) {
               $('#subTotal').text(response['subTotal']);
           }
        });
    }

    function addToCart (check, eventedItem){
        if (check==='input') {

            var priceItemId = $(eventedItem).next().data('id');
            var quantityInput = $(eventedItem).parents('tr').find('input[type="number"]');
            var quantityPopup = $(eventedItem).next().children('span.quantity-popup');
            var successPopup = $(eventedItem).next().children('img.success-popup');
        } else {

        }

        $.ajax({
            type: "POST",
            url: "/orders/new/add-to-cart",
            data: { priceItemId: priceItemId, quantity: quantityInput.val()},
            success: function (response) {
                if (response['message']==='error')
                {
                    updateSubTotalData($);
                    quantityPopup.toggleClass('show');
                    setTimeout(function() {
                        quantityPopup.removeClass("show");
                    }, 3000);
                }
                else if (response['message']==='success')
                {
                    updateSubTotalData($);
                    successPopup.toggleClass('show');
                    setTimeout(function() {
                        successPopup.removeClass("show");
                    }, 3000);
                }
            },
            error: function (response) {
                quantityPopup.toggleClass('show');
                setTimeout(function() {
                    quantityPopup.removeClass("show");
                }, 3000);
            }
        });
    }

    $("body").on("keypress keyup blur", 'input[type=\'number\']', function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which !== 46 || $(this).val().indexOf('.') !== -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $("body").delegate('input[type="number"]', 'change', function() {
        addToCart('input',this);
    });

    $("body").delegate('input[type="number"]', 'keyup', function(e) {
        if (e.keyCode === 13) {
            addToCart('input', this);
        }
    });

    $('body').on('click', 'a#delete-form-cart' , function(e) {
        e.preventDefault();
        var priceItemId = $(this).data('id');
        var table = $(this).parents('table').DataTable();
        $.ajax( {
            type: "POST",
            url: "/orders/new/checkout/delete",
            data: { priceItemId: priceItemId },
            success: function (response) {
                table.ajax.reload(null, false);
                updateSubTotalData($);
            }
        })
    })
});
