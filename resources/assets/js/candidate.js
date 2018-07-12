import toastr from "toastr/build/toastr.min";
import jspdf from 'jspdf/dist/jspdf.min';

var Candidate = {

    init: function () {
        this.configDatepicker();
        this.configBootstrapSlider();
        this.configSelect2();
        this.configAutocomplete();
        this.upImage();
        this.navprofileScroll();
        this.navprofileScrollActive();
        this.showCandidateDetail();
        this.scrollSidebar();
        this.collapseNavbar();
        this.dropdownMenu();
        this.rating();
        this.addRow();
        this.alertConfig();
        this.candidateDestroy();
        this.addSourceByCandidate();
        this.chooseFileExcel();
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

    showCandidateDetail: function () {
        var $this = this;
        $('.candidate-item-main-name').click(function () {
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
                url: 'candidate/ajax/show',
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
            console.log(candidate_info_top);
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
        var arrNotice = [];

        var candidate = data.candidate;
        // var candidateInfo=reponse.candidateInfo;
        if (candidate.can_name !== null) {
            $('#can_name').html(candidate.can_name);
        } else {
            $('#can_name').html(notify);
        }

        $('.candidate-cv-img').children('img').attr('src',candidate.can_avatar);

        if (candidate.can_title !== null) {
            $('#can_title').html(candidate.can_title);
        } else {
            $('#can_title').html(notify);
        }

        if (candidate.can_birthday !== null) {
            $('#can_birthday').html(candidate.can_birthday);
        } else if (candidate.can_year !== null) {
            $('#can_birthday').html(candidate.can_year);
        } else {
            $('#can_birthday').html(notify);
        }

        if (candidate.can_gender !== null) {
            $('#can_gender').html(candidate.can_gender == 1 ? 'Nam' : 'Nữ');
        } else {
            $('#can_gender').html(notify);
        }

        if (candidate.can_phone !== null) {
            $('#can_phone').html(candidate.can_phone);
        } else {
            $('#can_phone').html(notify);
        }

        if (candidate.can_email !== null) {
            $('#can_email').html(candidate.can_email);
        } else {
            $('#can_email').html(notify);
        }

        if (candidate.can_address !== null) {
            $('#can_address').html(candidate.can_address);
        } else {
            $('#can_address').html(notify);
        }

        if (candidate.can_skype !== null) {
            $('#can_skype').html(candidate.can_skype);
            $('#can_skype').closest('.candidate-cv-item').show();
        } else {
            $('#can_skype').closest('.candidate-cv-item').hide();
        }

        if (candidate.can_facebook !== null) {
            $('#can_facebook').closest('.candidate-cv-item').show();
            $('#can_facebook').html(candidate.can_facebook);
        } else {
            $('#can_facebook').closest('.candidate-cv-item').hide();
        }

        if (candidate.can_linkedin !== null) {
            $('#can_linkedin').closest('.candidate-cv-item').show();
            $('#can_linkedin').html(candidate.can_linkedin);
        } else {
            $('#can_linkedin').closest('.candidate-cv-item').hide();
        }

        if (candidate.can_github !== null) {
            $('#can_github').closest('.candidate-cv-item').show();
            $('#can_github').html(candidate.can_github);
        } else {
            $('#can_github').closest('.candidate-cv-item').hide();
        }

        if (candidate.hometown !== null) {
            $('#hometown').html(candidate.hometown);
        } else {
            $('#hometown').html('');
        }

        var stringCareer = '';
        if (candidate.career !== null) {
            $.each(candidate.career, function (index, item) {
                stringCareer += item.ca_name + ', ';
            })
            stringCareer = stringCareer.slice(0, -2);
            $('#ca_name').html(stringCareer);
        } else {
            $('#ca_name').html('');
        }

        var stringSkill = '';
        if (candidate.skill !== null) {
            $.each(candidate.skill, function (index, item) {
                stringSkill += item.sk_name + ', ';
            })
            stringSkill = stringSkill.slice(0, -2);
            $('#sk_name').html(stringSkill);
        } else {
            $('#sk_name').html('');
        }

        var stringLocation = '';
        if (candidate.location !== null) {
            $.each(candidate.location, function (index, item) {
                if (index == 0) {
                    stringLocation += item.loc_name + ' - ';
                } else {
                    stringLocation += item.loc_name + ', ';
                }
            })
            stringLocation = stringLocation.slice(0, -2);
            $('#loc_name').html(stringLocation);
        } else {
            $('#loc_name').html('');
        }

        if (candidate.candidate_info.ci_work_abroad !== null) {
            $('#ci_work_abroad').html(candidate.candidate_info.ci_work_abroad == 1 ? 'Có' : 'Không');
        } else {
            $('#ci_work_abroad').html('');
        }

        if (candidate.candidate_info.ci_time_experience !== null) {
            $.getJSON('json/time_experience.json', function (data) {
                $('#ci_time_experience').html(data.experience[candidate.candidate_info.ci_time_experience].name);
            });
        } else {
            $('#ci_time_experience').html('');
        }

        if (candidate.candidate_info.ci_qualification !== null) {
            $.getJSON('json/qualification.json', function (data) {
                console.log(candidate.candidate_info.ci_qualification);
                $('#ci_qualification').html(data.qualification[candidate.candidate_info.ci_qualification].name);
            });
        } else {
            $('#ci_qualification').html('');
        }

        if (candidate.candidate_info.ci_qualification !== null) {
            $.getJSON('json/english_level.json', function (data) {

                $('#ci_english_level').html(data.english[candidate.candidate_info.ci_qualification].name);
            });
        } else {
            $('#ci_english_level').html('');
        }

        if (candidate.candidate_info.ci_type_of_work !== null) {
            $.getJSON('json/type_of_work.json', function (data) {
                $('#ci_type_of_work').html(data.type_of_work[candidate.candidate_info.ci_type_of_work].name);
            });
        } else {
            $('#ci_type_of_work').html('');
        }

        if (candidate.candidate_info.ci_salary !== null) {
            $.getJSON('json/salary.json', function (data) {
                $('#ci_salary').html(data.salary[candidate.candidate_info.ci_salary].name);
            });
        } else {
            $('#ci_salary').html('');
        }

        if (candidate.candidate_info.ci_salary !== null) {
            $('#ci_salary').html(candidate.candidate_info.ci_salary);
        } else {
            $('#ci_salary').html('');
        }

        if (candidate.candidate_info.ci_target == null && candidate.candidate_info.ci_about == "") {
            $('#ci_about').closest('.candidate-cv-box').hide();
        } else {
            $('#ci_about').closest('.candidate-cv-box').show();
            if (candidate.candidate_info.ci_target == null) {
                $('#ci_target').closest('.candidate-cv-item').hide();
            } else {
                $('#ci_target').closest('.candidate-cv-item').show();
                $('#ci_target').html(candidate.candidate_info.ci_targets);
            }
            if (candidate.candidate_info.ci_about == null) {
                $('#ci_about').closest('.candidate-cv-item').hide();
            } else {
                $('#ci_about').closest('.candidate-cv-item').show();
                $('#ci_about').html(candidate.candidate_info.ci_about);
            }
        }

        if (data.candidate.candidate_info.ci_certificate !== null) {
            var certificate = $.parseJSON(data.candidate.candidate_info.ci_certificate);
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

        if (data.candidate.candidate_info.ci_prize !== null) {
            var prize = $.parseJSON(data.candidate.candidate_info.ci_prize);
            if (prize.length > 0) {
                var hrml = '';
                $.each(prize, function (index, item) {
                    var item = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">\n' +
                        '                                                                        ' + item.time + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                    <div class="candidate-cv-item-right">\n' +
                        '+item.name+'
                    '                                                                    </div>\n' +
                    '                                                                </div>';
                });
                $('.ci_prize').show();
                $('.ci_prize').find('.ci_prize-content').html(html);

            } else {
                var item = '<div class="candidate-cv-item">\n' +
                    '                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">\n' +
                    '                                                                        ' + prize.time + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-right">\n' +
                    '+prize.name+'
                '                                                                    </div>\n' +
                '                                                                </div>';
                $('.ci_prize').show();
                $('.ci_prize').find('.ci_prize-content').html(item);
            }

        } else {
            $('.ci_prize').hide();
        }


        if (data.candidate.candidate_info.ci_skill !== null) {
            var skill = $.parseJSON(data.candidate.candidate_info.ci_skill);
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
                    console.log(item.evaluate);
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

        if (data.candidate.candidate_info.ci_hobby !== null) {
            $('.ci_hobby').show();

            $('.ci_hobby-content').html(data.candidate.candidate_info.ci_hobby);
        } else {
            $('.ci_hobby').hide();
        }

        if (data.candidate.candidate_info.ci_education !== null) {
            var education = $.parseJSON(data.candidate.candidate_info.ci_education);
            console.log(education.length);
            if (education.length > 0) {


                var html = '';
                $.each(education, function (index, item) {
                    var item = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-time">\n' +
                        '                                                                        ' + (item.time !== null ? item.time : (item.start + ' - ' + item.finish)) + '\n' +
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

        if (data.candidate.candidate_info.ci_work_experience !== null) {
            var experience = $.parseJSON(data.candidate.candidate_info.ci_work_experience);
            console.log(experience.length);
            if (experience.length > 0) {

                var html = '';
                $.each(experience, function (index, item) {
                    var item = '<div class="candidate-cv-item">\n' +
                        '                                                                    <div class="candidate-cv-item-time">\n' +
                        '                                                                        ' + (item.time !== "" ? item.time : (item.start + " - " + item.finish)) + '\n' +
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
                    '                                                                        ' + (experience.time !== "" ? experience.time : (experience.start + " - " + experience.finish)) + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-name">\n' +
                    '                                                                        ' + experience.company + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-position">\n' +
                    '                                                                        ' + experience.position + '\n' +
                    '                                                                    </div>\n' +
                    '                                                                    <div class="candidate-cv-item-content">\n' +
                    '                                                                        ' + experience.process + '.\n' +
                    '                                                                    </div>\n' +
                    '                                                                </div>';
                $('.ci_work_experience').show();
                $('.ci_work_experience-content').html(item);
            }
        } else {
            $('.ci_work_experience').hide();
        }

        if (data.candidate.candidate_info.ci_activity !== null) {
            var activity = $.parseJSON(data.candidate.candidate_info.ci_activity);
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

    downloadCV: function () {

    },

    scrollSidebar: function () {
        var main_sidebar = $('.main-sidebar');
        var main_sidebar_top = 0;
        if (main_sidebar.length) {
            var main_sidebar_top = main_sidebar.offset().top;
        }


        $(window).scroll(function () {
            if ($(this).scrollTop() > main_sidebar_top) {
                $('.main-sidebar').addClass('fixed');
            } else {
                $('.main-sidebar').removeClass('fixed');
            }
        });
    },

    collapseNavbar: function () {
        $('#collapse-navbar').click(function () {
            if ($(this).data('toggle') == true) {
                $(this).removeClass('rotate');
                $(this).data('toggle', false);
            } else {
                $(this).addClass('rotate');
                $(this).data('toggle', true);
            }
        });
    },

    dropdownMenu: function () {
        $(document).click(function (event) {
            if (!$(event.target).closest("#btn-open-dropdown").length) {
                $('.dropdown-menu').removeClass('show');
                $('#btn-open-dropdown').attr('aria-expanded', true);
            }
        });

        $('#btn-open-dropdown').click(function () {
            if ($(this).attr('aria-expanded') == "true") {
                $('.dropdown-menu').addClass('show');
                $(this).attr('aria-expanded', false);
            } else {
                $('.dropdown-menu').removeClass('show');
                $(this).attr('aria-expanded', true);
            }
        })
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

    configDatepicker: function () {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            defaultViewDate: new Date(),
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


    configBootstrapSlider: function () {
        $('#age').slider({
            id: "slider12c", min: 0, max: 100, range: true, value: [3, 7],
            formatter: function formatter(val) {
                if (val !== '') {
                    return "Từ " + val[0] + " đến " + val[1] + " tuổi";
                } else {
                    return val;
                }
            }
        });

        $('#salary').slider({
            id: "slider12c", min: 0, max: 100, range: true, value: [3, 7],
            formatter: function formatter(val) {
                if (val !== '') {
                    return "Từ " + val[0] + " đến " + val[1] + " triệu";
                } else {
                    return val;
                }
            }
        });
    },

    configSelect2: function () {

        // function formatSingleResult(result) {
        //     var term =$(".location").data("select2").dropdown.$search.val();
        //     // var reg =new RegExp("^" + term, "i");
        //
        //     var re = new RegExp("^" + term, "i") ;
        //     var t = result.text.replace(re,"<span style='font-weight:bold;color:Blue;'>" + term + "</span>");
        //
        //     // console.log(term);
        //
        //     var optionText = result.text;
        //
        //     // console.log(optionText);
        //
        //     var boldTermText = optionText.replace(re    , function(optionText) {return `<b>${optionText}</b>`});
        //
        //     console.log(boldTermText);
        //
        //     var $item = $(`<span> ${boldTermText}  </span>`);
        //
        //     // console.log($item);
        //
        //     return $item;
        // }
        //
        // function wordStartMatcher(term, text, highlighting) {
        //     var myRe  = new RegExp("(?:^|\\s)" + term, "i");
        //     var match = myRe.exec(text);
        //
        //     if (match != null && highlighting) {
        //         myRe = new RegExp("\\b" + term, "i");
        //         match = myRe.exec(text);
        //     }
        //
        //     return match;
        // }
        //
        // function markMatch(text, term, markup, escapeMarkup) {
        //     var wordMatch = wordStartMatcher(term, text, true);
        //
        //     var match = wordMatch ? wordMatch.index : -1;
        //     var tl = term.length;
        //
        //     if (match < 0) {
        //         markup.push(Select2.util.escapeMarkup(text));
        //         return;
        //     }
        //
        //     markup.push(Select2.util.escapeMarkup(text.substring(0, match)));
        //     markup.push("<span class='select2-match'>");
        //     markup.push(Select2.util.escapeMarkup(text.substring(match, match + tl)));
        //     markup.push("</span>");
        //     markup.push(Select2.util.escapeMarkup(text.substring(match + tl, text.length)));
        // }

        $('.RanDom').select2({
            placeholder: "Chọn tỉnh thành",
            ajax: {
                url: 'location/ajax/select2Search',
                dataType: 'json',
                data: function (params) {
                    // console.log(params);
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    // console.log(data);
                    return {
                        results: data
                    };
                },
                cache: true
            },
            language: {
                noResults: function (params) {
                    return "Không tìm thấy";
                },
                searching: function () {
                    return "Đang tìm kiếm tỉnh thành";
                }
            },
            // formatResult: function (result, container, query, escapeMarkup) {
            //     var markup = [];
            //     markMatch(this.text(result), query.term, markup, escapeMarkup);
            //     return markup.join("");
            // }
        });

        // $('#city_want_to_work').select2({
        //     placeholder: 'Chọn tỉnh/thành phố mong muốn làm việc',
        //     maximumSelectionLength: 3,
        //     language: {
        //         // You can find all of the options in the language files provided in the
        //         // build. They all must be functions that return the string that should be
        //         // displayed.
        //         maximumSelected: function (e) {
        //             return 'Chỉ được chọn '+e.maximum+' tỉnh/thành phố';
        //         },
        //         noResults: function (params) {
        //             return "Không tìm thấy";
        //         },
        //         searching: function () {
        //             return "Đang tìm kiếm tỉnh thành";
        //         }
        //     },
        //
        //     ajax: {
        //
        //         url: 'location/ajax/select2Search',
        //         dataType: 'json',
        //         data: function (params) {
        //             return {
        //                 loc_name: $.trim(params.term)
        //             };
        //         },
        //         processResults: function (reponse) {
        //
        //             return {
        //                 results: reponse
        //             };
        //         },
        //         cache: true
        //     }
        // }),

        $('#city_want_to_work').on("select2:select", function (e) {
            var id = $(this).val();
            var url = $(this).data('url');
            var $district = $('#district_want_to_work');

            $district.closest('.candidateBox-row').removeClass('hide').addClass('show');

            $district.data('parent-id', id);

            $.ajax({
                url: 'location/ajax/select2Search?loc_parent_id=' + id,
                type: 'GET',
                dataType: 'JSON',
                // data: {param1: 'value1'},
            })
                .done(function (reponse) {
                    var html = '';
                    $.each(reponse, function (key, item) {
                        var option = '<option value="' + item.id + '|' + item.text + '" >' + item.text + '</option>';
                        html += option;
                    });
                    $district.html(html);

                })
                .fail(function (error) {

                });

        });

        function districtSelect2(url, id) {
            $('#district_want_to_work').select2({
                placeholder: "Chọn quận/huyện bạn muốn làm việc",
                ajax: {
                    url: url,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            loc_name: $.trim(params.term),
                            loc_parent_id: id
                        };
                    },
                    processResults: function (data) {

                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                language: {
                    noResults: function (params) {
                        return "Không tìm thấy";
                    },
                    searching: function () {
                        return "Đang tìm kiếm tỉnh thành";
                    }
                }
            })
        }

        $('.career').select2({
            placeholder: 'Chọn một ngành nghề',
        });

        $('.skill').select2({

            placeholder: 'Chọn một nguồn',
            // maximumSelectionLength: 3,
            language: {
                maximumSelected: function (e) {
                    $('body').on('click', function () {
                        $('body')
                    })
                    return 'Chỉ được chọn ' + e.maximum + ' ngành nghề';
                },
                noResults: function (params) {
                    return "Không tìm thấy";
                },
                searching: function () {
                    return "Đang tìm kiếm nguồn";
                }
            },
            ajax: {
                url: $('.skill').data('url'),
                dataType: 'json',
                data: function (params) {
                    console.log(params);
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {

                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('.source').select2({
            placeholder: 'Chọn một nguồn',
            // maximumSelectionLength: 3,
            language: {

                maximumSelected: function (e) {
                    return 'Chỉ được chọn ' + e.maximum + ' ngành nghề';
                },
                noResults: function (params) {
                    return "Không tìm thấy";
                },
                searching: function () {
                    return "Đang tìm kiếm nguồn";
                }
            },
            ajax: {
                url: 'source/ajax/select2Search',
                dataType: 'json',
                data: function (params) {

                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {

                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('.select3').select2({
            placeholder: ''
        });
    },


    configAutocomplete: function () {
        $.ui.autocomplete.prototype._renderItem = function (ul, item) {
            var re = new RegExp("^" + this.term, "i");
            var t = item.label.replace(re, "<span style='font-weight:bold;color:Blue;'>" + this.term + "</span>");
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append("<a>" + t + "</a>")
                .appendTo(ul);
        };

        $("#chucdanh").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "source/ajax/select2Search",
                    dataType: "json",
                    data: request,
                    success: function (data) {
                        // console.log(data);

                        var regex = new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + request.term.replace(/([\^\$\(\)\[\]\{\}\*\.\+\?\|\\])/gi, "\\$1") + ")(?![^<>]*>)(?![^&;]+;)", "gi");
                        response($.map(data, function (item) {
                            return {
                                label: item.so_name.toString().split('|')[0].replace(regex, "<b>$1</b>"),
                                val: item.id.toString().split('|')[1]
                            }
                        }));

                    }
                });
            },

        });
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

    displayError: function (error) {
        $('.candidate-text-error').text(error);
    },

    candidateDestroy: function () {
        var $this = this;
        $('.candidate-list').find('.candidate-item-destroy').click(function () {
            var id = $(this).data('id');
            var candidateItem = $(this).closest('.candidate-item');

            $('.candidate-confirm .candidate-popup-button-trash').click(function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'candidate/ajax/delete',
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

    addSourceByCandidate: function () {
        var $this = this;

        $('button[data-btn="source"]').click(function () {
            var url= $(this).data('url');

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

    prependSkill:function (result) {
        var option = '<option value="' + result.id + '" selected >' + result.sk_name + '</option>';
        $('select[name="can_skill_id"]').prepend(option);
    },

    chooseFileExcel:function(){
        $(document).on('click','.excelForm-btn',function () {
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

    }
};

$(function () {
    Candidate.init();
})