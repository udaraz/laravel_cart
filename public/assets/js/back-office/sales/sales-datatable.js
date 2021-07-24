$(function () {
    let csrf = $('meta[name="csrf-token"]').attr('content');

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/orders',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'order_date', name: 'order_date'},
            {
                "mRender": function (data, type, full) {
                    return '$'+full['total'];
                },
            },
            {data: 'user.name', name: 'user.name'},
            {data: 'billing.address', name: 'billing.address'},
            {data: 'billing.country', name: 'billing.country'},
            {data: 'billing.province', name: 'billing.province'},
            {data: 'billing.zip', name: 'billing.zip'},
            {
                "mRender": function (data, type, full) {
                    let btn = '<a target="_blank" href="/admin/order/' + full['id'] +'" class="edit btn btn-success btn-sm">View</a>';

                    return btn;
                },
            },
        ]
    });
});
