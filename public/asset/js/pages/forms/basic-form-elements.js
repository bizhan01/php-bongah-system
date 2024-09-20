


$(function () {

    "use strict";

    //Textarea auto growth
    autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });

    //Bootstrap datepicker plugin
    $('#bs_datepicker_container input').datepicker({
        autoclose: true,
        container: '#bs_datepicker_container'
    });

    // by mahmud
    $('#bs_datepicker_container1 input').datepicker({
        autoclose: true,
        container: '#bs_datepicker_container1'
    });
    $('#bs_datepicker_container2 input').datepicker({
        autoclose: true,
        container: '#bs_datepicker_container2'
    });





    $('#bs_datepicker_component_container').datepicker({
        autoclose: true,
        container: '#bs_datepicker_component_container'
    });
    //
    $('#bs_datepicker_range_container').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container'
    });

    $('#bs_datepicker_component_container1').datepicker({
        autoclose: true,
        container: '#bs_datepicker_component_container1'
    });
    //
    $('#bs_datepicker_range_container1').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container1'
    });

    $('#bs_datepicker_component_container2').datepicker({
        autoclose: true,
        container: '#bs_datepicker_component_container2'
    });
    //
    $('#bs_datepicker_range_container2').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container2'
    });

    $('#bs_datepicker_component_container3').datepicker({
        autoclose: true,
        container: '#bs_datepicker_component_container3'
    });
    //
    $('#bs_datepicker_range_container3').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container3'
    });

    $('#bs_datepicker_component_container4').datepicker({
        autoclose: true,
        container: '#bs_datepicker_component_container4'
    });
    //
    $('#bs_datepicker_range_container4').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container4'
    });

    $('#bs_datepicker_component_container5').datepicker({
        autoclose: true,
        container: '#bs_datepicker_component_container5'
    });
    //
    $('#bs_datepicker_range_container5').datepicker({
        autoclose: true,
        container: '#bs_datepicker_range_container5'
    });









});