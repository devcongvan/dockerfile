var CandidateAdd={
    init:function () {
        this.upImage();
        this.navprofileScroll();
        this.navprofileScrollActive();
        this.addSourceSkillByCandidate();
        this.rating();
        this.addRow();
    },

    upImage: function () {
        $('.candidate-upimage').click(function () {
            $('#file').trigger('click');
        });

        $('#file').change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#after_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
                $('.candidate-upimage').hide();
                $('.avatar').show();
            }
        });
    },

    navprofileScroll: function () {
        var navprofile = $('.navprofile');
        var navprofile_top = 0;
        if (navprofile.length) {
            var navprofile_top = navprofile.offset().top;
        }

        $(function () {
            $(window).scroll(function () {
                var candidate_sideleft_width = $('.candidate-sideleft').width();
                if ($(this).scrollTop() > navprofile_top) {
                    $('.navprofile').addClass('fixed');
                    $('.navprofile').css('width', candidate_sideleft_width + 'px');
                } else {
                    $('.navprofile').removeClass('fixed');
                }
            });
        })
    },

    navprofileScrollActive: function () {
        $('.navprofile-item a').click(function (e) {
            e.preventDefault();
            var hi = $(this);
            $('.navprofile-item a').removeClass('active');
            hi.addClass('active');
            $('html, body').animate({
                scrollTop: $(hi.attr('href')).offset().top
            }, 1000);
        });
        var lastId;
        var menuItems = $('.navprofile-item a');
        var scrollItems = $('.navprofile-item a').map(function () {
            var item = $($(this).attr("href"));
            if (item.length) {
                return item;
            }
        });

        // Bind to scroll
        $(window).scroll(function () {
            // Get container scroll position
            var fromTop = $(this).scrollTop() + 100;

            // Get id of current scroll item
            var cur = scrollItems.map(function () {
                if ($(this).offset().top < fromTop)
                    return this;
            });


            // Get the id of the current element
            cur = cur[cur.length - 1];
            var id = cur && cur.length ? cur[0].id : "";

            if (lastId !== id) {
                lastId = id;
                // Set/remove active class
                menuItems
                    .removeClass("active")
                    .filter("[href='#" + id + "']").addClass("active");
            }
        });
    },

    addSourceSkillByCandidate: function () {
        var $this = this;

        $('button[data-btn="source"]').click(function () {
            var url = $(this).data('url');

            $('#candidate-popup').find('.modal-title').html('Thêm nguồn');
            $('#candidate-popup').find('.modal-body-name').html('Tên nguồn');

            $('.candidate-popup-button-add').off('click').click(function () {

                var input = $('input[name="candidate_new"]');
                var inputText = input.val();

                if (inputText == !'') {
                    $this.displayError('Tên nguồn không được để trống');
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {so_name: inputText},
                    })
                        .done(function (reponse) {
                            console.log(reponse);
                            $this.displayAlert(reponse.message);
                            // $this.renderItem(reponse.result);
                            $('#candidate-popup').modal('hide');
                            input.val('');

                            $this.prependSource(reponse.result);
                        })
                        .fail(function (error) {
                            console.log(error);
                            $this.displayError(error.responseJSON.errors.so_name);
                        });
                }
            });


        })

        $('button[data-btn="skill"]').click(function () {
            var url = $(this).data('url');
            $('#candidate-popup').find('.modal-title').html('Thêm kỹ năng');
            $('#candidate-popup').find('.modal-body-name').html('Tên kỹ năng');

            $('.candidate-popup-button-add').off('click').click(function () {

                var input = $('input[name="candidate_new"]');
                var inputText = input.val();

                if (inputText == !'') {
                    $this.displayError('Tên nguồn không được để trống');
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {sk_name: inputText},
                    })
                        .done(function (reponse) {

                            $this.displayAlert(reponse.message);
                            $('#candidate-popup').modal('hide');
                            input.val('');
                            $this.prependSkill(reponse.result);

                        })
                        .fail(function (error) {
                            $this.displayError(error.responseJSON.errors.sk_name);
                        });
                }
            });


        });
        $('#candidate-popup .btn-close').off('click').click(function () {
            $('input[name="candidate_new"]').val('');
            $this.displayError('');
        })
    },

    prependSource: function (result) {
        var option = '<option value="' + result.id + '" selected >' + result.so_name + '</option>';
        $('select[name="can_source_id"]').prepend(option);
    },

    prependSkill: function (result) {
        var option = '<option value="' + result.id + '" selected >' + result.sk_name + '</option>';
        $('select[name="can_skill_id"]').prepend(option);
    },

    chooseFileExcel: function () {
        $(document).on('click', '.excelForm-btn', function () {
            $('.excelForm-file').trigger('click').change(function () {
                $('#candidate-confirm').modal('show');
            });
        });

        $('.candidate-confirm').find('.btn-close').click(function () {
            $('.excelForm-file').val(null);
        });

        $('.candidate-popup-button-yes').click(function () {
            $('.excelForm').submit();
            $('#candidate-confirm').modal('hide');
            $('.overlay').show();
        })

    },

    configDatepicker: function () {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            defaultViewDate: new Date(),
        });
    },

    rating: function () {
        $(document).on('mouseover', '.rateskill-item', function () {
            var onStar = $(this).data('value'); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('.rateskill-item').each(function (e) {

                if (e < onStar) {
                    $(this).addClass('rateskill-check');
                }
                else {
                    $(this).removeClass('rateskill-check');
                }
            });

            $(this).parent().children('.rateskill-input').val(onStar);
        }).on('mouseout', function () {
            $(this).parent().children('.rateskill-item').each(function (e) {
                $(this).removeClass('rateskill-check');
            });
        });

        $(document).on('mouseover', '.candidate-evaluate-item', function () {
            var onStar = $(this).data('value'); // The star currently mouse on
            alert();

            $('.candidate-evaluate-item-show-star').html(onStar);
            $('.candidate-evaluate-input').val(onStar);
            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('.candidate-evaluate-item').each(function (e) {

                if (e < onStar) {
                    $(this).addClass('check');
                    $(this).removeClass('uncheck');
                }
                else {
                    $(this).addClass('uncheck');
                    $(this).removeClass('check');
                }
            });

            $(this).parent().children('.candidate-evaluate-input').val(onStar);
        }).on('mouseout', function () {
            $(this).parent().children('.candidate-evaluate-item').each(function (e) {
                $(this).removeClass('check');
                $(this).addClass('uncheck');
            });
        });
    },

    addRow: function () {
        var that = this;
        $('.card').each(function (index, el) {
            var card = $(this);

            card.find('.btn-clone').click(function () {
                var candidateBox = card.find('.candidateBox:last');
                var dashed = card.find('.dashed:last');
                card.find('.card-body').append(dashed.clone(), candidateBox.clone());

                that.configDatepicker();

            });

        });

        $(document).on('click', '.remove-item', function () {
            $(this).parent().remove();
            $(this).parent().parent().children('.dashed:last').remove();
        })
    },
};

$(function () {
    CandidateAdd.init();
})

