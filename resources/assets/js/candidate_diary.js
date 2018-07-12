import 'simplebar/dist/simplebar';
import toastr from "toastr/build/toastr.min";

var CandidateDiary={

    candidateId:0,
    lazyLoadDiaryFlag:true,
    lazyLoadAlreadyLoad:true,
    candidateTypeId:0,

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
        this.closeCandidatePopup();
        this.timepicker();
    },

    closeCandidatePopup:function(){
        var $this=this;
        $('.candidate-evaluate-header-control-item').find('.off').click(function(e){
            e.preventDefault();

            $this.candidateTypeId=0;

            $this.repository=$('.candidate-evaluate-main-diary-list-scroll').html();

            $this.lazyLoadAlreadyLoad=false;
            $this.lazyLoadDiaryFlag=false;

        })
    },

    deleteURL:'',

    composerEffect:function () {
        var $this=this;

        var mainHeight = $('.candidate-evaluate-main').height();
        $('.candidate-item a[data-target="#candidate-evaluate"]').click(function () {
            $this.deleteURL=$(this).data('delete-url');
            var can_info=$(this).data('name')+', '+$(this).data('name')+', '+$(this).data('title');
            $('.candidate-evaluate-header-info').html(can_info);

            var avatar=$(this).data('avatar');
            $('.candidate-evaluate-header-avatar').find('img').attr('src',avatar);
            var canId=$(this).data('id');

            $('.candidate-evaluate-main-diary-list-scroll').off('scroll');
            if (canId!=$this.candidateId) {
                $('.candidate-evaluate-main-diary-list-scroll.scroll').html('');
                $('.candidate-evaluate-main-diary-list-scroll').height(400);
                $('.candidate-evaluate-main-diary-list-scroll').scrollTop($('.candidate-evaluate-main-diary-list-scroll')[0].scrollHeight);
            }

            $this.lazyLoadAlreadyLoad=true;
            $this.lazyLoadDiaryFlag=true;

            $this.lazyLoadDiaryList(canId);
            $this.rate();
            setTimeout(function () {

                $('.candidate-evaluate-main-diary-list-scroll').height(500);
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
                        if (!$(event.target).closest(".candidate-evaluate-main-diary-composer, .wickedpicker").length) {
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

            },200);

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
        $('.candidate-evaluate-main-diary-list .option #dropdownMenuButton').click(function (e) {
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
        $('.candidate-evaluate-main-diary-list .option .dropdown-menu').html(html);

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
        var $this=this;
        $('.candidate-evaluate-confirm').find('.btn-close').click(function () {

            $('.candidate-evaluate-confirm').addClass('hide');

            $('.candidate-evaluate-overlay').addClass('hide');

        });

        $('.candidate-evaluate-alert').find('.btn-close').click(function () {

            $('.candidate-evaluate-overlay').addClass('hide');

            $('.candidate-evaluate-alert').addClass('hide');

        });

        $(document).on('click','.dropdown-item[data-confirm="diary"]',function (e) {
            e.preventDefault();

            var diaryId=$(this).data('id');

            var diaryIndex=$(this).closest('.diary-item').index();

            $('.candidate-evaluate-confirm').removeClass('hide');
            $('.candidate-evaluate-overlay').removeClass('hide');
            $('.candidate-evaluate-confirm').find('.modal-body').html('Bạn có muốn xóa nhật ký này không?');

            $('.candidate-evaluate-confirm .btn-delete').off('click').click(function(){

                $this.removeAnDiaryItem(diaryId,diaryIndex);

            });
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

    removeAnDiaryItem:function(diaryId,diaryIndex){
        var $this=this;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $this.deleteURL,
            type: 'POST',
            dataType: 'JSON',
            data: {id: diaryId },
        })
            .done(function(reponse) {
                console.log(reponse);
                $('.candidate-evaluate-confirm').addClass('hide');
                $('.candidate-evaluate-overlay').addClass('hide');

                if (reponse.type=='success'){

                    $('.candidate-evaluate-main-diary-list-scroll').children('div').eq(diaryIndex).animate({
                        height:0,
                        padding:0
                    },500);

                    if (reponse.prev.d_breaktime!==null&&reponse.next.d_breaktime!==null){
                        diaryIndex++;
                        $('.candidate-evaluate-main-diary-list-scroll').children('div').eq(diaryIndex).remove();
                    }

                }
                $this.displayAlert(reponse.message,reponse.type);
            })
            .fail(function(error) {
                console.log(error);
            });

    },

    rate:function(){
        var list_candidate_rate=[];
        $.getJSON( "json/candidate_rate.json", function( data ) {
            var items = [];

            list_candidate_rate=data;

            $(document).on('mouseover', '.rateCandidate-item', function () {
                var onStar = $(this).data('value'); // The star currently mouse on
                $('.rateCandidate-text').html(data[onStar].name);
                $('.rateCandidate-scrore').val(data[onStar].name);

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
        var flag=false;

        $('.candidate-evaluate-main-diary-composer-push').off('click').click(function(e){
            e.preventDefault();
            var rateCandidateScore=$('.rateCandidate-scrore').val();
            $this.candidateTypeId=$(this).data('candidate-type-id');
            if ($this.candidateTypeId==0){
                $('.candidate-evaluate-overlay').removeClass('hide');
                $('.candidate-evaluate-alert').removeClass('hide');
                $('.candidate-evaluate-alert .modal-body').html('Bạn chưa chọn loại ứng viên');
            }else{
                console.log($('input[name="set-calendar-date"]').val());
                if ($('input[name="set-calendar-date"]').val()===''&&$('input[name="set-calendar-time"]').val()===''&&$('select[name="set-calendar-before"]').val()===''&&$('textarea[name="note"]').val()===''&&$('.rateCandidate-scrore').val()===''){
                    $('.candidate-evaluate-overlay').removeClass('hide');
                    $('.candidate-evaluate-alert').removeClass('hide');
                    $('.candidate-evaluate-alert .modal-body').html('Bạn chưa nhập dữ liệu');

                }else{
                    var url=$(this).data('url');
                    var data= {
                        'd_cantype_id': $this.candidateTypeId,
                        'd_can_id': $this.candidateId,
                        'd_evaluate':$('.rateCandidate-scrore').val(),
                        'd_set_calendar':$('input[name="set-calendar-date"]').val(),
                        'd_set_time':$('input[name="set-calendar-time"]').val(),
                        'd_notice_before':$('select[name="set-calendar-before"]').val(),
                        'd_note':$('textarea[name="note"]').val(),
                    };

                    if (flag==true){
                        return false;
                    }
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
                            $this.appendDiaryItem(reponse);
                            flag=false;
                        })
                        .fail(function(error) {

                            $this.displayAlert('Đã có lỗi xảy ra. Vui lòng kiểm tra lại các trường đã nhập','error');
                        });
                    flag=false;
                }



            }
        })
    },

    appendDiaryItem:function(data){
        var $this=this;

        $this.clearField();
        $('.candidate-evaluate-main-diary-list-scroll').animate({
            scrollTop:$('.candidate-evaluate-main-diary-list-scroll')[0].scrollHeight
        });
        var item='';
        var d=new Date(data.result.created_at);
        if (data.breaktime!==false){
            item+=`<div class="month-break" month="${data.breaktime.d_breaktime}"></div>`;
        }
        if (data.result.d_evaluate==null){

            item+='<div class="diary-item row">\n' +
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
                '                                                    <span>Nguyễn HR, </span><span>'+(d.getDate())+'/'+(d.getMonth()+1)+'/'+d.getFullYear()+'</span><span class="bg-aqua c-white" style="background: '+data.candidateType.canty_color+'!important;">'+data.candidateType.canty_name+'</span>\n' +
                '                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>\n' +
                '                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">\n' +
                '                                                        <a class="dropdown-item" href="#" data-confirm="diary" data-url="'+$this.deleteURL+'" data-id="'+data.result.id+'">Xóa</a>\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="diary-item-rate">\n' +
                '\n' +
                '                                                </div>\n' +
                '                                                <div class="bg">\n' +
                '                                                    <div class="diary-item-notice">\n' +
                '                                                        <span><i class="fa fa-clock-o"></i> '+data.result.d_set_calendar+', '+data.result.d_set_time+' ,'+data.result.d_notice_before+' </span>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="diary-item-note">\n' +
                '                                                        '+data.result.d_note+'\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                    </div>';

        }else{
            item+=`
                <div class="diary-item row">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                        <div class="diary-item-avatar">
                            <div class="img">
                                <img class="img-reponsive" src="upload/avatar/228161052_hotgirl-reuters-kieu-trinh6-1496928968014.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                        <div class="diary-item-main">
                            <div class="diary-item-header">
                                <span>Nguyễn HR, </span><span>${(d.getDate())}/${(d.getMonth()+1)}/${d.getFullYear()}</span><span class="bg-green c-white" style="${data.candidateType.canty_color}!important">${data.candidateType.canty_name}</span>
                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                    <a class="dropdown-item" data-confirm="diary" href="#" data-url="${$this.deleteURL}" data-id="${data.result.id}">Xóa</a>
                                </div>
                            </div>
                            <div class="bg">
                                <div class="diary-item-rate">
                                    <span><i class="fa fa-star" aria-hidden="true"></i></span><span> ${data.result.d_evaluate}</span>
                                </div>
                                <div class="diary-item-notice">

                                </div>
                                <div class="diary-item-note">
                                    ${data.result.d_note}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>            
            `;
        }


        $('.candidate-evaluate-main-diary-list-scroll').append(item);


    },

    displayAlert: function (message, type = 'success') {
        toastr[type](message);
    },

    clearField:function () {
            $('.rateCandidate-scrore').val('');
            $('input[name="set-calendar-date"]').val('');
            $('input[name="set-calendar-time"]').val('');
            $('select[name="set-calendar-before"]').val('');
            $('textarea[name="note"]').val('');
            $('.rateCandidate-item').removeClass('rateCandidate-check')
    },
    
    lazyLoadDiaryList:function (id) {
        var $this=this;
        var url=$('.candidate-evaluate-main-diary-list-scroll').data('url');
        var page=1;
        var diaryListSrollTop=$('.candidate-evaluate-main-diary-list-scroll').scrollTop();

        if (id!=$this.candidateId) {
            if ($this.lazyLoadDiaryFlag == true) {
                $this.lazyLoadDiaryListAjax(id, url);
            }

            $('.candidate-evaluate-main-diary-list-scroll').scroll(function () {

                if ($(this).scrollTop() == 0) {
                    page++;
                    $this.lazyLoadDiaryListAjax(id, url, page);
                }
            });
        }
        $this.candidateId=id;
    },

    lazyLoadDiaryListAjax(id,url,page=1){
        var $this=this;
        var limit=10;
        var start=(page-1)*limit;

        if ($this.lazyLoadDiaryFlag==true){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'd_can_id':id,
                    'limit':limit,
                    'start':start
                },
                beforeSend:function () {
                    
                }
            })
                .done(function(reponse) {
                    console.log(reponse);
                    var result=reponse.result.reverse();
                    $('.candidate-evaluate-main-diary-list-scroll').prepend($this.renderDiaryList(result));

                    if (reponse.result.length<limit){
                        $this.lazyLoadDiaryFlag=false;
                    }
                })
                .fail(function(error) {

                });
        }else{
            if ($this.lazyLoadAlreadyLoad==true){

                var html='<div class="candidate-evaluate-loading padding-md">Đã tải hết dữ liệu</div>';
                $('.candidate-evaluate-main-diary-list-scroll').prepend(html);

                $this.lazyLoadAlreadyLoad=false;
            }

        }

    },

    renderDiaryList:function (data) {
        var $this=this;
        var html='';
        $.each(data,function (index,item) {
            if (item.d_breaktime!==null){

                var diaryItem='<div class="month-break " month="'+item.d_breaktime+'"></div>';
            }else{
                var d=new Date(item.created_at);
                if (item.d_evaluate==null){
                    var diaryItem='<div class="diary-item row">\n' +
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
                        '                                                    <span>Nguyễn HR, </span><span>'+(d.getDate())+'/'+(d.getMonth()+1)+'/'+d.getFullYear()+'</span><span class="bg-aqua c-white" style="background: '+item.candidate_type.canty_color+'!important;">'+item.candidate_type.canty_name+'</span>\n' +
                        '                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>\n' +
                        '                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">\n' +
                        '                                                        <a class="dropdown-item" href="#" data-confirm="diary" data-url="'+$this.deleteURL+'" data-id="'+item.id+'">Xóa</a>\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                                <div class="diary-item-rate">\n' +
                        '\n' +
                        '                                                </div>\n' +
                        '                                                <div class="bg">\n' +
                        '                                                    <div class="diary-item-notice">\n' +
                        '                                                        <span><i class="fa fa-clock-o"></i> '+item.d_set_calendar+', '+item.d_set_time+' ,'+item.d_notice_before+' </span>\n' +
                        '                                                    </div>\n' +
                        '                                                    <div class="diary-item-note">\n' +
                        '                                                        '+item.d_note+'\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                            </div>\n' +
                        '                                        </div>\n' +
                        '                                    </div>';

                }else{
                    var diaryItem='<div class="diary-item row">\n' +
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
                        '                                                    <span>Nguyễn HR, </span><span>'+(d.getDate())+'/'+(d.getMonth()+1)+'/'+d.getFullYear()+'</span><span class="bg-green c-white" style="background: '+item.candidate_type.canty_color+'!important;">'+item.candidate_type.canty_name+'</span>\n' +
                        '                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>\n' +
                        '                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">\n' +
                        '                                                        <a class="dropdown-item" data-confirm="diary" href="#" data-url="'+$this.deleteURL+'"  data-id="'+item.id+'">Xóa</a>\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                                <div class="bg">\n' +
                        '                                                    <div class="diary-item-rate">\n' +
                        '                                                        <span><i class="fa fa-star" aria-hidden="true"></i></span><span> '+item.d_evaluate+'</span>\n' +
                        '                                                    </div>\n' +
                        '                                                    <div class="diary-item-notice">\n' +
                        '\n' +
                        '                                                    </div>\n' +
                        '                                                    <div class="diary-item-note">\n' +
                        '                                                        '+item.d_note+'\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '\n' +
                        '                                            </div>\n' +
                        '                                        </div>\n' +
                        '                                    </div>';
                }
            }
            html+=diaryItem;
        });


        var itemHeight=$('.diary-item-main').height();
        $('.candidate-evaluate-main-diary-list-scroll').scrollTop(itemHeight);

        return html;

    },
    
    timepicker:function () {

        var options={
            title:'Chọn giờ',

        }

        $('.timepicker').wickedpicker(options);
    }




}

$(function () {
   CandidateDiary.init();
});