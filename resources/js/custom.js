import Pikaday from 'pikaday'
import moment from 'moment'

window.initStartDateReportPicker = (start_date = null, end_date = null) => {
    if ($('#datepicker1').data('pikaday')) $('#datepicker1').data('pikaday').destroy();
    $('#datepicker1').data('pikaday', new Pikaday({
        field: document.getElementById('datepicker1'),
        format: 'MMM D, YYYY',
        firstDay: 1,
        // maxDate: new Date(),
        onOpen: function(date) {
            if ($('#datepicker2').data('pikaday').getDate()) $('#datepicker1').data('pikaday').setMaxDate($('#datepicker2').data('pikaday').getDate());
        }
    }));
}

window.initEndDateReportPicker = (start_date = null, end_date = null) => {
    if ($('#datepicker2').data('pikaday')) $('#datepicker2').data('pikaday').destroy();
    $('#datepicker2').data('pikaday', new Pikaday({
        field: document.getElementById('datepicker2'),
        format: 'MMM D, YYYY',
        firstDay: 1,
        // maxDate: new Date(),
        onOpen: function(date) {
            if ($('#datepicker1').data('pikaday').getDate()) $('#datepicker2').data('pikaday').setMinDate($('#datepicker1').data('pikaday').getDate());
        }
    }));
}

window.initSingleDatepicker = (format = 'MMM D, YYYY') => {
    if ($('#single-datepicker').data('pikaday')) $('#single-datepicker').data('pikaday').destroy();
    $('#single-datepicker').data('pikaday', new Pikaday({
        field: document.getElementById('single-datepicker'),
        format: format,
        firstDay: 1,
        // maxDate: new Date(),
    }));
}

window.initSingleDatepicker1 = (start_date = null, end_date = null) => {
    if ($('#single-datepicker1').data('pikaday')) $('#single-datepicker1').data('pikaday').destroy();
    $('#single-datepicker1').data('pikaday', new Pikaday({
        field: document.getElementById('single-datepicker1'),
        format: 'MMM D, YYYY',
        firstDay: 1,
        // maxDate: new Date(),
    }));
}

window.initSingleDatepicker2 = (start_date = null, end_date = null) => {
    if ($('#single-datepicker2').data('pikaday')) $('#single-datepicker2').data('pikaday').destroy();
    $('#single-datepicker2').data('pikaday', new Pikaday({
        field: document.getElementById('single-datepicker2'),
        format: 'MMM D, YYYY',
        firstDay: 1,
        // maxDate: new Date(),
    }));
}

window.initSingleDatepicker3 = (start_date = null, end_date = null) => {
    if ($('#single-datepicker3').data('pikaday')) $('#single-datepicker3').data('pikaday').destroy();
    $('#single-datepicker3').data('pikaday', new Pikaday({
        field: document.getElementById('single-datepicker3'),
        format: 'MMM D, YYYY',
        firstDay: 1,
        // maxDate: new Date(),
    }));
}

