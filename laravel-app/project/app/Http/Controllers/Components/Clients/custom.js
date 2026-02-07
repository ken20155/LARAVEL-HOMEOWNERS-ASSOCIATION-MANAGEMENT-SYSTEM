//for core start
$(document).ready(function() {
    var element = '#laravel_datatable';
    var url = getRunURL('list-clients');
    var columns = [
        { data: '#', title: '#' },
        { data: 'full_name', title: 'Full name' },
        { data: 'email', title: 'Email' },
        { data: 'phone_number', title: 'Phone Number' },
        { data: 'action', title: 'Action' },
    ];
    main.generateDatatable(element,url,columns);
});
$(document).on('click', '#refrest-datatable', function() {
    var element = '#laravel_datatable';
    main.reloadDatatableAjax(element);
});
$(document).on('click', '#viewData', function() {
    var id = $(this).data('id');
    var data = $.param({
        id:id
    });
    var url = getRunURL('view-data');
    var request = main.form_ajax(url, data, 'POST', function(xhr) {
       main.block_ui();
    });
    request.done(function(response) {
        $('#action-text').html(response.action);
        $('#modal-view .modal-body').html(response.body);
        $('#modal-view #footer-custom').html(response.footer);
        $('#modal-view').modal('show');
        $.unblockUI();
    });

   
});
$(document).on('click', '#addNew', function() {
    var data = $.param({});
    var url = getRunURL('add-new');
    var request = main.form_ajax(url, data, 'POST', function(xhr) {
       main.block_ui();
    });
    request.done(function(response) {
        $('#action-text').html(response.action);
        $('#modal-view .modal-body').html(response.body);
        $('#modal-view #footer-custom').html(response.footer);
        $('#modal-view').modal('show');
        $.unblockUI();
    });

   
});
$(document).on('submit', '#submit-form', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var form = $(this);
    var data = form.serialize();
    var url = getRunURL('crud-action');
    var request = main.form_ajax(url, data, 'POST', function(xhr) {
        main.block_ui();
    });
    request.done(function(response) {
        if (response.success) {
            main.msg(response.msg,'success');
            var element = '#laravel_datatable';
            main.reloadDatatableAjax(element);
            $('#modal-view').modal('hide');
        }else{
            main.msg(response.msg,'error');
        }
        $.unblockUI();
    });
});
$(document).on('click', '#deleteData', function() {
    var title = 'Are you sure you want to Delete?';
    var id = $(this).data('id');
    main.confirmation(title,function () {
        var data = $.param({
            id:id
        });
        var url = getRunURL('delete-data');
        var request = main.form_ajax(url, data, 'POST', function(xhr) {
           main.block_ui('#div_laravel_datatable');
        });
        request.done(function(response) {
            if (response.success) {
                main.notify(response.msg,'close');
            }else{
                main.notify('Error','close');
            }
            $('#div_laravel_datatable').unblock();
            var element = '#laravel_datatable';
            main.reloadDatatableAjax(element);
        });
    })
});