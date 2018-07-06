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
                                    <b>{{$candidates->firstItem()!=0?$candidates->firstItem():0}} - {{$candidates->lastItem()!=0?$candidates->lastItem():0}} </b> trong
                                    <b> {{$total}} </b> ứng viên <span></span>
                                </div>
                            @endif
                            <div class="card-body candidate-list">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 candidate-main">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                            @isset($candidates)
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
                                                                                <h6>{{!empty($item->source->so_name)?$item->source->so_name:'Chưa có nguồn'}} - {{!empty($item->can_title)?$item->can_title:''}}</h6>
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
                                                                            <div class="box-text">{{empty($item->can_address)?'Chưa có địa chỉ':$item->can_address}}</div>
                                                                        </div> <!-- /. box -->
                                                                        <div class="box ">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">{{!empty($item->can_year)?(date('Y')-$item->can_year).' tuổi':(!empty($item->can_birthday)?floor((time() - strtotime($item->can_birthday)) / (60*60*24*365)).' tuổi':'Chưa có ngày sinh')}} </div>
                                                                        </div> <!-- /. box -->

                                                                        <div class="box ">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">{{empty($item->can_phone)?'Chưa có số điện thoại': (stripos($item->can_phone,'0')!=false?'0'.$item->can_phone:$item->can_phone)}}</div>
                                                                        </div> <!-- /. box -->
                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{empty($item->can_email)?'Chưa có Email':$item->can_email}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                    </div>
                                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-skype" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{!empty($item->can_skype)?$item->can_skype:$update}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->


                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{!empty($item->can_facebook)?$item->can_facebook:$update}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->


                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{$item->can_linkedin or $update}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                        <div class="box">
                                                                            <div class="box-icon">
                                                                                <i class="fa fa-github" aria-hidden="true"></i>
                                                                            </div>
                                                                            <div class="box-text">
                                                                                <a href="#">{{$item->can_github or $update}}</a>
                                                                            </div>
                                                                        </div> <!-- /. box -->

                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="row">

                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                                            <span> - 5 sao</span>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consectetur eum facere inventore, maiores maxime pariatur quo saepe unde veritatis. Asperiores deleniti dignissimos eaque magni minima natus porro quae vel.</div>
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
                                                        <label class="full-width"><input type="radio" name="candidate_status" checked> Ứng viên mới
                                                            <span class="badge pull-right">151</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status"> Ứng viên mới cập nhật
                                                            <span class="badge pull-right">240</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status"> Đánh giá cao nhất
                                                            <span class="badge pull-right">360</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status"> Đánh giá thấp nhất
                                                            <span class="badge pull-right">100</span></label></li>
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Nguồn ứng viên</div>
                                                <ul>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status" checked> 123job
                                                            <span class="badge pull-right">151</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status"> vietnamwork
                                                            <span class="badge pull-right">240</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status"> itviec
                                                            <span class="badge pull-right">360</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status"> vieclam24h
                                                            <span class="badge pull-right">100</span></label></li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status"> careerbuilder
                                                            <span class="badge pull-right">100</span></label></li>
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex evaluate" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Đánh giá</div>
                                                <ul>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status" checked>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i><span class="badge pull-right">151</span></label>
                                                    </li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i><span class="badge pull-right">240</span></label>
                                                    </li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i><span class="badge pull-right">360</span></label>
                                                    </li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o" aria-hidden="true"></i><span class="badge pull-right">100</span></label>
                                                    </li>
                                                    <li>
                                                        <label class="full-width"><input type="radio" name="candidate_status">
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
                                                <select class="select2" name="workplace[]" multiple="multiple">
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
                                                <select class="select2" name="career[]" multiple="multiple">
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
                                                <select class="select2" name="career[]" multiple="multiple">
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
                            <li class="nav-item active">
                                <a href="#"><img src="http://icons.iconarchive.com/icons/icons8/ios7/32/Users-Edit-User-icon.png">
                                    <p>Nhật ký</p></a></li>
                            <li class="nav-item"><a href="#"><img src="upload/icon/icons8-open-envelope-50.png">
                                    <p>Mail</p></a></li>
                        </ul>
                    </div>
                    <div class="candidate-evaluate-main">
                        <div class="candidate-evaluate-main-diary">
                            <div class="candidate-evaluate-main-diary-list" data-simplebar>
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
                                                <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span><i class="fa fa-circle c-green" aria-hidden="true"></i> Ứng viên tiềm năng</span>
                                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                    <a class="dropdown-item" href="#" data-id="16">Xóa</a>
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
                                                <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span><i class="fa fa-circle c-red" aria-hidden="true"></i> Ứng viên đang bận</span>
                                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                    <a class="dropdown-item" href="#" data-id="16">Xóa</a>
                                                </div>
                                            </div>
                                            <div class="diary-item-rate">

                                            </div>
                                            <div class="diary-item-notice">
                                                <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ lại cho ứng viên</span>
                                            </div>
                                            <div class="diary-item-note">
                                                Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
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
                                                <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span><i class="fa fa-circle c-blue" aria-hidden="true"></i> Ứng viên có nhu cầu</span>
                                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                    <a class="dropdown-item" href="#" data-id="16">Xóa</a>
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
                                                <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span><i class="fa fa-circle c-green" aria-hidden="true"></i> Ứng viên tiềm năng</span>
                                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                    <a class="dropdown-item" href="#" data-id="16">Xóa</a>
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
                                                <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span><i class="fa fa-circle c-yellow" aria-hidden="true"></i> Ứng viên chưa có nhu cầu</span>
                                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                    <a class="dropdown-item" href="#" data-id="16">Xóa</a>
                                                </div>
                                            </div>
                                            <div class="diary-item-rate">

                                            </div>
                                            <div class="diary-item-notice">
                                                <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ lại khi ứng viên có nhu cầu</span>
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
                                                <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span><i class="fa fa-circle c-aqua" aria-hidden="true"></i> Ứng viên hẹn phỏng vấn</span>
                                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                    <a class="dropdown-item" href="#" data-id="16">Xóa</a>
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
                                                <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span><i class="fa fa-circle c-brown" aria-hidden="true"></i> Ứng viên sắp nghỉ</span>
                                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                    <a class="dropdown-item" href="#" data-id="16">Xóa</a>
                                                </div>
                                            </div>
                                            <div class="diary-item-rate">

                                            </div>
                                            <div class="diary-item-notice">
                                                <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ trước khi ứng viên nghỉ việc</span>
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
                                                <span>Nguyễn HR, </span><span>20:30 ngày 15</span><span><i class="fa fa-circle c-purple" aria-hidden="true"></i> Ứng viên là sinh viên</span>
                                                <a href="#" class="pull-right" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                <div class="dropdown-menu show" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(735px, 67px, 0px);" x-out-of-boundaries="">
                                                    <a class="dropdown-item" href="#" data-id="16">Xóa</a>
                                                </div>
                                            </div>
                                            <div class="diary-item-rate">

                                            </div>
                                            <div class="diary-item-notice">
                                                <span><i class="fa fa-clock-o"></i> 23:30, 21 tháng 5, báo trước 5 phút </span><span><i class="fa fa-bullhorn"></i> Liên hệ trước khi ứng viên tốt nghiệp</span>
                                            </div>
                                            <div class="diary-item-note">
                                                Ứng viên tinh thông mọi kỹ năng, đang được các nhà tuyển dụng tuy lùng gắt gao
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="candidate-evaluate-loading">Đang tải dữ liệu mới ...</div>
                                <div class="candidate-evaluate-loading">Đã tải hết dữ liệu</div>

                                <div class="option">
                                    <a href="#" id="updown"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                                    <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-green" aria-hidden="true"></i> Ứng viên tiềm năng</a>
                                        <a class="dropdown-item" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-red" aria-hidden="true"></i> Ứng viên bận</a>
                                        <a class="dropdown-item" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-blue" aria-hidden="true"></i> Ứng viên có nhu cầu</a>
                                        <a class="dropdown-item" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-yellow" aria-hidden="true"></i> Ứng viên chưa có nhu cầu</a>
                                        <a class="dropdown-item" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-aqua" aria-hidden="true"></i> Ứng viên hẹn phỏng vấn</a>
                                        <a class="dropdown-item" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-brown" aria-hidden="true"></i> Ứng viên sắp nghỉ</a>
                                        <a class="dropdown-item" href="#" data-id="{{$item->id}}"><i class="fa fa-circle c-purple" aria-hidden="true"></i> Ứng viên là sinh viên</a>
                                    </div>
                                </div>
                            </div>
                            <div class="candidate-evaluate-main-diary-composer" data-click="false" >
                                <div style="display: block" class="box1 margin-bottom">
                                    <div class="row candidate-evaluate-main-diary-composer-row">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-title">
                                            Ghi chú
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 candidate-evaluate-main-diary-composer-input">
                                            <textarea name="" rows="1" class="full-width form-group"></textarea>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                            <a href="#" class="candidate-evaluate-main-diary-composer-push"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div style="opacity: 0;" class="row box2 candidate-evaluate-main-diary-composer-row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-title">
                                        Đặt lịch
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-input">
                                        <input type="text" class="full-width form-group">
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 candidate-evaluate-main-diary-composer-input">
                                        lúc
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-input">
                                        <input type="text" class="full-width form-group">
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 candidate-evaluate-main-diary-composer-input">
                                        trước
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-input">
                                        <input type="text" class="full-width form-group">
                                    </div>
                                </div>
                                <div style="opacity: 0;" class="row box2 candidate-evaluate-main-diary-composer-row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-title">
                                        Thông báo
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 candidate-evaluate-main-diary-composer-input">
                                        <input type="text" class="form-group full-width">
                                    </div>

                                </div>
                                <div class="box3 margin-bottom" style="display: none">
                                    <div class="row candidate-evaluate-main-diary-composer-row">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 candidate-evaluate-main-diary-composer-title">
                                            Ghi chú
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 candidate-evaluate-main-diary-composer-input">
                                            <textarea name="" rows="1" class="full-width form-group"></textarea>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                            <a href="#" class="candidate-evaluate-main-diary-composer-push"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(function () {
            var hyhy=0;
            $('a[href="#candidate-evaluate"]').click(function () {
                setTimeout(function () {
                    var listHeight = $('.candidate-evaluate-main-diary-list').height();
                    $('.candidate-evaluate-main-diary-composer').on('mouseenter', function () {
                        $('.candidate-evaluate-main-diary-list').scrollTop(listHeight);
                        var mainHeight = $('.candidate-evaluate-main').height();

                        var composerHeight = $(this).height();
                        hyhy= mainHeight - composerHeight + 'px';
                        $('.candidate-evaluate-main-diary-list').animate({
                            height: mainHeight - composerHeight + 'px'
                        }, 300);
                        $('.candidate-evaluate-main-diary-composer').off('click').on('click',function () {
                            $('.candidate-evaluate-main-diary-list').height(hyhy);
                            $('.candidate-evaluate-main-diary-composer').attr('click',true);
                        })
                    });

                    $('.candidate-evaluate-main-diary-composer').on('mouseleave', function () {
                        if($('.candidate-evaluate-main-diary-composer').attr('click')==true){
                            $('.candidate-evaluate-main-diary-list').animate({
                                height: listHeight + 'px'
                            }, 300);
                        }
                        $(document).off('click').on('click',function () {
                            $('.candidate-evaluate-main-diary-composer').attr('click',false);
                            $('.candidate-evaluate-main-diary-list').animate({
                                height: listHeight + 'px'
                            }, 300);
                        })
                    });

                },200);
            })




        });
    </script>

    @if(Session::has('message'))


        <script type="text/javascript">

            new SimpleBar($('.time_line')[0]);
            new SimpleBar($('.candidate-evaluate-main-diary-list')[0]);

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

