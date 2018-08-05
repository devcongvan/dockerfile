@extends('layout.master')

@section('title')
    Danh sách ứng viên
@endsection

@section('content')
    @php $update='Đang cập nhật' @endphp
        <div class="content-wrapper candidate">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Danh sách ứng viên</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('candidate.new')}}" class="btn btn-default btn-common "><i class="fa fa-plus" aria-hidden="true"></i> Thêm ứng viên</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12">
                        <!-- Custom tabs (Charts with tabs)-->

                        <div class="card ">
                            <form id="exportpdf-form" action="{{route('candidate.exportt')}}" method="post">
                                @csrf
                                <input type="hidden" id="exportpdf-form-html" name="html" value="">
                            </form>
                            <form action="" method="post" id="candidate-form-search" data-url="{{route('candidate.ajax.search')}}" data-showcandidate-url="{{route('candidate.ajax.show')}}">
                                <input type="hidden" name="limit" value="15" >
                                <input type="hidden" name="page" value="1" >
                            <div class=" p-0 row">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" name="candidate_name" class="form-group" value="{{$candidate_name or ''}}" placeholder="Gõ tên Ứng viên để tìm kiếm">
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" name="candidate_title" id="vitricongviec" value="{{$candidate_title or ''}}" class="form-group" placeholder="Vị trí như: Lập trình viên, ...">
                                </div>
                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                    <button type="submit" id="btn-search" class="btn btn-default full-width  btn-common"> Tìm kiếm</button>
                                </div>

                            </div><!-- /.card-header -->
                            {{--@if($total=$candidates->totalHits())--}}
                                <div class="card-searchinfo">
                                    {{--<b>{{$paginate['first']}} - {{$paginate['last']}} </b>trong<b> {{$paginate['total']}} </b> ứng viên <span></span>--}}
                                </div>
                            {{--@endif--}}
                            <div class="card-body candidate-list" data-edit-url="{{route('candidate.edit',['id'=>'/'])}}" data-delete-url="{{route('candidate.ajax.delete')}}">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 candidate-main">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="result">
                                            {{--@isset($candidates)--}}
                                                {{--@php $notdata='Chưa có dữ liệu'; @endphp--}}
                                                {{--@foreach($candidates as $test)--}}

                                                    {{--@php $item=$test->data @endphp--}}
                                                    {{--<div class="candidate-item row" style="overflow: hidden">--}}
                                                        {{--<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">--}}
                                                            {{--<div class="candidate-item-left">--}}
                                                                {{--<div class="image">--}}
                                                                    {{--<img class="img-responsive" src="{{$item['can_avatar'] or ''}}" alt="">--}}
                                                                {{--</div>--}}
                                                                {{--<div class="option">--}}
                                                                    {{--<a href="" style="background: #808080;color: #fff;" class="btn btn-default candidate-item-edit" data-id=""><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>--}}
                                                                    {{--<button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default candidate-item-destroy" data-id="" data-toggle="modal" data-backdrop="static" data-target="#candidate-confirm" ><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>--}}
                                                                    {{--<div class="text-center time">--}}
                                                                        {{--<i class="fa fa-calendar" aria-hidden="true"></i> {{date("d-m-Y", strtotime($item['updated_at']))}}--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</div> <!-- /. candidate item left -->--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">--}}
                                                            {{--<div class="candidate-item-main">--}}
                                                                {{--<div class="candidate-item-main-row">--}}
                                                                    {{--<h5 class="pull-left candidate-item-main-name" data-id="{{$item['id']}}" toggle="false">{{$item['can_name']}}</h5>--}}
                                                                    {{--<div class="dropdown pull-right">--}}
                                                                        {{--<button class="btn " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                                            {{--<i class="fa fa-ellipsis-h" aria-hidden="true"></i>--}}
                                                                        {{--</button>--}}
                                                                        {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                                                            {{--<a class="dropdown-item" href="{{route('candidate.edit',['id'=>$item['id']])}}" data-id="{{$item['id']}}">Sửa</a>--}}
                                                                            {{--<a class="dropdown-item" href="#" data-id="{{$item['id']}}" data-toggle="modal" data-backdrop="static" data-target="#candidate-confirm">Xóa</a>--}}
                                                                            {{--<a class="dropdown-item" href="#candidate-evaluate" data-id="{{$item['id']}}" data-name="{{$item['can_name']}}" data-avatar="{{$item['can_avatar']}}" data-age="{{!empty($item['can_year'])?(date('Y')-$item['can_year']).' tuổi':(!empty($item['can_birthday'])?floor((time() - strtotime($item['can_birthday'])) / (60*60*24*365)).' tuổi':$notdata)}}" data-title="{{!empty($item['can_title'])?$item['can_title']:$notdata}}" data-delete-url="{{route('diary.ajax.delete')}}" data-toggle="modal" data-backdrop="static" data-target="#candidate-evaluate">Đánh giá</a>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<div class="clearfix"></div>--}}
                                                                {{--</div>--}}

                                                                {{--<div class="candidate-item-main-row row">--}}
                                                                    {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
                                                                        {{--<div class="box ">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-globe" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="">--}}
                                                                                {{--<h6>{{!empty($item['source']['so_name'])?$item['source']['so_name']:$notdata}} - {{!empty($item['can_title'])?$item['can_title']:$notdata}}</h6>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div> <!-- /. box -->--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                                {{--<div class="candidate-item-main-row row special-box">--}}
                                                                    {{--<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">--}}
                                                                        {{--<div class="box ">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-map-marker" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="box-text">{{empty($item['can_address'])?$notdata:$item['can_address']}}</div>--}}
                                                                        {{--</div> <!-- /. box -->--}}
                                                                        {{--<div class="box ">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-birthday-cake" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="box-text">{{!empty($item['can_year'])?(date('Y')-$item['can_year']).' tuổi':(!empty($item['can_birthday'])?floor((time() - strtotime($item['can_birthday'])) / (60*60*24*365)).' tuổi':$notdata)}} </div>--}}
                                                                        {{--</div> <!-- /. box -->--}}

                                                                        {{--<div class="box ">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-mobile" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="box-text">{{empty($item['can_phone'])?$notdata: (stripos($item['can_phone'],'0')!=false?'0'.$item['can_phone']:$item['can_phone'])}}</div>--}}
                                                                        {{--</div> <!-- /. box -->--}}
                                                                        {{--<div class="box">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-envelope-o" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="box-text">--}}
                                                                                {{--<a href="#">{{empty($item['can_email'])?$notdata:$item['can_email']}}</a>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div> <!-- /. box -->--}}

                                                                    {{--</div>--}}
                                                                    {{--<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">--}}
                                                                        {{--<div class="box">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-skype" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="box-text">--}}
                                                                                {{--<a href="#">{{!empty($item['can_skype'])?$item['can_skype']:$notdata}}</a>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div> <!-- /. box -->--}}


                                                                        {{--<div class="box">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-facebook-square" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="box-text">--}}
                                                                                {{--<a href="#">{{!empty($item['can_facebook'])?$item['can_facebook']:$notdata}}</a>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div> <!-- /. box -->--}}


                                                                        {{--<div class="box">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-linkedin-square" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="box-text">--}}
                                                                                {{--<a href="#">{{!empty($item['can_linkedin'])?$item['can_linkedin']:$notdata}}</a>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div> <!-- /. box -->--}}

                                                                        {{--<div class="box">--}}
                                                                            {{--<div class="box-icon">--}}
                                                                                {{--<i class="fa fa-github" aria-hidden="true"></i>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="box-text">--}}
                                                                                {{--<a href="#">{{!empty($item['can_github'])?$item['can_github']:$notdata}}</a>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div> <!-- /. box -->--}}

                                                                    {{--</div>--}}

                                                                    {{--@if(!empty($item['can_diary']))--}}

                                                                        {{--@php--}}
                                                                            {{--$can_diary=json_decode($item['can_diary']);--}}
                                                                                {{--$diary=json_decode($can_diary->diary);--}}
                                                                                {{--$candidateType=json_decode($can_diary->candidateType);--}}
                                                                        {{--@endphp--}}

                                                                    {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 diary-box">--}}
                                                                        {{--<div class="row">--}}
                                                                            {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
                                                                                {{--<span>{{$diary->created_at}}</span>--}}
                                                                                {{--<span class="bg-green c-white" style="background: {{$candidateType->canty_color}}!important;">{{$candidateType->canty_name}}</span>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
                                                                                {{--@if(!empty($diary->d_evaluate))--}}
                                                                                    {{--<span><i class="fa fa-star" aria-hidden="true"></i></span><span> {{$diary->d_evaluate}}</span>--}}
                                                                                    {{--@else--}}
                                                                                    {{--<span class="time-expired"><i class="fa fa-clock-o"></i>  {{$diary->d_set_time}}, {{$diary->d_set_calendar}}, {{$diary->d_notice_before}} </span>--}}
                                                                                {{--@endif--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
                                                                                {{--<span>{{$diary->d_note}}</span>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                        {{--@endif--}}


                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div> <!-- /. candidate item -->--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 candidate-sidebar">
                                        <h5 class="pull-left">Tìm kiếm nâng cao</h5>
                                        <div class="clearfix"></div>
                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Thứ tự sắp xếp</div>

                                                <ul>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status" value="ung_vien_moi" {{isset($candidate_status)&&$candidate_status=='ung_vien_moi'?'checked':''}} > Ứng viên mới
                                                            </li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status" value="ung_vien_moi_cap_nhat" {{isset($candidate_status)&&$candidate_status=='ung_vien_moi_cap_nhat'?'checked':''}}  > Ứng viên mới cập nhật
                                                            </label></li>
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Loại ứng viên</div>

                                                <ul id="latest_diary_d_cantype_id">
                                                    @if(!empty($candidateTypes))
                                                    @foreach($candidateTypes as $key => $item)
                                                            <li>
                                                                <label class="full-width"><input type="checkbox" {{isset($candidate_type)&&in_array($item->id,$candidate_type)?'checked':''}} name="candidate_type[]" value="{{$item->id}}"> {{$item->canty_name}}
                                                                    <span class="badge pull-right">{{isset($aggerations['latest_diary_d_cantype_id'][$key])?$aggerations['latest_diary_d_cantype_id'][$key]['doc_count']:''}}</span></label>
                                                            </li>
                                                    @endforeach
                                                    @else
                                                        <div>Lọc loại ứng viên đang không có dữ liệu</div>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Thời gian viết nhật ký</div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <input type="text" placeholder="20/10/2018" value="{{isset($diary_wrote)?$diary_wrote:''}}" data-flag="false" name="diary_wrote" class="form-group datepicker">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Khoảng thời gian viết nhật ký</div>
                                                <div class="row">
                                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                                        <input type="text" name="diary_wrote_from" autocomplete="off" value="{{isset($diary_wrote_from)?$diary_wrote_from:''}}" placeholder="20/10/2018" class="form-group datepicker">
                                                    </div>
                                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                        đến
                                                    </div>
                                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                                        <input type="text" name="diary_wrote_to" value="{{isset($diary_wrote_to)?$diary_wrote_to:''}}" placeholder="20/10/2018" class="form-group datepicker">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Nguồn ứng viên</div>
                                                <ul id="can_source_id">
                                                    @if(!empty($sources))
                                                    @foreach($sources as $key => $item)
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_source[]" {{isset($candidate_source)&&in_array($item->id,$candidate_source)?'checked':''}} value="{{$item->id}}"> {{$item->so_name}}
                                                            <span class="badge pull-right">{{isset($aggerations['can_source_id'][$key])&&$aggerations['can_source_id'][$key]['key']==$item->id?$aggerations['can_source_id'][$key]['doc_count']:''}}</span></label></li>
                                                    @endforeach
                                                        @else
                                                        <div>Lọc nguồn đang không có dữ liệu</div>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex evaluate" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Đánh giá</div>

                                                <ul id="latest_diary_d_evaluate">
                                                    @for($i=1;$i<=5;$i++)
                                                        <li>
                                                            <label class="full-width"><input type="checkbox" value="{{$i}}" {{isset($candidate_rate)&&in_array($i,$candidate_rate)?'checked':''}} name="candidate_rate[]">
                                                                <i class="fa fa-star {{$i<1?'-o':''}}" aria-hidden="true"></i>
                                                                <i class="fa fa-star{{$i<2?'-o':''}}" aria-hidden="true"></i>
                                                                <i class="fa fa-star{{$i<3?'-o':''}}" aria-hidden="true"></i>
                                                                <i class="fa fa-star{{$i<4?'-o':''}}" aria-hidden="true"></i>
                                                                <i class="fa fa-star{{$i<5?'-o':''}}" aria-hidden="true"></i><span class="badge pull-right">{{isset($aggerations['latest_diary_d_evaluate'][$i-1])?$aggerations['latest_diary_d_evaluate'][$i-1]['doc_count']:''}}</span></label>
                                                        </li>
                                                        @endfor
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Thành phố</div>
                                                <select class="select3" id="city_want_to_work" data-url="{{route('location.ajax.search')}}" name="city[]">
                                                    <option></option>
                                                    @if(isset($city))
                                                        @foreach($city as $item)
                                                            <option value="{{ $item->id}}" >{{ $item->loc_name  }}</option>

                                                            @if(isset($candidate->location)&&!empty($candidate->location))  unset($candidate->location[0]) @endif
                                                            {{--<option value="{{ $item->id }}" >{{ $item->loc_name  }}</option>--}}
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Quận huyện</div>

                                                <select class="select3 select4" id="district_want_to_work" data-url="{{route('location.ajax.search')}}" data-parent-id=""
                                                        name="city[]" multiple="multiple">

                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Ngành nghề</div>
                                                <select class="career" name="career[]" multiple="multiple" data-url="{{route('career.ajax.search')}}">
                                                    @if(!empty($careers))
                                                        @foreach($careers as $item)
                                                            <option value="{{$item->id}}">{{$item->ca_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div> Kỹ năng</div>
                                                <select class="skill" name="skill[]" multiple="multiple" data-url="{{route('skill.ajax.search')}}">

                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div style="height: 120px" class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Mức lương
                                                <div class="range">
                                                    <div class="range-slider">
                                                        <input id="salary" type="text" name="salary" data-from="{{isset($range_salary[0])?$range_salary[0]:0}}" data-to="{{isset($range_salary[1])?$range_salary[1]:100}}" data-slider-tooltip="always" /><br />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Giới tính
                                                <select name="gender" id="input" class="form-control form-group" >
                                                    <option value="">Chọn một giới tính</option>
                                                    <option value="1" {{isset($candidate_gender)&&$candidate_gender==1?'selected':''}}>Nam</option>
                                                    <option value="0" {{isset($candidate_gender)&&$candidate_gender==0?'selected':''}}>Nữ</option>
                                                    <option value="">Không xác định</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Kinh nghiệm

                                                <select name="time_experience" id="input" class="form-control form-group" >
                                                    <option value="">Chọn thời gian kinh nghiệm</option>
                                                    @if(isset($timeExperience))
                                                        @foreach($timeExperience as $item)
                                                            <option value="{{$item['id']}}" {{isset($time_experience)&&$time_experience==$item['id']?'selected':''}}>{{$item['name']}}</option>
                                                            @endforeach
                                                        @endif
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Trình độ chuyên môn

                                                <select name="qualification" id="input" class="form-control form-group" >
                                                    @if(isset($qualification))
                                                        <option value="">Chọn trình độ chuyên môn</option>
                                                        @foreach($qualification as $item)
                                                            <option value="{{$item['id']}}" {{isset($ci_qualification)&&$ci_qualification==$item['id']?'selected':''}}>{{$item['name']}}</option>
                                                            @endforeach
                                                        @endif
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Trình độ ngoại ngữ
                                                <select name="english_level" id="input" class="form-control form-group" >
                                                    <option value="">Chọn trình độ ngoại ngữ</option>
                                                    @if(isset($englishLevel))
                                                        @foreach($englishLevel as $key => $item)
                                                            <option value="{{$item['id']}}" {{!empty($english_level)&&$english_level==$item['id']?'selected':''}}>{{$item['name']}}</option>
                                                            @endforeach
                                                        @endif
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item workform radiobox d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Loại hình công việc
                                                @if(isset($typeOfWork))
                                                    <ul id="candidate_info_ci_type_of_work">
                                                        @foreach($typeOfWork as $key => $item)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" {{isset($type_of_work)&&in_array($item['id'],$type_of_work)?'checked':''}} name="type_of_work[]" value="{{$item['id']}}">
                                                                {{$item['name']}}

                                                            </label>
                                                            <span class="badge pull-right">{{isset($aggerations['candidate_info_ci_type_of_work'][$key])&&$aggerations['candidate_info_ci_type_of_work'][$key]['key']==$item->id?$aggerations['candidate_info_ci_type_of_work'][$key]['doc_count']:''}}</span>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div style="height: 120px" class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Tuổi
                                                <div class="range">
                                                    <div class="range-slider">
                                                        <input id="range_age" type="text" name="range_age" data-from="{{isset($range_age[0])?$range_age[0]:0}}" data-to="{{isset($range_age[1])?$range_age[1]:100}}" data-slider-tooltip="always" /><br />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        {{--<div class="candidate-sidebar-item age d-flex">--}}
                                            {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">--}}
                                                {{--Chứng chỉ--}}
                                                {{--<select name="" id="input" class="form-control form-group" >--}}
                                                    {{--<option value="">Chọn một loại chứng chỉ</option>--}}
                                                    {{--<option value="">Toeic</option>--}}
                                                    {{--<option value="">IELF</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div> <!-- /. candidate sidebar item -->--}}

                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 candidate-info">
                                        <a class="close" ><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        <a class="download" ><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <div class="candidate-cv" data-simplebar>
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="candidate-cv-left">
                                                        <div class="candidate-cv-head">
                                                            <div class="candidate-cv-img">
                                                                <img src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg">
                                                            </div>
                                                            <div class="candidate-cv-name">
                                                                <h5 id="can_name">Nguyễn Công Văn</h5>
                                                                <h6 id="can_title">Lập trình viên PHP</h6>
                                                            </div>
                                                        </div>
                                                        <div class="candidate-cv-box basic-info">
                                                            <div class="candidate-cv-box-title">
                                                                THÔNG TIN CƠ BẢN <span></span>
                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <span id="can_birthday">15/10/1998</span>
                                                                </div>
                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-male" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <span id="can_gender">Nam</span>
                                                                </div>
                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <span id="can_phone">0969516425</span>
                                                                </div>
                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <a href="#" id="can_email">devcongvan@gmail.com</a>
                                                                </div>
                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <span id="can_address">Số 42 Trần Quang Diệu, phường Ô Chợ Dừa, quận Đống Đa, Hà Nội</span>
                                                                </div>
                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-skype" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <span><a href="#" id="can_skype">https://skype.com</a></span>
                                                                </div>

                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <span><a href="#" id="can_facebook">https://facebook.com</a></span>
                                                                </div>
                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <span><a href="#" id="can_linkedin">https://linkedin.com</a></span>
                                                                </div>

                                                            </div>
                                                            <div class="candidate-cv-item row">
                                                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                                    <i class="fa fa-github" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                                    <span><a href="#" id="can_github">https://github.com</a></span>
                                                                </div>

                                                            </div>
                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                MỤC TIÊU <span></span>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-name">
                                                                    Mục tiêu
                                                                </div>
                                                                <div class="candidate-cv-item-content" id="ci_target">
                                                                    - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng. <br>
                                                                    - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                    uống. <br>
                                                                    -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                    về dịch vụ. <br>
                                                                </div>
                                                            </div> <!-- /. candidate-cv-item -->

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-name">
                                                                    Về bản thân
                                                                </div>
                                                                <div class="candidate-cv-item-content" id="ci_about">
                                                                    - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng. <br>
                                                                    - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                    uống. <br>
                                                                    -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                    về dịch vụ. <br>
                                                                </div>
                                                            </div> <!-- /. candidate-cv-item -->
                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box ci_certificate" style="display: none">
                                                            <div class="candidate-cv-box-title">
                                                                CHỨNG CHỈ <span></span>
                                                            </div>
                                                            <div class="ci_certificate-content">
                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">
                                                                        22/05/2018
                                                                    </div>
                                                                    <div class="candidate-cv-item-right">
                                                                        Chứng chỉ tin học loại A1 - Khá
                                                                        Chứng chỉ tin học loại A1 - Khá
                                                                    </div>
                                                                </div>

                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">
                                                                        22/05/2018
                                                                    </div>
                                                                    <div class="candidate-cv-item-right">
                                                                        Chứng chỉ tin học loại A1 - Khá
                                                                        Chứng chỉ tin học loại A1 - Khá
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box ci_prize">
                                                            <div class="candidate-cv-box-title">
                                                                GIẢI THƯỞNG <span></span>
                                                            </div>
                                                            <div class="ci_prize-content">
                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">
                                                                        22/05/2018
                                                                    </div>
                                                                    <div class="candidate-cv-item-right">
                                                                        Chứng chỉ tin học loại A1 - Khá
                                                                        Chứng chỉ tin học loại A1 - Khá
                                                                    </div>
                                                                </div>

                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-left candidate-cv-item-time">
                                                                        22/05/2018
                                                                    </div>
                                                                    <div class="candidate-cv-item-right">
                                                                        Chứng chỉ tin học loại A1 - Khá
                                                                        Chứng chỉ tin học loại A1 - Khá
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box ci_skill">
                                                            <div class="candidate-cv-box-title">
                                                                KỸ NĂNG <span></span>
                                                            </div>
                                                            <div class="ci_skill-content">

                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-left">
                                                                        PHP
                                                                    </div>
                                                                    <div class="candidate-cv-item-right">
                                                                        <ul class="candidate-cv-rate">
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item "></li>
                                                                            <li class="candidate-cv-rate-item "></li>
                                                                        </ul>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->
                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-left">
                                                                        HTML
                                                                    </div>
                                                                    <div class="candidate-cv-item-right">
                                                                        <ul class="candidate-cv-rate">
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item "></li>
                                                                            <li class="candidate-cv-rate-item "></li>
                                                                        </ul>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->

                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-left">
                                                                        CSS
                                                                    </div>
                                                                    <div class="candidate-cv-item-right">
                                                                        <ul class="candidate-cv-rate">
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item "></li>
                                                                            <li class="candidate-cv-rate-item "></li>
                                                                        </ul>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->

                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-left">
                                                                        Ajax
                                                                    </div>
                                                                    <div class="candidate-cv-item-right">
                                                                        <ul class="candidate-cv-rate">
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item active"></li>
                                                                            <li class="candidate-cv-rate-item "></li>
                                                                            <li class="candidate-cv-rate-item "></li>
                                                                        </ul>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->

                                                            </div>

                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box ci_hobby">
                                                            <div class="candidate-cv-box-title">
                                                                SỞ THÍCH <span></span>
                                                            </div>

                                                            <div class="candidate-cv-item ci_hobby-content">

                                                            </div>

                                                        </div> <!-- /. candidate-cv-box -->

                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="candidate-cv-right">
                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                HỒ SƠ ỨNG VIÊN <span></span>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Quê quán
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="hometown">
                                                                    Hà Nội
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Ngành nghề
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="ca_name">
                                                                    IT phần mềm, IT phần cứng
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Kỹ năng
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="sk_name">
                                                                    Photoshop, PHP, HTML, CSS, Laravel, jQuery, Ajax
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Địa điểm làm việc
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="loc_name">
                                                                    Hà Nội, Hồ Chí Minh
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Mong muốm làm việc tại nước ngoài
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="ci_work_abroad">
                                                                    Có
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Kinh nghiệm làm việc
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="ci_time_experience">
                                                                    Dưới 1 năm
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Trình độ chuyên môn
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="ci_qualification">
                                                                    Sinh viên
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Trình độ tiếng anh
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="ci_english_level">
                                                                    Đọc hiểu
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Loại hình công việc
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="ci_type_of_work">
                                                                    Toàn thời gian
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Mức lương
                                                                </div>
                                                                <div class="candidate-cv-item-right" id="ci_salary">
                                                                    5 - 7 triệu
                                                                </div>
                                                            </div>
                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box ci_education">
                                                            <div class="candidate-cv-box-title">
                                                                HỌC VẤN <span></span>
                                                            </div>
                                                            <div class="ci_education-content">
                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-time">
                                                                        03/2015 - 10/2017
                                                                    </div>
                                                                    <div class="candidate-cv-item-name">
                                                                        Cửa hàng ăn tại nhà
                                                                    </div>
                                                                    <div class="candidate-cv-item-position">
                                                                        Nhân viên chạy bàn
                                                                    </div>
                                                                    <div class="candidate-cv-item-content">
                                                                        - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng.
                                                                        <br>
                                                                        - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                        uống. <br>
                                                                        -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                        về dịch vụ. <br>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->

                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-time">
                                                                        03/2015 - 10/2017
                                                                    </div>
                                                                    <div class="candidate-cv-item-name">
                                                                        Cửa hàng ăn tại nhà
                                                                    </div>
                                                                    <div class="candidate-cv-item-position">
                                                                        Nhân viên chạy bàn
                                                                    </div>
                                                                    <div class="candidate-cv-item-content">
                                                                        - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng.
                                                                        <br>
                                                                        - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                        uống. <br>
                                                                        -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                        về dịch vụ. <br>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->
                                                            </div>

                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box ci_work_experience">
                                                            <div class="candidate-cv-box-title">
                                                                KINH NGHIỆM THỰC TẾ <span></span>
                                                            </div>
                                                            <div class="ci_work_experience-content">
                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-time">
                                                                        03/2015 - 10/2017
                                                                    </div>
                                                                    <div class="candidate-cv-item-name">
                                                                        Cửa hàng ăn tại nhà
                                                                    </div>
                                                                    <div class="candidate-cv-item-position">
                                                                        Nhân viên chạy bàn
                                                                    </div>
                                                                    <div class="candidate-cv-item-content">
                                                                        - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng.
                                                                        <br>
                                                                        - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                        uống. <br>
                                                                        -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                        về dịch vụ. <br>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->

                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-time">
                                                                        03/2015 - 10/2017
                                                                    </div>
                                                                    <div class="candidate-cv-item-name">
                                                                        Cửa hàng ăn tại nhà
                                                                    </div>
                                                                    <div class="candidate-cv-item-position">
                                                                        Nhân viên chạy bàn
                                                                    </div>
                                                                    <div class="candidate-cv-item-content">
                                                                        - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng.
                                                                        <br>
                                                                        - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                        uống. <br>
                                                                        -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                        về dịch vụ. <br>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->
                                                            </div>
                                                        </div> <!-- /. candidate-cv-box -->
                                                        <div class="candidate-cv-box ci_activity">
                                                            <div class="candidate-cv-box-title">
                                                                HOẠT ĐỘNG <span></span>
                                                            </div>

                                                            <div class="ci_activity-content">
                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-time">
                                                                        03/2015 - 10/2017
                                                                    </div>
                                                                    <div class="candidate-cv-item-name">
                                                                        Cửa hàng ăn tại nhà
                                                                    </div>
                                                                    <div class="candidate-cv-item-position">
                                                                        Nhân viên chạy bàn
                                                                    </div>
                                                                    <div class="candidate-cv-item-content">
                                                                        - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng.
                                                                        <br>
                                                                        - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                        uống. <br>
                                                                        -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                        về dịch vụ. <br>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->

                                                                <div class="candidate-cv-item">
                                                                    <div class="candidate-cv-item-time">
                                                                        03/2015 - 10/2017
                                                                    </div>
                                                                    <div class="candidate-cv-item-name">
                                                                        Cửa hàng ăn tại nhà
                                                                    </div>
                                                                    <div class="candidate-cv-item-position">
                                                                        Nhân viên chạy bàn
                                                                    </div>
                                                                    <div class="candidate-cv-item-content">
                                                                        - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng.
                                                                        <br>
                                                                        - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                        uống. <br>
                                                                        -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                        về dịch vụ. <br>
                                                                    </div>
                                                                </div> <!-- /. candidate-cv-item -->
                                                            </div>


                                                        </div> <!-- /. candidate-cv-box -->


                                                    </div> <!-- /. candidate-cv-box -->
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- /. candidate-cv -->
                                </div>
                            </div>
                            </form>
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            {{--{{isset($candidates)?$candidates->render():''}}--}}

                            {{--@php echo $paginate['html']; @endphp--}}

                        </div>

                </div>
                <!-- /.card -->
        </section>
        <!-- /.Left col -->
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

    <div class="modal fade candidate-popup candidate-confirm" id="candidate-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="newcareer">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa ứng viên</h5>
                    </div>
                    <div class="modal-body row">
                        Bạn có muốn xóa ứng viên này không
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                        </div>
                        {{--<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">--}}
                        {{--<input type="hidden" name="id" value="">--}}
                        {{--<input type="text" name="ca_name" class="form-group full-width">--}}
                        {{--<span class="candidate-text-error"></span>--}}
                        {{--</div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close btn-common" data-dismiss="modal"> Không</button>
                        <button type="button" class="btn  btn-default candidate-popup-button-trash btn-common">
                            <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade candidate-popup candidate-evaluate" id="candidate-evaluate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header candidate-evaluate-header">
                    <div class="candidate-evaluate-header-avatar">
                        <div class="img">
                            <img src="https://images.kienthuc.net.vn/zoomh/500/uploaded/manhtu/2017_06_12/3/gai-xinh-dong-nai-khien-dan-mang-chao-dao.jpg" class="img-responsive" alt="">
                        </div>
                    </div>
                    <div class="candidate-evaluate-header-info">Nguyễn Văn Ây, 23 tuổi, Lập trình viên PHP</div>
                    <ul class="candidate-evaluate-header-control">
                        <li class="candidate-evaluate-header-control-item">
                            <a title="Tải lại" href="#"><i class="fa fa-refresh" aria-hidden="true"></i></a></li>
                        <li class="candidate-evaluate-header-control-item">
                            <a title="Tùy chọn" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                {{--<a class="dropdown-item" href="#" data-id="{{$item->id}}">Xuất nhật ký</a>--}}
                                {{--<a class="dropdown-item" href="#" data-id="{{$item->id}}">Chi tiết ứng viên</a>--}}
                            </div>
                        </li>
                        <li class="candidate-evaluate-header-control-item">
                            <a href="#" title="Đóng" class="off" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="candidate-evaluate-sidebar">
                        <ul class="nav">
                            <li class="nav-item active" data-tab="candidate-evaluate-main-diary">
                                <a ><img class="other-icon" src="http://icons.iconarchive.com/icons/icons8/ios7/32/Users-Edit-User-icon.png">
                                    <p>Nhật ký</p></a></li>
                            <li class="nav-item" data-tab="candidate-evaluate-main-mail"><a><img class="other-icon" src="upload/icon/icons8-open-envelope-50.png">
                                    <p>Mail</p></a></li>
                        </ul>
                    </div>
                    <div class="candidate-evaluate-main">
                        <div class="candidate-evaluate-main-diary">
                            <div class="candidate-evaluate-main-diary-list">
                                <div class="candidate-evaluate-main-diary-list-scroll scroll" data-url="{{route('diary.ajax.list')}}" >

                                    {{--<div class="candidate-evaluate-loading">Đã tải hết dữ liệu</div>--}}
                                    {{--<div class="candidate-evaluate-loading">Đang tải dữ liệu mới ...</div>--}}

                                    <div class="month-break" month="Tháng 7 năm 2018"></div>

                                    {{--<div class="diary-item row">--}}
                                        {{--<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">--}}
                                            {{--<div class="diary-item-avatar">--}}
                                                {{--<div class="img">--}}
                                                    {{--<img class="img-reponsive" src="upload/avatar/228161052_hotgirl-reuters-kieu-trinh6-1496928968014.jpg" alt="">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">--}}
                                            {{--<div class="diary-item-main">--}}
                                                {{--<div class="diary-item-header">--}}
                                                    {{--<span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-green c-white">Ứng viên tiềm năng</span>--}}
                                                    {{--<a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>--}}
                                                    {{--<div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">--}}
                                                        {{--<a class="dropdown-item" data-confirm="diary" href="#" data-id="16">Xóa</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="bg">--}}
                                                    {{--<div class="diary-item-rate">--}}
                                                        {{--<span><i class="fa fa-star" aria-hidden="true"></i></span><span> Thật không thể tin nổi</span>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="diary-item-notice">--}}

                                                    {{--</div>--}}
                                                    {{--<div class="diary-item-note">--}}
                                                        {{--Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                </div>

                                <div class="option">
                                    <a href="#" id="updown" data-scroll='bottom'><i class="fa fa-chevron-circle-up" aria-hidden="true"></i></a>
                                    <a href="#" id="dropdownMenuButton" data-url="{{route('diary.ajax.listCandidateType')}}" data-toggle="dropdown" data-render="false" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu list-type" aria-labelledby="dropdownMenuButton">
                                    </div>
                                </div>
                            </div>

                            <div class="candidate-evaluate-main-diary-composer" data-click="false" >
                                <div class="wrap">
                                    <div style="" class="row box1 candidate-evaluate-main-diary-composer-row set-calendar" style="display: none;">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-title">
                                            Đặt lịch
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-input">
                                            <input type="text text-center" name="set-calendar-date" class="full-width form-group datepicker" placeholder="20/10/2017">
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 candidate-evaluate-main-diary-composer-input">
                                            lúc
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-input">
                                            <input type="text text-center timepicker" name="set-calendar-time" placeholder="20:30" class="full-width form-group timepicker">
                                            {{-- <div class="timepicker-box">
                                                <div class="timepicker-box-header">
                                                    Chọn giờ
                                                </div>
                                                <div class="timepicker-box-body">
                                                    <div class="timepicker-box-time hour"></div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 candidate-evaluate-main-diary-composer-input">
                                            trước
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-input">
                                            <select class="form-group" name="set-calendar-before">
                                                <option value="">-- Chọn khoảng thời gian --</option>
                                                <option value="Trước 30 phút">Trước 30 phút</option>
                                                <option value="Trước 1 tiếng">Trước 1 tiếng</option>
                                                <option value="Trước 1 ngày">Trước 1 ngày</option>
                                                <option value="Trước 3 ngày">Trước 3 ngày</option>
                                                <option value="Trước 5 ngày">Trước 5 ngày</option>
                                                <option value="Trước 7 ngày">Trước 7 ngày</option>
                                                <option value="Trước 15 ngày">Trước 15 ngày</option>
                                                <option value="Trước 30 ngày">Trước 30 ngày</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style=" height: 48px" class="row box2 candidate-evaluate-main-diary-composer-row rate">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-title">
                                            Đánh giá
                                        </div>
                                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                            <div class="rateCandidate">
                                                <div class="rateCandidate-item" data-value="1">
                                                    <i class="fa fa-star" aria-hidden="true"></i>        
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>        
                                                </div>
                                                <div class="rateCandidate-item" data-value="2">
                                                    <i class="fa fa-star" aria-hidden="true"></i>        
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>        
                                                </div>
                                                <div class="rateCandidate-item" data-value="3">
                                                    <i class="fa fa-star" aria-hidden="true"></i>        
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>        
                                                </div>
                                                <div class="rateCandidate-item" data-value="4">
                                                    <i class="fa fa-star" aria-hidden="true"></i>        
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>        
                                                </div>
                                                <div class="rateCandidate-item" data-value="5">
                                                    <i class="fa fa-star" aria-hidden="true"></i>        
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>        
                                                </div>
                                                <div class="rateCandidate-text ml-15px"></div>
                                                <input type="hidden" name="rateCandidate-scrore" class="rateCandidate-scrore" value="">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="box3 margin-bottom" >
                                        <div class="row candidate-evaluate-main-diary-composer-row">
                                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-title">
                                                Ghi chú
                                            </div>
                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 candidate-evaluate-main-diary-composer-input">
                                                <textarea name="note" rows="1" class="full-width form-group"></textarea>
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                <a href="#" data-candidate-type-id="0" data-url="{{route('diary.ajax.new')}}" class="candidate-evaluate-main-diary-composer-push"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="candidate-evaluate-main-mail slide-out">
                            <div class="candidate-evaluate-main-mail-nav">
                                <div class="candidate-evaluate-main-mail-sender">
                                    <div>Nguyễn HR,</div>
                                    <div>nguyen.hr@gmail.com</div>
                                </div>
                                <ul class="candidate-evaluate-main-mail-nav-list">
                                    <li class="active"><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> Thư đến</a></li>
                                    <li><a href="#"><i class="fa fa-paper-plane" aria-hidden="true"></i> Thư đã gửi</a></li>
                                    <li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Thư nháp</a></li>
                                    <li><a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> Mẫu</a></li>
                                </ul>
                            </div>
                            <div class="candidate-evaluate-main-mail-list" >
                                <div class="candidate-evaluate-main-mail-list-bar">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center">
                                            <div class="checkall-bar" >
                                                <input type="checkbox" name="" class="form-group">
                                            </div>
                                        </div>
                                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                            <div class="search-bar" >
                                                <input type="text" name="" class="form-group" placeholder="Tìm kiếm">
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center">
                                            <div class="number-bar" >
                                                10/15 thư
                                            </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center">
                                            <div class="delete-bar a-hover" >
                                                <a href="#" data-confirm="mail"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <div class="candidate-evaluate-main-mail-list-content scroll" >
                                    <div class="candidate-evaluate-main-mail-item">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-checkbox">
                                            <input type="checkbox" name="mail_item[]">
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-sender">
                                            <div class="pull-left"><a href="#">Tôi <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Nguyễn Văn Ây</a></div>
                                            <div class="pull-right a-hover">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i> 15 tháng 6
                                            </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-pin">
                                            <a href="#" class="mail-item-pin a-hover"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-title">
                                            <a href="#" class="a-hover"><b>VNP Group - Thư mời nhận việc </b></a><span>- Chào bạn, Nguyễn Văn Ây ...</span>
                                        </div>
                                    </div>

                                    <div class="candidate-evaluate-main-mail-item">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-checkbox">
                                            <input type="checkbox" name="mail_item[]">
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-sender">
                                            <div class="pull-left"><a href="#">Tôi <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Nguyễn Văn Bi</a></div>
                                            <div class="pull-right a-hover">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i> 15 tháng 6
                                            </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-pin">
                                            <a href="#" class="mail-item-pin a-hover"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-title">
                                            <a href="#" class="a-hover"><b>VNP Group - Thư mời nhận việc </b></a><span>- Chào bạn, Nguyễn Văn Ây ...</span>
                                        </div>
                                    </div>

                                    <div class="candidate-evaluate-main-mail-item">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-checkbox">
                                            <input type="checkbox" name="mail_item[]">
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-sender">
                                            <div class="pull-left"><a href="#">Tôi <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Nguyễn Văn C</a></div>
                                            <div class="pull-right a-hover">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i> 15 tháng 6
                                            </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-pin">
                                            <a href="#" class="mail-item-pin a-hover"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-title">
                                            <a href="#" class="a-hover"><b>VNP Group - Thư mời nhận việc </b></a><span>- Chào bạn, Nguyễn Văn Ây ...</span>
                                        </div>
                                    </div>

                                    <div class="candidate-evaluate-main-mail-item">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-checkbox">
                                            <input type="checkbox" name="mail_item[]">
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-sender">
                                            <div class="pull-left"><a href="#">Tôi <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Nguyễn Văn D</a></div>
                                            <div class="pull-right a-hover">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i> 15 tháng 6
                                            </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-pin">
                                            <a href="#" class="mail-item-pin a-hover"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-title">
                                            <a href="#" class="a-hover"><b>VNP Group - Thư mời nhận việc </b></a><span>- Chào bạn, Nguyễn Văn Ây ...</span>
                                        </div>
                                    </div>

                                    <div class="candidate-evaluate-main-mail-item">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-checkbox">
                                            <input type="checkbox" name="mail_item[]">
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-sender">
                                            <div class="pull-left"><a href="#">Tôi <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Nguyễn Văn E</a></div>
                                            <div class="pull-right a-hover">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i> 15 tháng 6
                                            </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-pin">
                                            <a href="#" class="mail-item-pin a-hover"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-title">
                                            <a href="#" class="a-hover"><b>VNP Group - Thư mời nhận việc </b></a><span>- Chào bạn, Nguyễn Văn Ây ...</span>
                                        </div>
                                    </div>

                                    <div class="candidate-evaluate-main-mail-item">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-checkbox">
                                            <input type="checkbox" name="mail_item[]">
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-sender">
                                            <div class="pull-left"><a href="#">Tôi <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Nguyễn Văn D</a></div>
                                            <div class="pull-right a-hover">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i> 15 tháng 6
                                            </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-pin">
                                            <a href="#" class="mail-item-pin a-hover"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-title">
                                            <a href="#" class="a-hover"><b>VNP Group - Thư mời nhận việc </b></a><span>- Chào bạn, Nguyễn Văn Ây ...</span>
                                        </div>
                                    </div>

                                    <div class="candidate-evaluate-main-mail-item">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-checkbox">
                                            <input type="checkbox" name="mail_item[]">
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-sender">
                                            <div class="pull-left"><a href="#">Tôi <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Nguyễn Văn E</a></div>
                                            <div class="pull-right a-hover">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i> 15 tháng 6
                                            </div>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center item-pin">
                                            <a href="#" class="mail-item-pin a-hover"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 item-title">
                                            <a href="#" class="a-hover"><b>VNP Group - Thư mời nhận việc </b></a><span>- Chào bạn, Nguyễn Văn Ây ...</span>
                                        </div>
                                    </div>
                                    

                                    <div class="text-center c-main" style="padding: 10px 0">
                                        Đang tải thêm các thư trước đây ...
                                    </div>
                                    <div class="text-center c-main" style="padding: 10px 0">
                                        Không còn thư nào
                                    </div>
                                </div>
                                <div class="option a-hover" data-toggle="false">
                                    <a><img class="other-icon" src="upload/icon/icons8-composing-mail-50.png"></a>
                                </div>
                            </div>
                            <div class="candidate-evaluate-main-mail-sendmail">
                                <div class="candidate-evaluate-main-mail-top">
                                    <a class="pull-left a-hover close" href="#"><i class="fa fa-close" aria-hidden="true"></i></a>
                                    <a class="pull-right a-hover" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> Chọn mẫu có sẵn</a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="candidate-evaluate-main-mail-content">
                                    <div class="candidate-evaluate-main-mail-row row">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            Tới
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" placeholder="example@gmail.com" name="" class="form-group full-width">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="candidate-evaluate-main-mail-row row ">
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            Tiêu đề
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" placeholder="Viết tiêu đề thư ở đây" name="" class="form-group full-width">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="candidate-evaluate-main-mail-row row autosendmail">
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                            Đặt lịch gửi Mail tự động
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                            <a data-toggle="off" id="toggle"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                            <input type="text" name="" placeholder="20:30" class="form-group text-center full-width">
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
                                            ngày
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                            <input type="text" name="" placeholder="20/10/2018" class="form-group text-center full-width">
                                        </div>
                                    </div>
                                    <div class="candidate-evaluate-main-mail-row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div id="editor">
                                              <p>Hello World!</p>
                                              <p>Some initial <strong>bold</strong> text</p>
                                              <p><br></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="candidate-evaluate-main-mail-bottom">
                                    <ul class="left">
                                        <li><a class="a-hover" href="#"><i class="fa fa-paperclip" aria-hidden="true"></i> Đính kèm file</a></li>
                                        <li><a class="a-hover" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lưu nháp</a></li>
                                        <li><a class="a-hover" href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> Lưu mẫu</a></li>
                                    </ul>
                                    <div class="right">
                                        <a class="a-hover" href="#"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>

                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="candidate-evaluate-confirm hide">
                        <div class="modal-header">
                            <h5 class="c-white">Thông báo</h5>
                        </div>
                        <div class="modal-body">
                            Bạn có muốn xóa nhật ký này không?
                        </div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="button" class="btn btn-secondary btn-close btn-common">Đóng</button>
                                <button type="button" data-delete-url="{{route('diary.ajax.delete')}}" class="btn btn-default btn-delete btn-common">Xóa</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="candidate-evaluate-alert hide">
                        <div class="modal-header">
                            <h5 class="c-white">Thông báo</h5>
                        </div>
                        <div class="modal-body">
                            Bạn chưa chọn Mail nào
                        </div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="button" class="btn btn-secondary btn-close btn-common">Đóng</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="candidate-evaluate-overlay hide"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')


    {{--@if(Session::has('message'))--}}

        {{--<script type="text/javascript">--}}

            {{--toastr.options = {--}}
                {{--"closeButton": true,--}}
                {{--"debug": false,--}}
                {{--"newestOnTop": false,--}}
                {{--"progressBar": true,--}}
                {{--"positionClass": "toast-bottom-left",--}}
                {{--"preventDuplicates": false,--}}
                {{--"onclick": null,--}}
                {{--"showDuration": "300",--}}
                {{--"hideDuration": "1000",--}}
                {{--"timeOut": "5000",--}}
                {{--"extendedTimeOut": "1000",--}}
                {{--"showEasing": "swing",--}}
                {{--"hideEasing": "linear",--}}
                {{--"showMethod": "fadeIn",--}}
                {{--"hideMethod": "fadeOut"--}}
            {{--}--}}

            {{--var type = "{{ Session::get('alert-type', 'info') }}";--}}
            {{--switch (type) {--}}
                {{--case 'info':--}}
                    {{--toastr.info("{{ Session::get('message') }}");--}}
                    {{--break;--}}

                {{--case 'warning':--}}
                    {{--toastr.warning("{{ Session::get('message') }}");--}}
                    {{--break;--}}

                {{--case 'success':--}}
                    {{--toastr.success("{{ Session::get('message') }}");--}}
                    {{--break;--}}

                {{--case 'error':--}}
                    {{--toastr.error("{{ Session::get('message') }}");--}}
                    {{--break;--}}
            {{--}--}}

        {{--</script>--}}
    {{--@endif--}}
@endsection

