import toastr from 'toastr/build/toastr.min';

var Source = {

    init: function () {

        this.alertConfig();
        this.addSource();
        this.onCreate();
        this.editSource();
        this.deleteSource();

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
        var html = '<tr class="result-item">\n' +
            '<td class="result-index">1</td>\n' +
            '<td class="result-name">' + data.so_name + '</td>\n' +
            '<td>1523</td>\n' +
            '<td><button type="button" data-id="' + data.id + '" class="btn btn-default source-list-edit" style=""><i class="fa fa-pencil" aria-hidden="true"></i></button>\n' +
            '<button type="button" data-id="' + data.id + '" class="btn btn-default source-list-delete" style=""><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>\n' +
            '</tr>';

        for (let i = 1; i <= $('.result-item').length; i++) {

            $('.result-item').eq(i - 1).find('.result-index').html(i + 1);

        }

        $('.result').prepend(html);

    },

    clearInputError() {
        $('input[name="so_name"]').val('');

        $('.candidate-text-error').html('');

    },

    addSource: function () {
        let that = this;
        $('.source-popup').find('.candidate-popup-button-add').click(function () {

            let $input = $('input[name="so_name"]');
            let createUrl=$(this).data('create-url');
            let inputText = $input.val();

            if (!inputText) {
                that.displayError('Tên ngành nghề không được để trống');
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: createUrl,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {so_name: inputText},
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
                        that.displayError(error.responseJSON.errors.so_name);
                    });
            }

        })
    },

    editSource: function () {
        let that = this;

        $(document).on('click', '.source-list-edit', function () {
            that.clearInputError();

            // closest: tìm tới phần tử cha mong muốn
            var $resultName = $(this).closest('.result-item').find('.result-name');

            var resultText = $resultName.html();

            var id = $(this).data('id');

            $('input[name="so_name"]').val(resultText);

            $('.source-popup .candidate-popup-button-add').addClass('hide');
            $('.source-popup .candidate-popup-button-edit').removeClass('hide');

            $('.source-popup #exampleModalLabel').html('Sửa nguồn');
            $('#candidate-popup').modal('show');

            $('.source-popup .candidate-popup-button-edit').off('click').click(function () {

                let $input = $('input[name="so_name"]');
                let editUrl = $(this).data('edit-url');
                console.log(editUrl);
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
                        data: {id: id, so_name: inputText},
                    })
                        .done(function (reponse) {
                            console.log(reponse);
                            that.displayAlert(reponse.message);

                            $resultName.html(reponse.result.so_name);

                            $('#candidate-popup').modal('hide');

                            that.clearInputError();

                        })
                        .fail(function (error) {

                            console.log(error);

                            that.displayError(error.responseJSON.errors.so_name);
                        });
                }

            })

        });

    },

    deleteSource: function () {
        var that = this;

        $(document).on('click', '.source-list-delete', function () {
            var id = $(this).data('id');

            $('#candidate-confirm').modal('show');

            var $resultItem = $(this).closest('.result-item');
            var resultItemIndex = $resultItem.index();

            $('.source-confirm .candidate-popup-button-trash').off('click').click(function () {
                var destroyUrl=$(this).data('delete-url');
                console.log(id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: destroyUrl,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {id: id},
                })
                    .done(function (reponse) {
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
        var that = this;
        $('button[data-target="#candidate-popup"].source').click(function () {

            that.clearInputError();

            $('#exampleModalLabel').html('Thêm nguồn');

            $('.source-popup .candidate-popup-button-edit').addClass('hide');
            $('.source-popup .candidate-popup-button-add').removeClass('hide');
        })
    },


};

$(function () {
    Source.init();
})



