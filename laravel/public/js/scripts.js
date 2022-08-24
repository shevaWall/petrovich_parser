$(document).ready(function () {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('#getCategory, #getShopItems, #getAll').on('click', function (e) {
        let btnMessage = $(e.target).data('delete-message');

        let msg = "Для продолжения будут удалены " + btnMessage + "." +
            "\nРекомендуем сделать полный backup базы данных перед продолжением";

        if (confirm(msg)) {
            $.ajax({
                type:"get",
                url: $(e.target).data('url'),
            })
            console.log($(e.target).data('url'));
        }
    });

    $('#delAll').on('click', function () {
        if (confirm("Будут удалены все категории и товары")) {
            $.ajax({
                type: "delete",
                url: "/parser/deleteAllCategoriesAndShopItems/",
                success: function (msg) {
                    console.log("всё удалено");
                }
            });
        }
    });

});
