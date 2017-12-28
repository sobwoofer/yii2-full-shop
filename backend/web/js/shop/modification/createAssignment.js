$('#groupId').on('change', function () {
    $.ajax('/shop/modification-assign/get-modifications-of-group-id?id=' + this.value, {
        type: "POST",
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $('#modificationId').empty();
                $.each(data.modifications, function (key, val) {

                    $('#modificationId').append('<option value="'+key+'">'+val+'</option>');
                });
            }
        }
    });
});