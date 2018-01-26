$("#deliveryform-method").on('click', function() {
    $.pjax.reload({container: '#deliveryPjaxSection', async: false, data: { delivery_id: $(this, 'option:selected').val()}}, );
});


var cart = {
    'add': function (product_id, quantity) {
        $.ajax({
            url: 'shop/cart/add',
            type: 'post',
            data: {}
        });
    },
    'remove': function (id) {
        $.ajax({
            url: '/shop/cart/remove?id=' + id,
            type: 'post',
            data: {_format: 'json'},
            async: false,
            dataType: 'application/json',
            beforeSend: function() {
                console.log('loading');
            },
            success: function(json) {
                console.log('success');
                updateCartSection();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }

        });
    },
    'removeModification': function (id, itemId) {
        console.log(id);
        console.log(itemId);
        $.ajax({
            url: '/shop/cart/remove-modification?id=' + id + '&item_id=' + itemId,
            type: 'post',
            data: {_format: 'json'},
            async: false,
            dataType: 'application/json',
            beforeSend: function() {
                console.log('loading');
            },
            success: function(json) {
                console.log('success');
                updateCartSection();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }

        });
    },
    'quantity': function (id, quantity) {
        $.ajax({
            url: '/shop/cart/quantity?id=' + id,
            type: 'post',
            data: {quantity: quantity, _format: 'json'},
            async: false,
            dataType: 'json',
            beforeSend: function() {
                console.log('loading');
            },
            success: function(json) {
                console.log('success');
                updateCartSection();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }

        });
    },
};


function updateCartSection() {
    $.pjax.reload({container: '#cartPjaxSection', async: false});
}


// ready scripts
$(function () {
    pjaxSuccessScripts()


});

$(document).on('pjax:success', function(){
    pjaxSuccessScripts()
});

//update after reload pjax
function pjaxSuccessScripts() {

//prevent default update quantity
    $('.quantity-form').submit(function (e) {
        e.preventDefault();
        var id = $('input[name="id"]', e.currentTarget).val();
        var quantity = $('input[name="quantity"]', e.currentTarget).val();

        cart.quantity(id, quantity);
        console.log(id);
        console.log(quantity);
    });



}
