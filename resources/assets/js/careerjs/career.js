import toastr from 'toastr/build/toastr.min';

const URL_CREATE_CAREER='career/ajax/new';
const URL_UPDATE_CAREER='career/ajax/edit';
const URL_DELETE_CAREER='career/ajax/delete';

var Career={

    init:function(){
        this.alertConfig();
        this.addCareer();
        this.onCreate();
        this.editCareer();
        this.deleteCareer();
    },

    alertConfig:function(){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    },

    displayAlert:function(message,type='success'){
        toastr[type](message);
    },

    displayError:function(message){
        $('.candidate-text-error').text(message);
    },

    renderItem:function(data){
        var html='<tr class="result-item">\n' +
            '<td class="result-index">1</td>\n' +
            '<td class="result-name">'+data.ca_name+'</td>\n' +
            '<td>1523</td>\n' +
            '<td><button type="button" data-id="'+data.id+'" class="btn btn-default career-list-edit" style=""><i class="fa fa-pencil" aria-hidden="true"></i></button>\n' +
            '<button type="button" data-id="'+data.id+'" class="btn btn-default career-list-delete" style=""><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>\n' +
            '</tr>';

        for(let i=1;i<=$('.result-item').length;i++){
            $('.result-item').eq(i-1).find('.result-index').html(i+1);
        }

        $('.result').prepend(html);

    },

    clearInputError(){
        $('input[name="ca_name"]').val('');
        $('.candidate-text-error').html('');
    },

    addCareer:function(){
        let that=this;
        $('.candidate-popup-button-add').click(function () {

            let $input=$('input[name="ca_name"]');
            let inputText=$input.val();

            if (!inputText){
                that.displayError('Tên ngành nghề không được để trống');
            }else{
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: URL_CREATE_CAREER,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {ca_name: inputText},
                })
                    .done(function(reponse) {
                        that.displayAlert(reponse.message);
                        that.renderItem(reponse.result);
                        $('#candidate-popup').modal('hide');
                        that.clearInputError();
                    })
                    .fail(function(error) {
                        that.displayError(error.responseJSON.errors.ca_name);
                    });
            }

        })
    },

    editCareer:function(){
        let that=this;

        $('.career-list-edit').click(function () {
            that.clearInputError();

            // closest: tìm tới phần tử cha mong muốn
            var $resultName=$(this).closest('.result-item').find('.result-name');
            var resultText=$resultName.html();

            var id=$(this).data('id');

            $('input[name="ca_name"]').val(resultText);

            $('.candidate-popup-button-add').addClass('hide');
            $('.candidate-popup-button-edit').removeClass('hide');
            $('#candidate-popup').modal('show');

            $('.candidate-popup-button-edit').off('click').click(function () {

                let $input=$('input[name="ca_name"]');
                let inputText=$input.val();

                console.log(inputText);

                if (!inputText){
                    that.displayError('Tên ngành nghề không được để trống');
                }else{
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: URL_UPDATE_CAREER,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {id:id,ca_name: inputText},
                    })
                        .done(function(reponse) {
                            that.displayAlert(reponse.message);

                            $resultName.html(reponse.result.ca_name);

                            $('#candidate-popup').modal('hide');

                            that.clearInputError();

                        })
                        .fail(function(error) {

                            that.displayError(error.responseJSON.errors.ca_name);
                        });
                }

            })

        });

    },

    deleteCareer:function(){
        var that=this;

        $('.career-list-delete').click(function () {
            var id=$(this).data('id');

            var $resultItem=$(this).closest('.result-item');
            var resultItemIndex=$resultItem.index();

            $('.candidate-popup-button-trash').off('click').click(function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: URL_DELETE_CAREER+'/'+id,
                    type: 'GET',
                    dataType: 'HTML',
                    // data: {id: id},
                })
                    .done(function(reponse) {

                    })
                    .fail(function(error) {
                        that.displayAlert('Xóa ngành nghề thành công.');
                        $('#candidate-confirm').modal('hide');
                        $resultItem.remove();

                        for(let i=resultItemIndex;i<=$('.result-item').length;i++){
                            $('.result-item').eq(i).find('.result-index').html(i+1);
                        }

                    });
            });
        })
    },

    onCreate:function(){
        var that=this;
        $('button[data-target="#candidate-popup"]').click(function () {
            that.clearInput();

            $('.candidate-popup-button-edit').addClass('hide');
            $('.candidate-popup-button-add').removeClass('hide');
        })
    },



};

$(function () {
    Career.init();
})



