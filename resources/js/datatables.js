jQuery(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.extend( true, $.fn.DataTable.defaults, {
        "oLanguage": {
            "sInfoEmpty": 'Нет записей по данному запросу',
            "sInfo": "Показаны записи с _START_ по _END_ из _TOTAL_",
            "oPaginate": {
                "sNext": "Следующая страница",
                "sPrevious": "Предыдущая страница"
            },
            "sLengthMenu": "Показать _MENU_ записей",
            "sProcessing": "Загрузка данных...",
            "sSearch": "Найти: "
        },
        "language": {
            "emptyTable": "Нет записей по данному запросу"
        }
    } );
    $('#owner-prices-table').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: $('#owner-prices-table').data('ajax-url'),
        columns: [
            { data: "name", name: "name"},
            { data: 'hidden', name: 'hidden', orderable: false},
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });
    $('#owner-price-items-table').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: $('#owner-price-items-table').data('ajax-url'),
        columns: [
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name'},
            { data: 'measure', name: 'measure' },
            { data: 'price', name: 'price' },
        ],
    });
    $('#organizations-table').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: $('#organizations-table').data('ajax-url'),
        columns: [
            { data: "organization", name: "organization"},
            { data: "description", name: "description"}
        ],
    });
    $('#buyer-prices-table').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: $('#buyer-prices-table').data('ajax-url'),
        columns: [
            { data: "name", name: "name"}
        ],
    });
    $('#buyer-price-items-table').DataTable( {
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: $('#buyer-price-items-table').data('ajax-url'),
        columns: [
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name'},
            { data: 'measure', name: 'measure' },
            { data: 'price', name: 'price' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });

    $('#checkout-price-items-table').DataTable( {
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: $('#checkout-price-items-table').data('ajax-url'),
        columns: [
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name'},
            { data: 'measure', name: 'measure' },
            { data: 'price', name: 'price' },
            { data: 'quantity', name: 'quantity'},
            { data: 'action', name: 'action', orderable: false, searchable: false},

        ],
    });

    $('#orders-table').DataTable({
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: $('#orders-table').data('ajax-url'),
        columns: [
            { data: "id", name: "id"},
            { data: 'created_at', name: "created_at" },
            { data: 'subtotal', name: 'subtotal' },
            { data: 'sender', name: 'sender'},
            { data: 'state', name: 'state' }
        ],
    });

    $('#order-price-items-table').DataTable( {
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        processing: true,
        serverSide: true,
        ajax: $('#order-price-items-table').data('ajax-url'),
        columns: [
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name'},
            { data: 'measure', name: 'measure' },
            { data: 'price', name: 'price' },
            { data: 'quantity', name: 'quantity'},

        ],
    });

    $('body').delegate('input[type=number]', 'keydown', function(e) {
        if(e.keyCode===38){
            e.preventDefault();
            $(this).closest('tr').prev().find('input[type=number]').focus();
        } else if(e.keyCode===40){
            e.preventDefault();
            $(this).closest('tr').next().find('input[type=number]').focus();
        }

    });
});
