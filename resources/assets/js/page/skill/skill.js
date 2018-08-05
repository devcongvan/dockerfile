import toastr from 'toastr/build/toastr.min';

var Skill = {

    init: function () {

        this.alertConfig();
        this.addSkill();
        this.onCreate();
        this.editSkill();
        this.deleteSkill();
    },

    alertConfig: function () {
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

    displayAlert: function (message, type = 'success') {
        toastr[type](message);
    },

    displayError: function (message) {
        $('.candidate-text-error').text(message);
    },

    renderItem: function (data) {
        let html = '<tr class="result-item">\n' +
            '<td class="result-index">1</td>\n' +
            '<td class="result-name">' + data.sk_name + '</td>\n' +
            '<td>1523</td>\n' +
            '<td><button type="button" data-id="' + data.id + '" class="btn btn-default skill-list-edit" style=""><i class="fa fa-pencil" aria-hidden="true"></i></button>\n' +
            '<button type="button" data-id="' + data.id + '" class="btn btn-default skill-list-delete" style=""><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>\n' +
            '</tr>';

        for (let i = 1; i <= $('.result-item').length; i++) {
            $('.result-item').eq(i - 1).find('.result-index').html(i + 1);
        }

        $('.result').prepend(html);

    },

    clearInputError() {
        $('input[name="sk_name"]').val('');
        $('.candidate-text-error').html('');
    },

    addSkill: function () {
        let that = this;
        $('.skill-popup').find('.candidate-popup-button-add').click(function () {

            let $input = $('input[name="sk_name"]');
            let createUrl=$(this).data('create-url');
            let inputText = $input.val();

            if (!inputText) {
                that.displayError('Tên kỹ năng không được để trống');
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: createUrl,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {sk_name: inputText},
                })
                    .done(function (reponse) {
                        console.log(reponse);

                        that.displayAlert(reponse.message);
                        that.renderItem(reponse.result);
                        $('#candidate-popup').modal('hide');
                        that.clearInputError();
                    })
                    .fail(function (error) {
                        console.log(error);
                        that.displayError(error.responseJSON.errors.sk_name);
                    });
            }

        })
    },

    editSkill: function () {
        let that = this;

        $(document).on('click', '.skill-list-edit', function () {
            that.clearInputError();

            // closest: tìm tới phần tử cha mong muốn
            let $resultName = $(this).closest('.result-item').find('.result-name');
            let resultText = $resultName.html();

            let id = $(this).data('id');

            $('input[name="sk_name"]').val(resultText);

            $('.skill-popup .candidate-popup-button-add').addClass('hide');
            $('.skill-popup .candidate-popup-button-edit').removeClass('hide');

            $('.skill-popup #exampleModalLabel').html('Sửa kỹ năng');
            $('#candidate-popup').modal('show');

            $('.skill-popup .candidate-popup-button-edit').off('click').click(function () {

                let $input = $('input[name="sk_name"]');
                let editUrl = $(this).data('edit-url');
                let inputText = $input.val();

                if (!inputText) {
                    that.displayError('Tên nguồn không được để trống');
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: editUrl,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {id: id, sk_name: inputText},
                    })
                        .done(function (reponse) {
                            console.log(reponse);
                            that.displayAlert(reponse.message);

                            $resultName.html(reponse.result.sk_name);

                            $('#candidate-popup').modal('hide');

                            that.clearInputError();

                        })
                        .fail(function (error) {

                            console.log(error);

                            that.displayError(error.responseJSON.errors.sk_name);
                        });
                }

            })

        });

    },

    deleteSkill: function () {
        let that = this;

        $(document).on('click', '.skill-list-delete', function () {

            let id = $(this).data('id');

            $('#candidate-confirm').modal('show');

            let $resultItem = $(this).closest('.result-item');
            let deleteUrl=$(this).data('delete-url');
            let resultItemIndex = $resultItem.index();

            $('.skill-confirm .candidate-popup-button-trash').off('click').click(function () {

                let deleteUrl=$(this).data('delete-url');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: deleteUrl,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {id: id},
                })
                    .done(function (reponse) {
                        console.log(reponse);
                        that.displayAlert(reponse.message);
                        $('#candidate-confirm').modal('hide');
                        $resultItem.remove();

                        for (let i = resultItemIndex; i <= $('.result-item').length; i++) {
                            $('.result-item').eq(i).find('.result-index').html(i + 1);
                        }
                    })
                    .fail(function (error) {


                    });
            });
        })
    },

    onCreate: function () {
        let that = this;
        $('button[data-target="#candidate-popup"].skill').click(function () {

            that.clearInputError();

            $('#exampleModalLabel').html('Thêm kỹ năng');

            $('.skill-popup .candidate-popup-button-edit').addClass('hide');
            $('.skill-popup .candidate-popup-button-add').removeClass('hide');
        })
    },


};

$(function () {
    Skill.init();
})



