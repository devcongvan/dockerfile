import './../../plugin/serializeObject';
import 'bootstrap-slider/dist/bootstrap-slider.min';
import Quill from 'quill/dist/quill';
import toastr from "toastr/build/toastr.min";

var CandidateList = {

    init: function () {
        this.configBootstrapSlider();
        this.candidateDestroy();
        this.showCandidateDetail();
        this.alertConfig();
        this.exportCV();
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

    configBootstrapSlider: function () {
        var ageFrom = $('#range_age').data('from') ? $('#range_age').data('from') : 0;
        var ageTo = $('#range_age').data('to') ? $('#range_age').data('to') : 100;

        var salaryFrom = $('#salary').data('from') ? $('#salary').data('from') : 0;
        var salaryTo = $('#salary').data('to') ? $('#salary').data('to') : 100;


        $('#range_age').slider({
            id: "slider12c", min: 0, max: 100, range: true, value: [ageFrom, ageTo],
            formatter: function formatter(val) {
                if (val !== '') {
                    return "Từ " + val[0] + " đến " + val[1] + " tuổi";
                } else {
                    return val;
                }
            }
        }).on('slideStop', function () {
            var age = $('#range_age').val();
            $('#range_age').closest('form').submit();
        });

        $('#salary').slider({
            id: "slider12c", min: 0, max: 100, range: true, value: [salaryFrom, salaryTo],
            formatter: function formatter(val) {
                if (val !== '') {
                    return "Từ " + val[0] + " đến " + val[1] + " triệu";
                } else {
                    return val;
                }
            }
        }).on('slideStop', function () {
            var age = $('#salary').val();
            $('#salary').closest('form').submit();
        });
    },

    candidateDestroy: function () {
        var $this = this;
        $(document).on('click', '.candidate-list .candidate-item-destroy', function () {
            var deleteUrl = $('.candidate-list').data('delete-url');
            var id = $(this).data('id');
            var candidateItem = $(this).closest('.candidate-item');

            $(document).on('click', '.candidate-confirm .candidate-popup-button-trash', function () {
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
                        $this.displayAlert(reponse.message);

                        candidateItem.animate({
                            overflow: 'hidden',
                            height: '0',
                            opacity: 0
                        }, 500, function () {
                            $(this).remove();
                        });
                        $('.candidate-confirm').modal('hide');

                        // $resultItem.remove();
                        //
                        // for (let i = resultItemIndex; i <= $('.result-item').length; i++) {
                        //     $('.result-item').eq(i).find('.result-index').html(i + 1);
                        // }
                    })
                    .fail(function (error) {

                    });

            })
        })
    },

    showCandidateDetail: function () {
        var $this = this;
        $(document).on('click', '.candidate-item-main-name', function () {

            var showCandidateUrl = $(this).closest('form').data('showcandidate-url');

            var id = $(this).data('id');
            var name = $(this);

            if (name.attr('toggle') == 'false') {
                name.attr('toggle', 'true');
            }

            $('.candidate-main').removeClass('col-xs-9 col-sm-9 col-md-9 col-lg-9');
            $('.candidate-main').addClass('col-xs-6 col-sm-6 col-md-6 col-lg-6');
            $('.candidate-sidebar').addClass('hide');
            $('.candidate-info').slideDown();
            $('.candidate-item').removeClass('selected');
            $(this).parent().parent().parent().parent().addClass('selected');


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: showCandidateUrl,
                type: 'POST',
                dataType: 'JSON',
                data: {id: id},
            })
                .done(function (reponse) {
                    $this.renderCV(reponse);
                })
                .fail(function (error) {
                    console.log(error);
                });

        });

        var candidate_info = $('.candidate-sidebar');
        var candidate_info_top = 0;
        if (candidate_info.length) {
            var candidate_info_top = candidate_info.offset().top;
        }


        $(window).scroll(function () {

            if ($('.selected').find('.candidate-item-main-name').attr('toggle') == 'true') {

                var candidate_item_width = $('.candidate-main').outerWidth();

                var candidate_item_left = $('.candidate-main').offset().left;

                // var padding_left=$('.candidate-main').css('padding-right');

                // console.log(padding_left);

                var width = $('.selected').outerWidth() + "px";

                // $('.candidate-info').animate({width:width});
                $('.candidate-info').width(width);

                if ($(this).scrollTop() > candidate_info_top) {
                    $('.candidate-info').addClass('fixed');
                    $('.candidate-info').css('left', candidate_item_width + candidate_item_left + 'px');
                } else {
                    // $('.candidate-info').css('left',candidate_item_width+candidate_item_left+'px');
                    $('.candidate-info').css('left', 0);
                    $('.candidate-info').removeClass('fixed');
                    $('.candidate-info').addClass('show');
                    // $('.candidate-info').css('position','static');
                }
            }

        });

        $('.candidate-info').find('.close').click(function () {
            if ($('.selected').find('.candidate-item-main-name').attr('toggle') == 'true') {
                $('.selected').find('.candidate-item-main-name').attr('toggle', 'false');
            }

            $('.candidate-info').removeClass('fixed');
            $('.candidate-info').removeClass('show');
            $('.candidate-info').fadeOut();
            $('.candidate-sidebar').removeClass('hide');
            $('.candidate-main').removeClass('col-xs-6 col-sm-6 col-md-6 col-lg-6');
            $('.candidate-main').addClass('col-xs-9 col-sm-9 col-md-9 col-lg-9');
            $('.candidate-item').removeClass('selected');
        });


    },

    renderCV: function (data) {
        console.log(data);
        var notify = 'Chưa có dữ liệu';

        var candidate = data.data.candidate;
        var candidate_info = data.data.candidateInfo;

        if (candidate.can_name) {
            $('#can_name').html(candidate.can_name);
        } else {
            $('#can_name').html(notify);
        }

        $('.candidate-cv-img').children('img').attr('src', candidate.can_avatar);

        if (candidate.can_title) {
            $('#can_title').html(candidate.can_title);
        } else {
            $('#can_title').html(notify);
        }

        if (candidate.can_birthday) {
            let today = new Date();
            let birthDate = new Date(candidate.can_birthday);
            let age = today.getFullYear() - birthDate.getFullYear();

            $('#can_birthday').html(age);
        } else if (candidate.can_year) {
            let today = new Date();
            let age = today.getFullYear() - candidate.can_year;
            $('#can_birthday').html(age);
        } else {
            $('#can_birthday').html(notify);
        }

        if (candidate.can_gender) {
            $('#can_gender').html(candidate.can_gender == 1 ? 'Nam' : 'Nữ');
        } else {
            $('#can_gender').html(notify);
        }

        if (candidate.can_phone) {
            $('#can_phone').html(candidate.can_phone);
        } else {
            $('#can_phone').html(notify);
        }

        if (candidate.can_email) {
            $('#can_email').html(candidate.can_email);
        } else {
            $('#can_email').html(notify);
        }

        if (candidate.can_address) {
            $('#can_address').html(candidate.can_address);
        } else {
            $('#can_address').html(notify);
        }

        if (candidate.can_skype) {
            $('#can_skype').html(candidate.can_skype);
            $('#can_skype').closest('.candidate-cv-item').show();
        } else {
            $('#can_skype').closest('.candidate-cv-item').hide();
        }

        if (candidate.can_facebook) {
            $('#can_facebook').closest('.candidate-cv-item').show();
            $('#can_facebook').html(candidate.can_facebook);
        } else {
            $('#can_facebook').closest('.candidate-cv-item').hide();
        }

        if (candidate.can_linkedin) {
            $('#can_linkedin').closest('.candidate-cv-item').show();
            $('#can_linkedin').html(candidate.can_linkedin);
        } else {
            $('#can_linkedin').closest('.candidate-cv-item').hide();
        }

        if (candidate.can_github) {
            $('#can_github').closest('.candidate-cv-item').show();
            $('#can_github').html(candidate.can_github);
        } else {
            $('#can_github').closest('.candidate-cv-item').hide();
        }

        if (candidate.hometown) {
            $('#hometown').html(candidate.hometown);
        } else {
            $('#hometown').html(notify);
        }

        var stringCareer = '';
        if (candidate.careers) {
            $.each(candidate.careers, function (index, item) {
                stringCareer += item.ca_name + ', ';
            })
            stringCareer = stringCareer.slice(0, -2);
            $('#ca_name').html(stringCareer);
        } else {
            $('#ca_name').html(notify);
        }

        var stringSkill = '';
        if (candidate.skills) {
            $.each(candidate.skills, function (index, item) {
                stringSkill += item.sk_name + ', ';
            })
            stringSkill = stringSkill.slice(0, -2);
            $('#sk_name').html(stringSkill);
        } else {
            $('#sk_name').html(notify);
        }

        var stringLocation = '';
        if (candidate.locations) {
            $.each(candidate.locations, function (index, item) {
                if (index == 0) {
                    stringLocation += item.loc_name + ' - ';
                } else {
                    stringLocation += item.loc_name + ', ';
                }
            })
            stringLocation = stringLocation.slice(0, -2);
            $('#loc_name').html(stringLocation);
        } else {
            $('#loc_name').html(notify);
        }

        if (candidate_info.ci_work_abroad) {
            $('#ci_work_abroad').html(candidate_info.ci_work_abroad == 1 ? 'Có' : 'Không');
        } else {
            $('#ci_work_abroad').html(notify);
        }

        if (candidate_info.ci_time_experience) {
            $.getJSON('json/time_experience.json', function (data) {
                $('#ci_time_experience').html(data[candidate_info.ci_time_experience].name);
            });
        } else {
            $('#ci_time_experience').html(notify);
        }

        if (candidate_info.ci_qualification) {
            $.getJSON('json/qualification.json', function (data) {
                $('#ci_qualification').html(data[candidate_info.ci_qualification].name);
            });
        } else {
            $('#ci_qualification').html(notify);
        }

        if (candidate_info.ci_qualification) {
            $.getJSON('json/english_level.json', function (data) {

                $('#ci_english_level').html(data[candidate_info.ci_qualification].name);
            });
        } else {
            $('#ci_english_level').html(notify);
        }

        if (candidate_info.ci_type_of_work) {
            $.getJSON('json/type_of_work.json', function (data) {
                $('#ci_type_of_work').html(data[candidate_info.ci_type_of_work].name);
            });
        } else {
            $('#ci_type_of_work').html(notify);
        }

        if (candidate_info.ci_salary_from) {
            $('#ci_salary').html('Từ ' + candidate_info.ci_salary_from + ' đến ' + candidate_info.ci_salary_to + ' triệu');
        } else {
            $('#ci_salary').html(notify);
        }

        if (candidate_info.ci_target) {
            $('#ci_about').closest('.candidate-cv-box').hide();
        } else {
            $('#ci_about').closest('.candidate-cv-box').show();
            if (candidate_info.ci_target == null) {
                $('#ci_target').closest('.candidate-cv-item').hide();
            } else {
                $('#ci_target').closest('.candidate-cv-item').show();
                $('#ci_target').html(candidate_info.ci_target);
            }
            if (candidate_info.ci_about == null) {
                $('#ci_about').closest('.candidate-cv-item').hide();
            } else {
                $('#ci_about').closest('.candidate-cv-item').show();
                $('#ci_about').html(candidate_info.ci_about);
            }
        }

        if (candidate_info.ci_certificate) {
            var certificate = $.parseJSON(candidate_info.ci_certificate);

            if (certificate.length > 0) {
                var html = '';
                $.each(certificate, function (index, item) {
                    var item = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">\n' +
                        '                                                                        ' + item.time + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-right">\n' +
                        '                                                                        ' + item.name + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                </div>';
                    html += item;
                });

                $('.ci_certificate').show();
                $('.ci_certificate').find('.ci_certificate-content').html(html);

            } else {
                var item = '<div class="candidate-cv-item">\n' +
                    '                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">\n' +
                    '                                                                        ' + certificate.time + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-right">\n' +
                    '                                                                        ' + certificate.name + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                </div>';

                $('.ci_certificate').show();
                $('.ci_certificate').find('.ci_certificate-content').html(item);
            }

        } else {
            $('.ci_certificate').hide();
        }

        if (candidate_info.ci_prize) {
            var prize = $.parseJSON(candidate_info.ci_prize);

            if (prize.length > 0) {
                var hrml = '';
                $.each(prize, function (index, item) {
                    var item = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">\n' +
                        '                                                                        ' + item.time + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-right">' + item.name + ' \n' +
                        '                                                                    </div>\n' +
                        '                                                                </div>';
                    html += item
                });
                $('.ci_prize').show();
                $('.ci_prize').find('.ci_prize-content').html(html);

            } else {
                var item = '<div class="candidate-cv-item">\n' +
                    '                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">\n' +
                    '                                                                        ' + prize.time + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-right">' + prize.name + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                </div>';
                $('.ci_prize').show();
                $('.ci_prize').find('.ci_prize-content').html(item);
            }

        } else {

            $('.ci_prize').hide();
        }


        if (candidate_info.ci_skill) {
            var skill = $.parseJSON(candidate_info.ci_skill);
            if (skill.length > 0) {
                var html = '';
                $.each(skill, function (index, item) {
                    var canitem = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-left">\n' +
                        '                                                                        ' + item.name + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-right">\n' +
                        '                                                                        <ul class="candidate-cv-rate">\n' +
                        '                                                                            <li class="candidate-cv-rate-item ' + (item.evaluate >= 1 ? 'active' : '') + '"></li>\n' +
                        '                                                                            <li class="candidate-cv-rate-item ' + (item.evaluate >= 2 ? 'active' : '') + '"></li>\n' +
                        '                                                                            <li class="candidate-cv-rate-item ' + (item.evaluate >= 3 ? 'active' : '') + '"></li>\n' +
                        '                                                                            <li class="candidate-cv-rate-item ' + (item.evaluate >= 4 ? 'active' : '') + ' "></li>\n' +
                        '                                                                            <li class="candidate-cv-rate-item ' + (item.evaluate >= 5 ? 'active' : '') + '"></li>\n' +
                        '                                                                        </ul>\n' +
                        '                                                                    </div>\n' +
                        '                                                                </div>';

                    html += canitem;

                });
                // console.log(html);
                $('.ci_skill').show();
                $('.ci_skill').find('.ci_skill-content').html(html);


            } else {
                var canitem = '<div class="candidate-cv-item">\n' +
                    '                                                                    <div class="candidate-cv-item-left">\n' +
                    '                                                                        ' + skill.name + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-right">\n' +
                    '                                                                        <ul class="candidate-cv-rate">\n' +
                    '                                                                            <li class="candidate-cv-rate-item ' + (skill.evaluate >= 1 ? 'active' : '') + '"></li>\n' +
                    '                                                                            <li class="candidate-cv-rate-item ' + (skill.evaluate >= 2 ? 'active' : '') + '"></li>\n' +
                    '                                                                            <li class="candidate-cv-rate-item ' + (skill.evaluate >= 3 ? 'active' : '') + '"></li>\n' +
                    '                                                                            <li class="candidate-cv-rate-item ' + (skill.evaluate >= 4 ? 'active' : '') + ' "></li>\n' +
                    '                                                                            <li class="candidate-cv-rate-item ' + (skill.evaluate >= 5 ? 'active' : '') + '"></li>\n' +
                    '                                                                        </ul>\n' +
                    '                                                                    </div>\n' +
                    '                                                                </div>';

                $('.ci_skill').show();
                $('.ci_skill').find('.ci_skill-content').html(canitem);
            }

        } else {
            $('.ci_skill').hide();
        }

        if (candidate_info.ci_hobby) {
            $('.ci_hobby').show();

            $('.ci_hobby-content').html(candidate_info.ci_hobby);
        } else {
            $('.ci_hobby').hide();
        }

        if (candidate_info.ci_education) {
            var education = $.parseJSON(candidate_info.ci_education);

            if (education.length > 0) {

                var html = '';
                $.each(education, function (index, item) {
                    var item = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-time">\n' +
                        '                                                                        ' + (item.time ? item.time : (item.start + ' - ' + item.finish)) + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-name">\n' +
                        '                                                                        ' + item.schoolname + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-position">\n' +
                        '                                                                        ' + item.faculty + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-content">\n' +
                        '                                                                        ' + item.process + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                </div>';
                    html += item;
                });
                $('.ci_education').show();
                $('.ci_education-content').html(html);
            } else {
                var item = '<div class="candidate-cv-item">\n' +
                    '                                                                    <div class="candidate-cv-item-time">\n' +
                    '                                                                        ' + education.start + ' - ' + education.finish + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-name">\n' +
                    '                                                                        ' + education.schoolname + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-position">\n' +
                    '                                                                        ' + education.faculty + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-content">\n' +
                    '                                                                        ' + education.process + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                </div>';
                $('.ci_education').show();
                $('.ci_education-content').html(item);
            }
        } else {
            $('.ci_education').hide();
        }

        if (candidate_info.ci_work_experience) {
            var experience = $.parseJSON(candidate_info.ci_work_experience);

            if (experience.length > 0) {

                var html = '';
                $.each(experience, function (index, item) {
                    var item = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-time">\n' +
                        '                                                                        ' + (item.time !== undefined ? item.time : (item.start + " - " + item.finish)) + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-name">\n' +
                        '                                                                        ' + item.company + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-position">\n' +
                        '                                                                        ' + item.position + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-content">\n' +
                        '                                                                        ' + item.process + '.\n' +
                        '                                                                    </div>\n' +
                        '                                                                </div>';
                    html += item;
                });
                $('.ci_work_experience').show();
                $('.ci_work_experience-content').html(html);

            } else {
                var item = '<div class="candidate-cv-item">\n' +
                    '                                                                    <div class="candidate-cv-item-time">\n' +
                    '                                                                        ' + (experience.time !== undefined ? experience.time : (experience.start + " - " + experience.finish)) + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-name">\n' +
                    '                                                                        ' + experience.company + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-position">\n' +
                    '                                                                        ' + experience.position + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-content">\n' +
                    '                                                                        ' + experience.process + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                </div>';


                $('.ci_work_experience').show();
                $('.ci_work_experience-content').html(item);
            }
        } else {
            $('.ci_work_experience').hide();
        }

        if (candidate_info.ci_activity) {
            var activity = $.parseJSON(candidate_info.ci_activity);
            if (activity.length > 0) {

                var html = '';
                $.each(activity, function (index, item) {
                    var item = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-time">\n' +
                        '                                                                        ' + item.start + ' - ' + item.finish + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-name">\n' +
                        '                                                                        ' + item.name + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-position">\n' +
                        '                                                                        ' + item.position + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-content">\n' +
                        '                                                                        ' + item.process + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                </div>';
                    html += item;
                });
                $('.ci_activity').show();
                $('.ci_activity-content').html(html);

            } else {
                var item = '<div class="candidate-cv-item">\n' +
                    '                                                                    <div class="candidate-cv-item-time">\n' +
                    '                                                                        ' + item.start + ' - ' + item.finish + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-name">\n' +
                    '                                                                        ' + item.name + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-position">\n' +
                    '                                                                        ' + item.position + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-content">\n' +
                    '                                                                        ' + item.process + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                </div>';
                $('.ci_activity').show();
                $('.ci_activity-content').html(item);
            }
        } else {
            $('.ci_activity').hide();
        }

    },

    exportCV:function () {

        $('.candidate-info').find('.download').click(function () {
            var exportPdfUrl=$(this).data('url-exportpdf');
            var cvHtml= $('.candidate-info').find('.simplebar-content').html();

            $('#exportpdf-form-html').val(cvHtml);

            $('#exportpdf-form').submit();

        })
    }

};

$(function () {
    var options = {
        placeholder: 'Soạn Mail ...',
        modules: {
            toolbar: [
                [{'font': []}],
                [{'size': ['small', false, 'large', 'huge']}],
                ['bold', 'italic', 'underline'],        // toggled buttons
                [{'color': []}, {'background': []}],
                // custom button values
                [{'list': 'ordered'}, {'list': 'bullet'}],
                [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
                [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
                [{'direction': 'rtl'}],                         // text direction
                [{'align': []}],
                ['blockquote', 'code-block', 'link'],
                ['clean']                                     // remove formatting button
            ]
        },
        theme: 'snow'
    };

    var quill = new Quill('#editor', options);

    CandidateList.init();
})