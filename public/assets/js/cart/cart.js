$(function () {
    let csrf = $('meta[name="csrf-token"]').attr('content');

    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: 'update-cart',
            method: "patch",
            data: {
                _token: csrf,
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").on('click',function (e) {
        e.preventDefault();
        console.log('asdasd');
        var ele = $(this);
        if (confirm("Are you sure want to remove?")) {
            $.ajax({
                url: 'remove-from-cart',
                method: "DELETE",
                data: {
                    _token: csrf,
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
});
