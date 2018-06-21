
// var URL_UPDATE_CAREER = '{{ route('ajax.career.update') }}';
// var URL_CREATE_CAREER = '{{ route('ajax.career.create') }}';
//
// function renderRow(data){
//     return `<tr>
//                         <td>${data.name}</td>
//                         <td></td>
//                         <td></td>
//                         <td></td>
//                     </tr>`;
// }
// var row = renderRow(data);
// $('body').prepend(row);

$(document).ready(function() {
    alert();

    // function renderRow(data){
    //     var text='<tr>' +
    //         '<td>'+(index+1)+'</td>' +
    //         '<td><a href="#">'+item.ca_name+'</a></td>' +
    //         '<td>1523</td>' +
    //         '<td><button type="button" data-url="'+item.id+'" class="btn btn-default btn-edit" style=""><i class="fa fa-pencil" aria-hidden="true"></i></button>\n' +
    //         '<button type="button" data-url="'+item.id+'" class="btn btn-default btn-delete" style=""><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>' +
    //         '</tr>';
    //
    //     return text;
    // }

    $('.candidate-popup-button-add').click(function () {

        var newcareer=$('#newcareer');
        var input=newcareer.find('input[name="ca_name"]');
        var ca_name=input.val();
        input.val('');

        if (!ca_name){
            newcareer.find('.candidate-text-error').html('Tên ngành nghề không được để trống');
        }else{
            // newcareer.find('.candidate-text-error').html('');
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url: 'career/ajax/new',
            //     type: 'POST',
            //     dataType: 'JSON',
            //     data: {ca_name: ca_name}
            // })
            //     .done(function(data) {
            //
            //         toastr.options = {
            //             "closeButton": true,
            //             "debug": false,
            //             "newestOnTop": false,
            //             "progressBar": true,
            //             "positionClass": "toast-bottom-left",
            //             "preventDuplicates": false,
            //             "onclick": null,
            //             "showDuration": "300",
            //             "hideDuration": "1000",
            //             "timeOut": "5000",
            //             "extendedTimeOut": "1000",
            //             "showEasing": "swing",
            //             "hideEasing": "linear",
            //             "showMethod": "fadeIn",
            //             "hideMethod": "fadeOut"
            //         }
            //
            //         toastr["success"](data.message);
            //
            //         $('#candidate-popup').modal('hide');
            //         input.val('');
            //
            //
            //     })
            //     .fail(function(error) {
            //         newcareer.find('.candidate-text-error').html(error.responseJSON.errors.ca_name[0]);
            //     });
        }
    });



    // load_data();
    //
    // function load_data() {
    //     $.ajax({
    //         url: 'career/ajax/list',
    //         type: 'GET',
    //         dataType: 'JSON',
    //         // data: {param1: 'value1'},
    //     })
    //         .done(function(data) {
    //             var html='';
    //             $.each(data, function( index, item ) {
    //                 var text='<tr>' +
    //                     '<td>'+(index+1)+'</td>' +
    //                     '<td><a href="#">'+item.ca_name+'</a></td>' +
    //                     '<td>1523</td>' +
    //                     '<td><button type="button" data-url="'+item.id+'" class="btn btn-default btn-edit" style=""><i class="fa fa-pencil" aria-hidden="true"></i></button>\n' +
    //                     '<button type="button" data-url="'+item.id+'" class="btn btn-default btn-delete" style=""><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>' +
    //                     '</tr>';
    //
    //                 html+=text;
    //                 console.log(index);
    //             });
    //             console.log(data);
    //
    //             $('#result').html(html);
    //         })
    //         .fail(function(error) {
    //         console.log(error);
    //     });
    // };

    // $('button[data-target="#candidate-popup"]').click(function (){
    //     $('#newcareer').find('input[name="ca_name"]').val('');
    //     $('.candidate-popup-button-fix').addClass('hide');
    //     $('.candidate-popup-button-add').removeClass('hide');
    // });

    // $(document).on('click','.btn-edit',function () {
    //     var popup=$('#candidate-popup');
    //
    //     popup.find('.candidate-popup-button-fix').removeClass('hide');
    //     popup.find('.candidate-popup-button-add').addClass('hide');
    //
    //     popup.modal('show');
    //
    //     var url=$(this).data('url');
    //
    //
    //
    //     $.ajax({
    //         url: url,
    //         type: 'GET',
    //         dataType: 'JSON',
    //         // data: {param1: 'value1'},
    //     })
    //         .done(function(data) {
    //             popup.find('input[name="ca_name"]').val(data.ca_name);
    //         })
    //         .fail(function(error) {
    //         console.log("error");
    //     });
    //
    //     console.log(url);
    //     edit(url);
    //
    // });



    // function edit(url) {
    //     $('.candidate-popup-button-fix').off('click').click(function () {
    //         var newcareer=$('#newcareer');
    //         var input=newcareer.find('input[name="ca_name"]');
    //         var ca_name=input.val();
    //
    //         if (!ca_name){
    //             newcareer.find('.candidate-text-error').html('Tên ngành nghề không được để trống');
    //         }else{
    //             newcareer.find('.candidate-text-error').html('');
    //             $.ajax({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 url: url,
    //                 type: 'POST',
    //                 dataType: 'JSON',
    //                 data: {ca_name: ca_name, id: }
    //             })
    //                 .done(function(data) {
    //
    //                     console.log(data);
    //
    //
    //
    //                 })
    //                 .fail(function(error) {
    //                     console.log(error);
    //                 });
    //
    //         }
    //
    //
    //
    //     });
    // };



});
