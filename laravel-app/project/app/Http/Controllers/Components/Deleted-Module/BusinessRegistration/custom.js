$(document).ready(function() {
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