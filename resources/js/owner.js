jQuery(document).ready(function($) {
    $('body').on('change', 'input:checkbox', function () {
        var table = $(this).parents('table').DataTable();
        $.ajax({
            type: "POST",
            url: "/owner/prices/hide",
            data: { priceId: $(this).data('id') },
            success: function (response) {
                table.ajax.reload(null, false);
            }
        })
    });

    $('body').on('click', 'a#priceDelete' , function(e) {
        e.preventDefault();
        var priceId = $(this).data('id');
        var table = $(this).parents('table').DataTable();
        $.ajax( {
            type: "POST",
            url: "/owner/prices/destroy",
            data: { priceId: priceId },
            success: function () {
                table.ajax.reload(null, false);
            }
        })
    })
});
