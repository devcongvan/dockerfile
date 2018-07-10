import 'simplebar/dist/simplebar';
import toastr from "toastr/build/toastr.min";

var CandidateDiary={

    candidateId:0,

    init:function () {
        this.composerEffect();
        this.listScroll();
        this.autoSendMail();
        this.toggleSendMail();
        this.switchEvaluateTab();
        this.checkMailItem();
        this.pinItem();
        this.changeCandidateType();
        this.scrollTopBottomDiary();
        this.confirm();
        this.pushDiary();
    },

    composerEffect:function () {
        var $this=this;
        var mainHeight = $('.candidate-evaluate-main').height();
        $('a[href="#candidate-evaluate"]').click(function () {
            $this.candidateId=$(this).data('id');
            $this.rate();
            setTimeout(function () {
                var listHeight = $('.candidate-evaluate-main-diary-list').height();
                $('.candidate-evaluate-main-diary-list-scroll').scrollTop($('.candidate-evaluate-main-diary-list-scroll')[0].scrollHeight);

                $('.candidate-evaluate-main-diary-composer').off('mouseenter').on('mouseenter', function () {

                    $('.candidate-evaluate-main-diary-list-scroll').animate({
                        height: '460px'
                    }, 300);

                    $(this).animate({
                        height: '100px'
                    }, 300);
                    $('.candidate-evaluate-main-diary-list .option').animate({
                        bottom:'55px'
                    });

                });

                $('.candidate-evaluate-main-diary-composer').off('mouseleave').on('mouseleave', function () {
                        if ($('.candidate-evaluate-main-diary-composer').data('click')==false){
                            $('.candidate-evaluate-main-diary-list-scroll').animate({
                                height: '488px'
                            }, 300);

                            $(this).animate({
                                height: '53px'
                            }, 300);
                            $('.candidate-evaluate-main-diary-list .option').animate({
                                bottom:'10px'
                            })
                        }
                });

                $('.candidate-evaluate-main-diary-composer').off('click').click(function () {
                    $(this).data('click',true);
                    $(this).addClass('hover');
                    $('.candidate-evaluate-main-diary-list-scroll').animate({
                        scrollTop:$('.candidate-evaluate-main-diary-list-scroll')[0].scrollHeight
                    });

                });

                    $(document).click(function(event) {
                        if (!$(event.target).closest(".candidate-evaluate-main-diary-composer").length) {
                            $('.candidate-evaluate-main-diary-composer').data('click',false);
                            $('.candidate-evaluate-main-diary-list-scroll').animate({
                                height: '488px'
                            }, 300);

                            $('.candidate-evaluate-main-diary-composer').animate({
                                height: '53px'
                            })
                            $('.candidate-evaluate-main-diary-composer').removeClass('hover');
                            $('.candidate-evaluate-main-diary-list .option').animate({
                                bottom:'10px'
                            })
                        }
                    });

            },300);

        })
    },

    listScroll:function () {
        var listHeight=$('.candidate-evaluate-main-diary-list').height();
    },

    autoSendMail:function(){
        var $this=this;

        $('#toggle').click(function () {
            if ($(this).data('toggle')=='off'){
                $(this).find('.fa').removeClass('fa-toggle-off');
                $(this).find('.fa').addClass('fa-toggle-on');
                $('.autosendmail').animate({
                    height:'55px'
                });
                $('.ql-editor').animate({
                    height:'230px'
                });

                $(this).data('toggle','on')
            }else if ($(this).data('toggle')=='on'){
                $(this).find('.fa').addClass('fa-toggle-off');
                $(this).find('.fa').removeClass('fa-toggle-on');
                $('.autosendmail').animate({
                    height:'25px'
                });
                $('.ql-editor').animate({
                    height:'260px'
                });

                $(this).data('toggle','off');
            }
        })
    },

    toggleSendMail:function(){
        $('.candidate-evaluate-main-mail-list').find('.option').click(function(){
            if ($(this).data('toggle')==true){
                $('.candidate-evaluate-main-mail-sendmail').animate({
                    width:'-2%',
                    opacity:0
                });
                $('.candidate-evaluate-main-mail-list').animate({
                    width:'100%',
                    opacity:1
                });
                $(this).data('toggle',false)
            }else if ($(this).data('toggle')==false){
                $('.candidate-evaluate-main-mail-sendmail').animate({
                    width:'50%',
                    opacity:1
                });
                $('.candidate-evaluate-main-mail-list').animate({
                    width:'50%'
                });
                $(this).data('toggle',true)
            }
        });

        $('.candidate-evaluate-main-mail-top .close').click(function(e){
            e.preventDefault();
            $('.candidate-evaluate-main-mail-sendmail').animate({
                width: '-2%',
                opacity: 0
            });
            $('.candidate-evaluate-main-mail-list').animate({
                width: '100%',
            });
            $('.candidate-evaluate-main-mail-list .option').data('toggle', false)
        })
    },

    switchEvaluateTab:function(){
        $('.candidate-evaluate-sidebar').find('.nav-item').click(function () {
            $('.candidate-evaluate-sidebar').find('.nav-item').removeClass('active');
            $('.candidate-evaluate-sidebar').find('.nav-item').each(function () {
                $('.'+$(this).data('tab')).addClass('slide-out');
            });
            $(this).addClass('active');
            var tab=$(this).data('tab');
            $('.'+tab).removeClass('slide-out');

        })
    },

    checkMailItem:function(){
        $('.checkall-bar input').on('change',function () {
            if ($(this).prop('checked')==true){
                $('.item-checkbox input').prop('checked',true);
            }else{
                $('.item-checkbox input').prop('checked',false);
            }
        })
    },

    pinItem:function () {
        $('.mail-item-pin').on('click',function(e){
            e.preventDefault();
            var index=$(this).closest('.candidate-evaluate-main-mail-item').index();
            $(this).data('index',)
            var candidate_evaluate_main_mail_item=$(this).closest('.candidate-evaluate-main-mail-item');
            candidate_evaluate_main_mail_item.find('.mail-item-pin').addClass('active');
            $(this).closest('.candidate-evaluate-main-mail-item').remove();
            $('.candidate-evaluate-main-mail-list-content').prepend(candidate_evaluate_main_mail_item);
            $(this).addClass('active');


        })
    },

    changeCandidateType:function () {
        var $this=this;
        var flag=false;
        $('.candidate-evaluate-main-diary-list #dropdownMenuButton').click(function (e) {
            e.preventDefault();
            var dropDownMenuButton=$(this);
            var url=$(this).data('url');
            var dataRender=$(this).data('render');
            var dropDownItemLength=$('.list-type .dropdown-item').length;

            if (flag==false&&dropDownItemLength==0){
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    // data: {param1: 'value1'},
                })
                    .done(function(reponse) {
                        $this.renderCandidateType(reponse.candidate_types);
                        flag=true;
                    })
                    .fail(function(error) {

                    });
            }



        });

    },

    renderCandidateType:function(data){
        var html='';
        $.each(data,function(index,item){
            var dropitem='<a class="dropdown-item" data-type="tiemnang" href="#" data-id="'+item.id+'"><i class="fa fa-circle" style="color: '+item.canty_color+'" aria-hidden="true"></i> '+item.canty_name+'</a>';
            html+=dropitem;
        });
        $('.candidate-evaluate-main-diary-list .dropdown-menu').html(html);

        $('.candidate-evaluate-main-diary-list .list-type .dropdown-item').bind('click',function(e){
            e.preventDefault();
            var candidateTypeId=$(this).data('id');
            $('.candidate-evaluate-main-diary-composer-push').data('candidate-type-id',candidateTypeId);
            if (candidateTypeId=='1'){
                $('.rate').css('display','flex');
                $('.set-calendar').css('display','none');
            }else{
                $('.rate').css('display','none');
                $('.set-calendar').css('display','flex');
            }
        })
    },

    scrollTopBottomDiary:function () {
        $('#updown').click(function(e){
            e.preventDefault();
            var typeScroll=$(this).data('scroll');

            if (typeScroll=='bottom'){
                $(this).find('.fa').removeClass('fa-chevron-circle-up');
                $(this).find('.fa').addClass('fa-chevron-circle-down');
                $('.candidate-evaluate-main-diary-list-scroll').animate({
                    scrollTop:50
                });
                $(this).data('scroll','top');
            }else if(typeScroll=='top'){
                $(this).find('.fa').removeClass('fa-chevron-circle-down');
                $(this).find('.fa').addClass('fa-chevron-circle-up');
                $('.candidate-evaluate-main-diary-list-scroll').animate({
                    scrollTop:$('.candidate-evaluate-main-diary-list-scroll')[0].scrollHeight
                });
                $(this).data('scroll','bottom');
            }

        });
    },

    confirm:function () {
        $('.candidate-evaluate-confirm').find('.btn-close').click(function () {

            $('.candidate-evaluate-confirm').addClass('hide');

            $('.candidate-evaluate-overlay').addClass('hide');

        });

        $('.candidate-evaluate-alert').find('.btn-close').click(function () {

            $('.candidate-evaluate-overlay').addClass('hide');

            $('.candidate-evaluate-alert').addClass('hide');

        });

        $('.dropdown-item[data-confirm="diary"]').on('click',function (e) {
            e.preventDefault();
            alert();
            $('.candidate-evaluate-confirm').removeClass('hide');
            $('.candidate-evaluate-overlay').removeClass('hide');
            $('.candidate-evaluate-confirm').find('.modal-body').html('Bạn có muốn xóa nhật ký này không?');
        });

        $('a[data-confirm="mail"]').click(function(e){
            e.preventDefault();
            var mailCheckLenght=$('input[name="mail_item[]"]:checked').length;
            if (mailCheckLenght==0){
                $('.candidate-evaluate-overlay').removeClass('hide');
                $('.candidate-evaluate-alert').removeClass('hide');
                $('.candidate-evaluate-alert .modal-body').html('Bạn chưa chọn Mail nào');

            }else{
                $('.candidate-evaluate-overlay').removeClass('hide');
                $('.candidate-evaluate-confirm').removeClass('hide');
                $('.candidate-evaluate-confirm').find('.modal-body').html('Bạn có muốn xóa '+mailCheckLenght+' Mail này không?');

            }

        })
    },

    rate:function(){
        var list_candidate_rate=[];
        $.getJSON( "json/candidate_rate.json", function( data ) {
            var items = [];

            list_candidate_rate=data;

            $(document).on('mouseover', '.rateCandidate-item', function () {
                var onStar = $(this).data('value'); // The star currently mouse on
                $('.rateCandidate-text').html(data[onStar].name);
                $('.rateCandidate-scrore').val(onStar);

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('.rateCandidate-item').each(function (e) {
                    if (e < onStar) {
                        $(this).addClass('rateCandidate-check');
                    }
                    else {
                        $(this).removeClass('rateCandidate-check');
                    }
                });

                $(this).parent().children('.rateskill-input').val(onStar);
            }).on('mouseout', function () {
                $(this).parent().children('.rateCandidate-item').each(function (e) {
                    $(this).removeClass('rateCandidate-check');
                });
            });

        });




    },

    pushDiary:function () {
        var $this=this;
        $('.candidate-evaluate-main-diary-composer-push').click(function(e){
            e.preventDefault();
            var rateCandidateScore=$('.rateCandidate-scrore').val();
            var candidateTypeId=$(this).data('candidate-type-id');

            if (candidateTypeId==0){
                $('.candidate-evaluate-overlay').removeClass('hide');
                $('.candidate-evaluate-alert').removeClass('hide');
                $('.candidate-evaluate-alert .modal-body').html('Bạn chưa chọn loại ứng viên');
            }else{
                var url=$(this).data('url');
                var data= {
                    'd_cantype_id': candidateTypeId,
                    'd_can_id': $this.candidateId,
                    'd_evaluate':$('.rateCandidate-scrore').val(),
                    'd_set_calendar':$('input[name="set-calendar-date"]').val(),
                    'd_set_time':$('input[name="set-calendar-time"]').val(),
                    'd_notice_before':$('select[name="set-calendar-before"]').val(),
                    'd_note':$('textarea[name="note"]').val()
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {data: data},
                })
                    .done(function(reponse) {
                        $this.displayAlert(reponse.message);
                    })
                    .fail(function(error) {
                        $this.displayAlert(error.message,'error');
                    });


            }
        })
    },

    appendDiaryItem:function(data){
        var item='<div class="diary-item row">\n' +
            '                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">\n' +
            '                                            <div class="diary-item-avatar">\n' +
            '                                                <div class="img">\n' +
            '                                                    <img class="img-reponsive" src="upload/avatar/228161052_hotgirl-reuters-kieu-trinh6-1496928968014.jpg" alt="">\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">\n' +
            '                                            <div class="diary-item-main">\n' +
            '                                                <div class="diary-item-header">\n' +
            '                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-red c-white">Ứng viên đang bận</span>\n' +
            '                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>\n' +
            '                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">\n' +
            '                                                        <a class="dropdown-item" href="#" data-confirm="diary" data-id="16">Xóa</a>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                                <div class="diary-item-rate">\n' +
            '\n' +
            '                                                </div>\n' +
            '                                                <div class="bg">\n' +
            '                                                    <div class="diary-item-notice">\n' +
            '                                                        <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ lại cho ứng viên</span>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="diary-item-note">\n' +
            '                                                        Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>';

        $('.')

    },

    displayAlert: function (message, type = 'success') {

        toastr[type](message);

    },




}

$(function () {
   CandidateDiary.init();
});