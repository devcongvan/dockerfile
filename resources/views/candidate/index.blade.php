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
                                <a href="{{route('candidate.new')}}" class="btn btn-default btn-blue"><i class="fa fa-plus" aria-hidden="true"></i> Thêm ứng viên</a>
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

                        <div class="card">
                            <div class=" p-0 row">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" name="" class="form-group" placeholder="Ghõ tên Ứng viên để tìm kiếm">
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <input type="text" name="" id="vitricongviec" class="form-group" placeholder="Vị trí như: Lập trình viên, ...">
                                </div>
                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                    <button type="button" class="btn btn-default full-width btn-blue"> Tìm kiếm</button>
                                </div>
                            </div><!-- /.card-header -->
                            @if($total=$candidates->total())
                                <div class="card-searchinfo">
                                    <b>{{$candidates->firstItem()!=0?$candidates->firstItem():0}} - {{$candidates->lastItem()!=0?$candidates->lastItem():0}} </b>trong<b> {{$total}} </b> ứng viên <span></span>
                                </div>
                            @endif
                            <div class="card-body candidate-list">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 candidate-main">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                            @isset($candidates)
                                                @php $notdata='Chưa có dữ liệu'; @endphp
                                                @foreach($candidates as $item)
                                                    <div class="candidate-item row" style="overflow: hidden">
                                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                            <div class="candidate-item-left">
                                                                <div class="image">
                                                                    <img class="img-responsive" src="{{$item->can_avatar}}" alt="">
                                                                </div>
                                                                <div class="option">
                                                                    {{--<a href="{{route('candidate.edit', ['id' => $item->id])}}" style="background: #808080;color: #fff;" class="btn btn-default candidate-item-edit" data-id="{{$item->id}}"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>--}}
                                                                    {{--<button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default candidate-item-destroy" data-id="{{$item->id}}" data-toggle="modal" data-backdrop="static" data-target="#candidate-confirm" ><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>--}}
                                                                    <div class="text-center time">
                                                                        <i class="fa fa-calendar" aria-hidden="true"></i> {{date("d-m-Y", strtotime($item->updated_at))}}
                                                                    </div>
                                                                </div>
                                                            </div> <!-- /. candidate item left -->
                                                        </div>
                                                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                            <div class="candidate-item-main">
                                                                <div class="candidate-item-main-row">
                                                                    <h5 class="pull-left candidate-item-main-name" data-id="{{$item->id}}" toggle="false">{{$item->can_name}}</h5>
                                                                    <div class="dropdown pull-right">
                                                                        <button class="btn " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="{{route('candidate.edit', ['id' => $item->id])}}" data-id="{{$item->id}}">Sửa</a>
                                                                            <a class="dropdown-item" href="#" data-id="{{$item->id}}" data-toggle="modal" data-backdrop="static" data-target="#candidate-confirm">Xóa</a>
                                                                            <a class="dropdown-item" href="#candidate-evaluate" data-id="{{$item->id}}" data-toggle="modal" data-backdrop="static" data-target="#candidate-evaluate">Đánh giá</a>
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
                                                                                <h6>{{!empty($item->source->so_name)?$item->source->so_name:$notdata}} - {{!empty($item->can_title)?$item->can_title:$notdata}}</h6>
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
                                                                            <div class="box-text">{{empty($item->can_address)?$notdata:$item->can_address}}</div>
                                                                        </div> <!-- /. box -->
                                                                        <div class="box ">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">{{!empty($item->can_year)?(date('Y')-$item->can_year).' tuổi':(!empty($item->can_birthday)?floor((time() - strtotime($item->can_birthday)) / (60*60*24*365)).' tuổi':$notdata)}} </div>
                                                                        </div> <!-- /. box -->

                                                                        <div class="box ">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">{{empty($item->can_phone)?$notdata: (stripos($item->can_phone,'0')!=false?'0'.$item->can_phone:$item->can_phone)}}</div>
                                                                        </div> <!-- /. box -->
                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{empty($item->can_email)?$notdata:$item->can_email}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                    </div>
                                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-skype" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{!empty($item->can_skype)?$item->can_skype:$notdata}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->


                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{!empty($item->can_facebook)?$item->can_facebook:$notdata}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->


                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{!empty($item->can_linkedin)?$item->can_linkedin:$notdata}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-github" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{!empty($item->can_github)?$item->can_github:$notdata}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 diary-box">
                                                                        <div class="row">
                                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                                <span>20:30 ngày 15/05/2018</span>
                                                                                <span class="bg-green c-white">Ứng viên tiềm năng</span>
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                                <span class="time-expired"><i class="fa fa-clock-o"></i>  23:30, 21 tháng 5, báo trước 5 phút </span>
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                                <span>Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- /. candidate item -->
                                                @endforeach
                                            @endif
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
                                                        <label class="full-width"><input type="checkbox" name="candidate_status" > Ứng viên mới
                                                            <span class="badge pull-right">151</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> Ứng viên mới cập nhật
                                                            <span class="badge pull-right">240</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> Ứng viên tiềm năng
                                                            <span class="badge pull-right">360</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> Ứng viên bận
                                                            <span class="badge pull-right">100</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> Ứng viên có nhu cầu
                                                            <span class="badge pull-right">100</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> Ứng viên chưa có nhu cầu
                                                            <span class="badge pull-right">100</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> Ứng viên hẹn phỏng vấn
                                                            <span class="badge pull-right">100</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> Ứng viên sắp nghỉ
                                                            <span class="badge pull-right">100</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> Ứng viên là sinh viên
                                                            <span class="badge pull-right">100</span></label></li>
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Thời gian viết nhật ký</div>
                                                <div class="row">
                                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                        Ngày
                                                    </div>
                                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                        <input type="text" placeholder="20/10/2018" name="" class="form-group">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                        Giờ
                                                    </div>
                                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                        <input type="text" placeholder="20:30" name="" class="form-group">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Khoảng thời gian viết nhật ký</div>
                                                <div class="row">
                                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                                        <input type="text" name="" placeholder="20/10/2018" class="form-group">
                                                    </div>
                                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                        đến
                                                    </div>
                                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                                        <input type="text" name="" placeholder="20/10/2018" class="form-group">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Nguồn ứng viên</div>
                                                <ul>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> 123job
                                                            <span class="badge pull-right">151</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> vietnamwork
                                                            <span class="badge pull-right">240</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> itviec
                                                            <span class="badge pull-right">360</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> vieclam24h
                                                            <span class="badge pull-right">100</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status"> careerbuilder
                                                            <span class="badge pull-right">100</span></label></li>
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex evaluate" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Đánh giá</div>
                                                <ul>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i><span class="badge pull-right">151</span></label>
                                                    </li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i><span class="badge pull-right">240</span></label>
                                                    </li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i><span class="badge pull-right">360</span></label>
                                                    </li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i><span class="badge pull-right">100</span></label>
                                                    </li>
                                                    <li>
                                                        <label class="full-width"><input type="checkbox" name="candidate_status">
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i><span class="badge pull-right">100</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Địa điểm</div>
                                                <select class="select3" name="workplace[]" multiple="multiple">
                                                    <option value="hanoi">Hà Nội</option>
                                                    <option value="hochiminh">Hải Phòng</option>
                                                    <option value="dannag">Đà Nẵng</option>
                                                    <option value="haiphong">Hồ Chí Minh</option>
                                                    <option value="haiduong">Huế</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Ngành nghề</div>
                                                <select class="select3" name="career[]" multiple="multiple">
                                                    <option value="hanoi">IT phần cứng</option>
                                                    <option value="hochiminh">IT phần mềm</option>
                                                    <option value="dannag">Kế toán</option>
                                                    <option value="haiphong">Saller</option>
                                                    <option value="haiduong">Human Resource</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div> Kỹ năng</div>
                                                <select class="select3" name="career[]" multiple="multiple">
                                                    <option value="hanoi">IT phần cứng</option>
                                                    <option value="hochiminh">IT phần mềm</option>
                                                    <option value="dannag">Kế toán</option>
                                                    <option value="haiphong">Saller</option>
                                                    <option value="haiduong">Human Resource</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div style="height: 120px" class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Mức lương
                                                <div class="range">
                                                    <div class="range-slider">
                                                        <input id="salary" type="text" data-slider-tooltip="always" /><br />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Giới tính
                                                <select name="" id="input" class="form-control form-group" required="required">
                                                    <option value="">Chọn một giới tính</option>
                                                    <option value="">Nam</option>
                                                    <option value="">Nữ</option>
                                                    <option value="">Không xác định</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Kinh nghiệm
                                                <select name="" id="input" class="form-control form-group" required="required">
                                                    <option value="">Chọn thời gian kinh nghiệm</option>
                                                    <option value="">1 năm</option>
                                                    <option value="">2 năm</option>
                                                    <option value="">3 năm</option>
                                                    <option value="">4 năm</option>
                                                    <option value="">5 năm</option>
                                                    <option value="">Trên 5 năm</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Trình độ chuyên môn
                                                <select name="" id="input" class="form-control form-group" required="required">
                                                    <option value="">Chọn trình độ chuyên môn</option>
                                                    <option value="">Sinh viên</option>
                                                    <option value="">Mới ra trường</option>
                                                    <option value="">Có kinh nghiệm</option>
                                                    <option value="">Trưởng nhóm</option>
                                                    <option value="">Quản lý/ Giám sát</option>
                                                    <option value="">Chuyên gia</option>
                                                    <option value="">Giám đốc</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Trình độ ngoại ngữ
                                                <select name="" id="input" class="form-control form-group" required="required">
                                                    <option value="">Chọn trình độ ngoại ngữ</option>
                                                    <option value="">Không biết</option>
                                                    <option value="">Đọc hiểu cơ bản</option>
                                                    <option value="">Đọc/ viết tốt tài liệu chuyên môn</option>
                                                    <option value="">Giao tiếp tốt</option>
                                                    <option value="">Thành thục mọi kỹ năng</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item workform d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Loại hình công việc
                                                <div class="candidate-checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        Toàn thời gian
                                                    </label>
                                                </div>
                                                <div class="candidate-checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        Bán thời gian
                                                    </label>
                                                </div>
                                                <div class="candidate-checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        Thực tập
                                                    </label>
                                                </div>
                                                <div class="candidate-checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        Thực tập
                                                    </label>
                                                </div>
                                                <div class="candidate-checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        Thực tập
                                                    </label>
                                                </div>
                                                <div class="candidate-checkbox">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        Thực tập
                                                    </label>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div style="height: 120px" class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Tuổi
                                                <div class="range">
                                                    <div class="range-slider">
                                                        <input id="age" type="text" data-slider-tooltip="always" /><br />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item age d-flex">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                Chứng chỉ
                                                <select name="" id="input" class="form-control form-group" required="required">
                                                    <option value="">Chọn một loại chứng chỉ</option>
                                                    <option value="">Toeic</option>
                                                    <option value="">IELF</option>
                                                </select>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 candidate-info">
                                        <a class="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        <a class="download"><i class="fa fa-download" aria-hidden="true"></i></a>
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
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            {{isset($candidates)?$candidates->render():''}}

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
                        <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal"> Không</button>
                        <button type="button" class="btn btn-blue btn-default candidate-popup-button-trash">
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
                                <a class="dropdown-item" href="#" data-id="{{$item->id}}">Xuất nhật ký</a>
                                <a class="dropdown-item" href="#" data-id="{{$item->id}}">Chi tiết ứng viên</a>
                            </div>
                        </li>
                        <li class="candidate-evaluate-header-control-item">
                            <a href="#" title="Đóng" data-dismiss="modal"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
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
                                <div class="candidate-evaluate-main-diary-list-scroll scroll"  >
                                    <div class="candidate-evaluate-loading">Đã tải hết dữ liệu</div>
                                    <div class="candidate-evaluate-loading">Đang tải dữ liệu mới ...</div>

                                    <div class="month-break" month="Tháng 7 năm 2018">
                                    </div>

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
                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-green c-white">Ứng viên tiềm năng</span>
                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                        <a class="dropdown-item" data-confirm="diary" href="#" data-id="16">Xóa</a>
                                                    </div>
                                                </div>
                                                <div class="bg">
                                                    <div class="diary-item-rate">
                                                        <span><i class="fa fa-star" aria-hidden="true"></i></span><span> Thật không thể tin nổi</span>
                                                    </div>
                                                    <div class="diary-item-notice">

                                                    </div>
                                                    <div class="diary-item-note">
                                                        Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

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
                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-red c-white">Ứng viên đang bận</span>
                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                        <a class="dropdown-item" href="#" data-confirm="diary" data-id="16">Xóa</a>
                                                    </div>
                                                </div>
                                                <div class="diary-item-rate">

                                                </div>
                                                <div class="bg">
                                                    <div class="diary-item-notice">
                                                        <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ lại cho ứng viên</span>
                                                    </div>
                                                    <div class="diary-item-note">
                                                        Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="month-break" month="Tháng 6 năm 2018">
                                    </div>

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
                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-blue c-white">Ứng viên có nhu cầu</span>
                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                        <a class="dropdown-item" data-confirm="diary" href="#" data-id="16">Xóa</a>
                                                    </div>
                                                </div>
                                                <div class="diary-item-rate">

                                                </div>
                                                <div class="diary-item-notice">
                                                    <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ phỏng vấn khi ứng viên có nhu cầu</span>
                                                </div>
                                                <div class="diary-item-note">
                                                    Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-green c-white">Ứng viên tiềm năng</span>
                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                        <a class="dropdown-item" data-confirm="diary" href="#" data-id="16">Xóa</a>
                                                    </div>
                                                </div>
                                                <div class="diary-item-rate">

                                                </div>
                                                <div class="bg">
                                                    <div class="diary-item-notice">
                                                        <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ phỏng vấn khi ứng viên có nhu cầu</span>
                                                    </div>
                                                    <div class="diary-item-note">
                                                        Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="month-break" month="Tháng 5 năm 2018">
                                    </div>

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
                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-yellow c-white">Ứng viên chưa có nhu cầu</span>
                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                        <a class="dropdown-item" data-confirm="diary" href="#" data-id="16">Xóa</a>
                                                    </div>
                                                </div>
                                                <div class="diary-item-rate">

                                                </div>
                                                <div class="bg">
                                                    <div class="diary-item-notice">
                                                        <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ lại khi ứng viên có nhu cầu</span>
                                                    </div>
                                                    <div class="diary-item-note">
                                                        Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-aqua c-white">Ứng viên hẹn phỏng vấn</span>
                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                        <a class="dropdown-item" data-confirm="diary" href="#" data-id="16">Xóa</a>
                                                    </div>
                                                </div>
                                                <div class="diary-item-rate">

                                                </div>
                                                <div class="bg">
                                                    <div class="diary-item-notice">
                                                        <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ phỏng vấn khi ứng viên có nhu cầu</span>
                                                    </div>
                                                    <div class="diary-item-note">
                                                        Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="month-break" month="Tháng 4 năm 2018">
                                    </div>

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
                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-brown c-white">Ứng viên sắp nghỉ</span>
                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                        <a class="dropdown-item" data-confirm="diary" href="#" data-id="16">Xóa</a>
                                                    </div>
                                                </div>
                                                <div class="diary-item-rate">

                                                </div>
                                                <div class="bg">
                                                    <div class="diary-item-notice">
                                                        <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ trước khi ứng viên nghỉ việc</span>
                                                    </div>
                                                    <div class="diary-item-note">
                                                        Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                    <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span class="bg-purple c-white">Ứng viên là sinh viên</span>
                                                    <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                        <a class="dropdown-item" data-confirm="diary" href="#" data-id="16">Xóa</a>
                                                    </div>
                                                </div>
                                                <div class="diary-item-rate">

                                                </div>
                                                <div class="bg">
                                                    <div class="diary-item-notice">
                                                        <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ trước khi ứng viên tốt nghiệp</span>
                                                    </div>
                                                    <div class="diary-item-note">
                                                        Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="option">
                                    <a href="#" id="updown" data-scroll='bottom'><i class="fa fa-chevron-circle-up" aria-hidden="true"></i></a>
                                    <a href="#" id="dropdownMenuButton" data-url="{{route('diary.ajax.list')}}" data-toggle="dropdown" data-render="false" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu list-type" aria-labelledby="dropdownMenuButton">
                                        {{-- <a class="dropdown-item" data-type="tiemnang" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-green" aria-hidden="true"></i> Ứng viên tiềm năng</a>
                                        <a class="dropdown-item" data-type="ban" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-red" aria-hidden="true"></i> Ứng viên bận</a>
                                        <a class="dropdown-item" data-type="conhucau" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-blue" aria-hidden="true"></i> Ứng viên có nhu cầu</a>
                                        <a class="dropdown-item" data-type="chuaconhucau" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-yellow" aria-hidden="true"></i> Ứng viên chưa có nhu cầu</a>
                                        <a class="dropdown-item" data-type="henphongvan" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-aqua" aria-hidden="true"></i> Ứng viên hẹn phỏng vấn</a>
                                        <a class="dropdown-item" href="#" data-type="sapnghi" data-id="{{$item->id}}"><i class="fa fa-circle c-brown" aria-hidden="true"></i> Ứng viên sắp nghỉ</a>
                                        <a class="dropdown-item" data-type="sinhvien" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-purple" aria-hidden="true"></i> Ứng viên là sinh viên</a> --}}
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
                                            <input type="text text-center" name="set-calendar-date" class="full-width form-group datetimepicker" placeholder="20/10/2017">
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 candidate-evaluate-main-diary-composer-input">
                                            lúc
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-input">
                                            <input type="text text-center timepicker" name="set-calendar-time" placeholder="20:30" class="full-width form-group">
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
                            Bạn có muốn xóa nhật ký này?
                        </div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="button" class="btn btn-secondary btn-close">Đóng</button>
                                <button type="button" class="btn btn-default btn-delete">Xóa</button>
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
                                <button type="button" class="btn btn-secondary btn-close">Đóng</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(function () {
            var options = {
                placeholder: 'Soạn Mail ...',
                modules: {
                    toolbar: [
                        [{ 'font': [] }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        ['bold', 'italic', 'underline'],        // toggled buttons
                        [{ 'color': [] }, { 'background': [] }],
      // custom button values
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                        [{ 'direction': 'rtl' }],                         // text direction
                        [{ 'align': [] }],
                        ['blockquote', 'code-block', 'link'],
                        ['clean']                                     // remove formatting button
                    ]
                },
                theme: 'snow'
            };

            var quill = new Quill('#editor', options);

        })
    </script>

    @if(Session::has('message'))


        <script type="text/javascript">

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
            }

            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }

        </script>
    @endif
@endsection

