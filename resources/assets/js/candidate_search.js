import './jquery.plugin/serializeObject';

var CandidateSearch = {
    init: function () {
        this.actionQuery();
    },

    actionQuery: function () {
        var $this = this;

        $('.candidate-sidebar').find('input[type="radio"]').off('change').change(function () {
            $this.resetPaginate();
            $(this).closest('form').submit();
        });

        $('.candidate-sidebar').find('input[type="checkbox"]').off('change').change(function () {
            $this.resetPaginate();
            $(this).closest('form').submit();
        });

        $('.candidate-sidebar').find('.datepicker').off('change').change(function () {
            $this.resetPaginate();
            $(this).closest('form').submit();
        });

        $('.candidate-sidebar').find('select').off('change').change(function () {
            $this.resetPaginate();
            $(this).closest('form').submit();
        });

        $('.candidate').find('#candidate-form-search').on('submit', function (e) {
            e.preventDefault();

            var url = $(this).data('url');

            var formData = $(this).serializeObject();

            console.log(formData.candidate_type);

            $this.getDataByAjax(url, formData);

        });

        $('.candidate').find('#candidate-form-search').submit();

    },

    resetPaginate:function(){

    },

    getDataByAjax: function (url, data) {
        var $this = this;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data
        })
            .done(function (reponse) {
                $this.renderReponse(reponse);
            })
            .fail(function (error) {
                // console.log(error);
            });

    },

    renderReponse: function (data) {
        var $this = this;

        $this.renderAggerations(data.aggerations);
        var editUrl=$('.candidate-list').data('edit-url');

        console.log(editUrl);
        // render list candidate
        var html = '';
        $.each(data.candidates, function (key, value) {
            var item = `<div class="candidate-item row" style="overflow: hidden">
                                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                            <div class="candidate-item-left">
                                                                <div class="image">
                                                                    <img class="img-responsive" src="${value.data.can_avatar}" alt="">
                                                                </div>
                                                                <div class="option">

                                                                    <div class="text-center time">
                                                                        <i class="fa fa-calendar" aria-hidden="true"></i> ${value.data.created_at}
                                                                    </div>
                                                                </div>
                                                            </div> <!-- /. candidate item left -->
                                                        </div>
                                                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                            <div class="candidate-item-main">
                                                                <div class="candidate-item-main-row">
                                                                    <h5 class="pull-left candidate-item-main-name" data-id="${value.data.id}" toggle="false">${value.data.can_name}</h5>
                                                                    <div class="dropdown pull-right">
                                                                        <button class="btn " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="${editUrl+'/'+value.data.id}" data-id="${value.data.id}">Sửa</a>
                                                                            <a class="dropdown-item" href="#" data-id="${value.data.id}" data-toggle="modal" data-backdrop="static" data-target="#candidate-confirm">Xóa</a>
                                                                            <a class="dropdown-item" href="#candidate-evaluate" data-id="${value.data.id}" data-name="${value.data.can_name}" data-avatar="${value.data.can_avatar}" data-age="${value.data.can_year}" data-title="${value.data.can_title}" data-delete-url="{{route('diary.ajax.delete')}}" data-toggle="modal" data-backdrop="static" data-target="#candidate-evaluate">Đánh giá</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div class="candidate-item-main-row row">
                                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="box ">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-globe" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="">
                                                                                <h6>${value.data.source.so_name} - ${value.data.can_title}</h6>
                                                                            </div>
                                                                        </div> <!-- /. box -->
                                                                    </div>
                                                                </div>
                                                                <div class="candidate-item-main-row row special-box">
                                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="box ">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">${value.data.can_address}</div>
                                                                        </div> <!-- /. box -->
                                                                        <div class="box ">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">${value.data.can_year}</div>
                                                                        </div> <!-- /. box -->

                                                                        <div class="box ">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">${value.data.can_phone}</div>
                                                                        </div> <!-- /. box -->
                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">${value.data.can_email}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                    </div>
                                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-skype" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">${value.data.can_skype}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->


                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">${value.data.can_facebook}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->


                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">${value.data.can_linkedin}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-github" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">${value.data.can_github}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                    </div>`;
            if (value.data.can_diary) {
                item += `

                                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 diary-box">
                                                                        <div class="row">
                                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                                <span>${value.data.can_diary.created_at}</span>
                                                                                <span class="bg-green c-white" style="background: ${value.data.can_diary.canty_color}!important;">${value.data.can_diary.canty_name}</span>
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                                @if(!empty($diary->d_evaluate))
                                                                                    <span><i class="fa fa-star" aria-hidden="true"></i></span><span> ${value.data.can_diary.d_evaluate}</span>
                                                                                    @else
                                                                                    <span class="time-expired"><i class="fa fa-clock-o"></i> ${value.data.can_diary.d_set_time}, ${value.data.can_diary.d_set_calendar}, ${value.data.can_diary.d_notice_before} </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                                <span>${value.data.can_diary.d_note}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>`;
            }

            item += `
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- /. candidate item -->`;

            html += item;
        });

        $('.candidate-list').find('#result').html(html);

        $this.renderPaginate(data.paginate);

    },

    renderPaginate: function (paginateData) {

        var searchInfo = `<b>${paginateData.first} - ${paginateData.last} </b>trong<b> ${paginateData.total} </b> ứng viên <span></span>`;

        $('.card-searchinfo').html(searchInfo);

        var totalPage = paginateData.totalPage;
        var page = parseInt($('#candidate-form-search').find('input[name="page"]').val());
        var limit = parseInt($('#candidate-form-search').find('input[name="limit"]').val());

        if (totalPage!==limit){
            var numberOfShow=2;
            var start = ((page - numberOfShow) > 0) ? (page - numberOfShow) : 1;
            var end = ((page + numberOfShow) < totalPage) ? (page+numberOfShow) : totalPage;

            var html = `<ul class="pagination"><li class="page-item"><button  class="page-link"  data-page="${page <=1 ? 1 : (page - 1)}" >Prev</button></li>`;

            if (start > 1) {
                html += `<li class="page-item"><button class="page-link" data-page="1">1</button></li>`;
                html += `<li class="disabled"><span class="page-link">...</span></li>`;
            }

            for (var i = start; i <= end; i++) {
                if (page == i) {
                    html += `<li class="page-item active"><button data-page="${i}" class="page-link">${i}</button></li>`;
                } else {
                    html += `<li class="page-item"><button class="page-link" data-page="${i}">${i}</button></li>`;
                }
            }

            if (end < totalPage) {
                html += `<li class="disabled"><span class="page-link">...</span></li>`;
                html += `<li class="page-item"><button class="page-link" data-page="${totalPage}" >${totalPage}</button></li>`;
            }

            html += `<li class="page-item"><button data-page="${(page >= totalPage) ? totalPage : page + 1}" class="page-link" >Next</button></li></ul>`;

            html += '</ul>';

            $('.candidate').find('.card-footer').html(html);
        }

        $('.candidate .pagination button').on('click', function () {
            var page = $(this).data('page');

            $('#candidate-form-search').find('input[name="page"]').val(page);

            $('#candidate-form-search').submit();
        });

    },

    renderAggerations:function(aggData){

        let latest_diary_d_cantype_id=aggData.latest_diary_d_cantype_id;
        let can_source_id=aggData.can_source_id;
        let latest_diary_d_evaluate=aggData.latest_diary_d_evaluate;
        let candidate_info_ci_type_of_work=aggData.candidate_info_ci_type_of_work;

        $('#latest_diary_d_cantype_id li').each(function () {
            let index= $(this).index();
            let item=$(this).find('.badge');
            let flag=true;

            $.each(latest_diary_d_cantype_id,function (i,val) {
                if (index+1==val.key){

                    $('#latest_diary_d_cantype_id li').eq(index).find('.badge').html(val.doc_count);
                    flag=false;
                }
            });

            if (flag==true){
                item.html(0);
            }

        });

        let start=3;

        $('#can_source_id li').each(function () {
            let index = $(this).index();
            let item = $(this).find('.badge');
            let flag = true;

            $.each(can_source_id, function (i, val) {
                if (start == val.key) {

                    $('#can_source_id li').eq(index).find('.badge').html(val.doc_count);
                    flag = false;
                }
            });

            if (flag == true) {
                item.html(0);
            }

            start++;

        });

        $('#latest_diary_d_evaluate li').each(function () {
            let index = $(this).index();
            let item = $(this).find('.badge');
            let flag = true;

            $.each(latest_diary_d_evaluate, function (i, val) {
                if (index + 1 == val.key) {

                    $('#latest_diary_d_evaluate li').eq(index).find('.badge').html(val.doc_count);
                    flag = false;
                }
            });

            if (flag == true) {
                item.html(0);
            }

        });

        $('#candidate_info_ci_type_of_work li').each(function () {
            let index = $(this).index();
            let item = $(this).find('.badge');
            let flag = true;

            $.each(candidate_info_ci_type_of_work, function (i, val) {
                if (index == val.key) {

                    $('#candidate_info_ci_type_of_work li').eq(index).find('.badge').html(val.doc_count);
                    flag = false;
                }
            });

            if (flag == true) {
                item.html(0);
            }

        });


    }


}

$(function () {
    CandidateSearch.init();
});