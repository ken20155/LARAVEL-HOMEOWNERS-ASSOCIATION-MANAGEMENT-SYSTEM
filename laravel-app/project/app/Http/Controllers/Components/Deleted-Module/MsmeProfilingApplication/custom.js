$(document).ready(function() {
    main.notify();
    var element = '#laravel_datatable';
    var url = getRunURL('sample-data-table');
    var columns = [
        { data: 'status', title: 'Status' },
        { data: 'batch', title: 'No' },
        { data: 'created_at', title: 'Date' },
    ];
    main.generateDatatable(element,url,columns);
});
$(document).on('click', '#test-btn', function() {
    var element = '#laravel_datatable';
    main.reloadDatatableAjax(element);
});

$(document).on('click', '#test-test', function() {
    //$('#exampleModal').modal('show');
    var data = $.param({data:'sample'});
    var url = getRunURL('open-modal-add');
    var request = main.form_ajax(url, data, 'POST', function(xhr) {
        // $('#btn-login').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`).prop('disabled',true);
    });
    request.done(function(response) {
       $('#awdawdawd').html(response.data);
       $('#exampleModal').modal('show');
    });
});
