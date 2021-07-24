$(function () {
    let csrf = $('meta[name="csrf-token"]').attr('content');

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/products/manage',
        columns: [
            {data: 'title', name: 'title'},
            {data: 'price', name: 'price'},
            {data: 'qty', name: 'qty'},
            {data: 'description', name: 'description'},
            {data: 'category', name: 'category'},
            {
                "mRender": function (data, type, full) {
                    let images = JSON.parse(full['images']);

                    let img_list = '';

                    if (images.length != 0) {
                        // images.map(function (key,index) {
                        img_list = '<img class="ml-1" src="/' + images[0].image + '" width="50px" height="auto"/>';
                        // });
                    } else {
                        img_list = '<img src="/assets/img/no-img.png" width="50px" height="auto"/>';
                    }

                    return img_list;
                },
            },
            {
                "mRender": function (data, type, full) {
                    let btn = '<a href="/admin/product/' + full['id'] + '/edit" class="edit btn btn-primary btn-sm p-2">Edit</a>' +
                        '<a href="/admin/products/product/delete/' + full['id'] + '" class="ml-1 delete btn btn-danger btn-sm p-2">Delete</a>';

                    return btn;


                },
            },
        ]
    });
});
