$("#deliveryform-method").on('click', function() {
    $.pjax.reload({container: '#deliveryPjaxSection', async: false, data: { delivery_id: $(this, 'option:selected').val()}}, );
});