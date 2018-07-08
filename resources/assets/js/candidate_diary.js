import 'simplebar/dist/simplebar';

var CandidateDiary={

    init:function () {
        this.composerEffect();
        this.listScroll();
        this.autoSendMail();
        this.toggleSendMail();
        this.switchEvaluateTab();
        this.checkMailItem();
        this.pinItem();
    },

    composerEffect:function () {

        var mainHeight = $('.candidate-evaluate-main').height();
        $('a[href="#candidate-evaluate"]').click(function () {
            setTimeout(function () {
                var listHeight = $('.candidate-evaluate-main-diary-list').height();
                $('.candidate-evaluate-main-diary-list-scroll').scrollTop($('.candidate-evaluate-main-diary-list-scroll')[0].scrollHeight);

                $('.candidate-evaluate-main-diary-composer').off('mouseenter').on('mouseenter', function () {
                    var composerHeight = $(this).height();
                    $('.candidate-evaluate-main-diary-list').animate({
                        height: mainHeight - composerHeight + 'px'
                    }, 300);
                    $('.candidate-evaluate-main-diary-list-scroll').animate({
                        height: mainHeight - composerHeight + 'px'
                    }, 300);

                });

                $('.candidate-evaluate-main-diary-composer').off('mouseleave').on('mouseleave', function () {
                        if ($('.candidate-evaluate-main-diary-composer').data('click')==false){
                            $('.candidate-evaluate-main-diary-list').animate({
                                height: listHeight + 'px'
                            }, 300);
                            $('.candidate-evaluate-main-diary-list-scroll').animate({
                                height: listHeight + 'px'
                            }, 300);

                        }
                });

                $('.candidate-evaluate-main-diary-composer').off('click').click(function () {
                    $(this).data('click',true);
                    $(this).addClass('hover');
                    $('.candidate-evaluate-main-diary-list-scroll').scrollTop($('.candidate-evaluate-main-diary-list-scroll')[0].scrollHeight);

                });

                    $(document).click(function(event) {
                        if (!$(event.target).closest(".candidate-evaluate-main-diary-composer").length) {
                            $('.candidate-evaluate-main-diary-composer').data('click',false);
                            $('.candidate-evaluate-main-diary-list, .candidate-evaluate-main-diary-list-scroll').animate({
                                height: listHeight + 'px'
                            }, 300);
                            $('.candidate-evaluate-main-diary-composer').removeClass('hover');
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
                    height:'240px'
                });

                $(this).data('toggle','on')
            }else if ($(this).data('toggle')=='on'){
                $(this).find('.fa').addClass('fa-toggle-off');
                $(this).find('.fa').removeClass('fa-toggle-on');
                $('.autosendmail').animate({
                    height:'25px'
                });
                $('.ql-editor').animate({
                    height:'270px'
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
    }
}

$(function () {
   CandidateDiary.init();
});