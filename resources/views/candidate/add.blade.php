@extends('layout.master')

@section('title')
    Thêm ứng viên
@endsection

@section('content')
    <div class="content-wrapper candidate">
        <!-- Content Header (Page header) -->
        <div class="content-header candidate-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Thêm ứng viên</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="candidate-list.html" class="btn btn-default btn-blue"><i class="nav-icon fa fa-file-excel-o" aria-hidden="true"></i> Thêm bằng Excel</a>
                                <a href="candidate/list" class="btn btn-default btn-blue"><i class="nav-icon fa fa-list-ul" aria-hidden="true"></i> Danh sách ứng viên</a>

                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <span class="line"></span>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <section class="content candidate-add">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-9 candidate-sideright">
                        <!-- box thông tin cơ bản -->
                        <div class="card" id="thongtincoban">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Thông tin cơ bản
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox">
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <div class="candidateBox-row row ml-14">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                Họ tên <span class="important">*</span>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                <input  type="text" name="" placeholder="Nguyễn Văn A" class="form-group candidate-input">
                                            </div>
                                        </div> <!-- /. candidateBox row -->
                                        <div class="candidateBox-row row ml-14">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                Ngày sinh <span class="important">*</span>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                <input  type="text" name="" placeholder="10/10/2000" class="datepicker form-group candidate-input">
                                            </div>
                                        </div>
                                        <div class="candidateBox-row row ml-14">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                Giới tính <span class="important">*</span>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                <label style="margin-right: 50px;">
                                                    <span><input  type="radio" name="gender" class="form candidate-input-group"></span> Nam
                                                </label>
                                                <label>
                                                    <input  type="radio" name="gender" class="form candidate-input-group"> <span>Nữ</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <input type="file" name="file" id="file">
                                        <a class="candidate-upimage"><span>Click để thêm ảnh đại điện</span></a>
                                        <a class="avatar candidate-upimage" style="display: none;">
                                            <img id="after_image"></img>
                                            <div class="avatar-text">Đổi ảnh đại diện</div>
                                        </a>
                                        <!-- <button type="button" class="btn btn-default">Đổi ảnh</button> -->
                                    </div>
                                </div> <!-- /. candidateBox -->
                                <div class="row candidateBox">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div class="row candidateBox-row">
                                            Điện thoại
                                            <input type="text" name="" placeholder="0969516425" class="form-group">
                                        </div>
                                        <div class="row candidateBox-row">
                                            Email
                                            <input type="text" name="" placeholder="devcongvan@gmail.com" class="form-group">
                                        </div>
                                        <div class="row candidateBox-row">
                                            Quê quán
                                            <div style="margin-bottom: 5px; display: block; width: 100%; height: 0px;"></div>
                                            <select class="select2" name="hometown">
                                                <option>-- Chọn một tỉnh thành --</option>
                                                <option value="hanoi">Hà Nội</option>
                                                <option value="hochiminh">Hồ Chí Minh</option>
                                                <option value="dannag">Đã Nẵng</option>
                                                <option value="haiphong">Hải Phòng</option>
                                                <option value="haiduong">Hải Dương</option>
                                            </select>
                                        </div>
                                        <div class="row candidateBox-row">
                                            Địa chỉ
                                            <input type="text" name="" placeholder="Lê Thanh Nghị, Hai Bà Trưng, Hà Nội" class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div class="row candidateBox-row">
                                            Skype
                                            <input type="text" placeholder="https://www.facebook.com/" name="" class="form-group">
                                        </div>
                                        <div class="row candidateBox-row">
                                            Facebook
                                            <input type="text" placeholder="https://www.facebook.com/" name="" class="form-group">
                                        </div>
                                        <div class="row candidateBox-row">
                                            LinkedIn
                                            <input type="text" placeholder="https://www.facebook.com/" name="" class="form-group">
                                        </div>
                                        <div class="row candidateBox-row">
                                            Github
                                            <input type="text" placeholder="https://www.facebook.com/" name="" class="form-group">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- box hồ sơ ứng viên -->
                        <div class="card" id="hosoungvien">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Hồ sơ ứng viên
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div class="row candidateBox-row">
                                            Chức danh
                                            <div class="ui-widget" style="width: 100%">
                                                <input type="text" name="" id="chucdanh" placeholder="Nhập tên kỹ năng" class="form-group">
                                            </div>
                                        </div>
                                        <div class="row candidateBox-row">
                                            Ngành nghề
                                            <select id="career" name="career[]" multiple="multiple" data-placeholder="sfsdf">
                                                @foreach($careers as $item)
                                                <option value="{{$item->id}}">{{$item->ca_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row candidateBox-row">
                                            Kỹ năng
                                            <select class="select2" id="skill" name="skill[]" multiple="multiple">
                                                <option value="hanoi">Laravel</option>
                                                <option value="hochiminh">Bootstrap</option>
                                                <option value="dannag">jQuery</option>
                                                <option value="haiphong">Ajax</option>
                                                <option value="haiduong">Sass</option>
                                            </select>
                                        </div>
                                        <div class="row candidateBox-row">
                                            Địa điểm làm việc
                                            <select class="select2" id="workplace" name="workplace[]" multiple="multiple">
                                                <option value="hanoi">Hà Nội</option>
                                                <option value="hochiminh">Hải Phòng</option>
                                                <option value="dannag">Đà Nẵng</option>
                                                <option value="haiphong">Hồ Chí Minh</option>
                                                <option value="haiduong">Huế</option>
                                            </select>
                                        </div>

                                        <div class="row candidateBox-row want-to-abroad">
                                            <p>Mong muốn làm việc tại nước ngoài</p>
                                            <div class="clearfix"></div>
                                            <label style="margin-right: 50px;">
                                                <span><input  type="radio" name="gender" class="form candidate-input-group"></span> Có
                                            </label>
                                            <label>
                                                <input  type="radio" name="gender" class="form candidate-input-group"> <span>Không</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div class="row candidateBox-row">
                                            Kinh nghiệm
                                            <select class="form-group">
                                                <option>-- Chọn thời gian kinh nghiệm --</option>
                                                <option>Chưa có kinh nghiệm</option>
                                                <option>Dưới 1 năm</option>
                                                <option>1 năm</option>
                                                <option>2 năm</option>
                                                <option>3 năm</option>
                                            </select>
                                        </div>

                                        <div class="row candidateBox-row">
                                            Trình độ chuyên môn
                                            <select class="form-group">
                                                <option>-- Chọn trình độ chuyên môn --</option>
                                                <option>Sinh viên</option>
                                                <option>Mới ra trường</option>
                                                <option>Có kinh nghiệm</option>
                                                <option>Trưởng nhóm</option>
                                                <option>Quản lý/Giám sát</option>
                                                <option>Chuyên gia</option>
                                                <option>Giám đốc</option>
                                            </select>
                                        </div>
                                        <div class="row candidateBox-row">
                                            Trình độ tiếng anh
                                            <select class="form-group">
                                                <option>-- Chọn trình độ tiếng anh --</option>
                                                <option>Không biết</option>
                                                <option>Đọc hiểu cơ bản</option>
                                                <option>Đọc/viết tốt tài liệu chuyên môn</option>
                                                <option>Giao tiếp tốt</option>
                                                <option>Thành thục mọi kỹ năng</option>
                                            </select>
                                        </div>
                                        <div class="row candidateBox-row">
                                            Loại hình công việc
                                            <select class="form-group">
                                                <option>-- Chọn loại hình công việc --</option>
                                                <option>Toàn thời gian</option>
                                                <option>Bán thời gian</option>
                                                <option>Thực tập</option>
                                            </select>
                                        </div>
                                        <div class="row candidateBox-row">
                                            Mức lương
                                            <select class="form-group">
                                                <option>-- Chọn mức lương mong muốn --</option>
                                                <option>Dưới 3 triệu</option>
                                                <option>3 - 5 triệu</option>
                                                <option>5 - 7 triệu</option>
                                                <option>7 - 10 triệu</option>
                                                <option>10 - 12 triệu</option>
                                                <option>12 - 15 triệu</option>
                                                <option>Thỏa thuận</option>
                                            </select>
                                        </div>

                                        <div class="row candidateBox-row">
                                            Nguồn
                                            <div style="margin-bottom: 5px; display: block; width: 100%; height: 0px;"></div>
                                            <select class="select2" name="source">
                                                <option>-- Chọn một nguồn --</option>
                                                <option value="">123job</option>
                                                <option value="">vietnamwork</option>
                                                <option value="">itviec</option>
                                                <option value="">careerbuilder</option>
                                                <option value="">vieclam24h</option>
                                                <option value="">123job</option>
                                                <option value="">vietnamwork</option>
                                                <option value="">itviec</option>
                                                <option value="">careerbuilder</option>
                                                <option value="">vieclam24h</option>
                                                <option value="">123job</option>
                                                <option value="">vietnamwork</option>
                                                <option value="">itviec</option>
                                                <option value="">careerbuilder</option>
                                                <option value="">vieclam24h</option>
                                                <option value="">123job</option>
                                                <option value="">vietnamwork</option>
                                                <option value="">itviec</option>
                                                <option value="">careerbuilder</option>
                                                <option value="">vieclam24h</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">

                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- box mục tiêu nghề nghiệp -->
                        <div class="card" id="muctieunghenghiep">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Mục tiêu nghề nghiệp
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Mục tiêu
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <textarea class="form-group"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row candidateBox">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Về bản thân
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <textarea class="form-group"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- box kinh nghiệm làm việc -->
                        <div class="card" id="kinhnghiemlamviec">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Kinh nghiệm làm việc
                                </h3>
                                <button type="button" class="btn btn-clone btn-default "><i class="fa fa-plus"></i> Thêm kinh nghiệm</button>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox border-bottom">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Tên công ty
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Nhập tên công ty" class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Thời gian
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="10/10/2000" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                        <div class="row candidateBox-row center-block">
                                            <p style="margin: auto;">đến</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="10/10/2000" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Chức vụ
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Quá trình làm việc
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <textarea class="form-group"></textarea>
                                        </div>
                                    </div>
                                    <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                </div> <!-- /. row -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- box hoạt động -->
                        <div class="card" id="hocvan">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Học vấn
                                </h3>
                                <button type="button" class="btn btn-clone btn-default "><i class="fa fa-plus"></i> Thêm học vấn</button>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox border-bottom">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Tên trường/ trung tâm
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Nhập tên công ty" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Thời gian
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="10/10/2000" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                        <div class="row candidateBox-row center-block">
                                            <p style="margin: auto;">đến</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="10/10/2000" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Khoa, ngành
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Quá trình học tập
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <textarea class="form-group"></textarea>
                                        </div>
                                    </div>
                                    <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                </div> <!-- /. row -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- box chứng chỉ -->
                        <div class="card" id="hoatdong">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Hoạt động
                                </h3>
                                <button type="button" class="btn btn-clone btn-default "><i class="fa fa-plus"></i> Thêm hoạt động</button>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox border-bottom">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Tên hoạt động
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Nhập tên công ty" class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Thời gian
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="10/10/2000" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                        <div class="row candidateBox-row center-block">
                                            <p style="margin: auto;">đến</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="10/10/2000" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Vị trí đảm nhận
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Quá trình hoạt động
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <textarea class="form-group"></textarea>
                                        </div>
                                    </div>
                                    <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                </div> <!-- /. row -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- box giải thưởng -->
                        <div class="card" id="chungchi">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Chứng chỉ
                                </h3>
                                <button type="button" class="btn btn-clone btn-default "><i class="fa fa-plus"></i> Thêm chứng chỉ</button>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox border-bottom">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Thời gian cấp
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Nhập thời gian cấp" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Tên chứng chỉ
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Nhập tên công ty" class="form-group">
                                        </div>
                                    </div>
                                    <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                </div> <!-- /. row -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- box kỹ năng -->
                        <div class="card" id="giaithuong">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Giải thưởng
                                </h3>
                                <button type="button" class="btn btn-clone btn-default "><i class="fa fa-plus"></i> Thêm giải thưởng</button>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox border-bottom">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Thời gian cấp
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Nhập thời gian cấp" class="datepicker form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Tên giải thưởng
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="" placeholder="Nhập tên công ty" class="form-group">
                                        </div>
                                    </div>
                                    <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                </div> <!-- /. row -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- box sở thích -->
                        <div class="card" id="kynang">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Kỹ năng
                                </h3>
                                <button type="button" class="btn btn-clone btn-default "><i class="fa fa-plus"></i> Thêm kỹ năng</button>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox border-bottom">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Tên kỹ năng
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <input type="text" name="kynang" placeholder="Nhập thời gian cấp" class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Đánh giá
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <div class="rateskill">
                                                <div class="rateskill-item" data-value="1" data-hehe="5"></div>
                                                <div class="rateskill-item" data-value="2" data-hehe="5"></div>
                                                <div class="rateskill-item" data-value="3" data-hehe="5"></div>
                                                <div class="rateskill-item" data-value="4" data-hehe="5"></div>
                                                <div class="rateskill-item" data-value="5" data-hehe="5"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="remove-item remove-item-right"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                </div> <!-- /. row -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card" id="sothich">
                            <div class="card-header  p-0">
                                <h3 class="card-title ">
                                    Sở thích
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row candidateBox border-bottom">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="row candidateBox-row">
                                            Nội dung
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <div class="row candidateBox-row">
                                            <textarea class="form-group" placeholder="Nhập sở thích của bạn"></textarea>
                                        </div>
                                    </div>
                                </div> <!-- /. row -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <button type="button" class="btn btn-default btn-submit btn-blue">Thêm</button>
                    </section>
                    <section class="col-lg-3 candidate-sideleft">
                        <!-- Custom tabs (Charts with tabs)-->
                        <ul class="navprofile">
                            <li class="navprofile-item"><a href="#thongtincoban" class="active">Thông tin cơ bản</a></li>
                            <li class="navprofile-item"><a href="#hosoungvien">Hồ sơ ứng viên</a></li>
                            <li class="navprofile-item"><a href="#muctieunghenghiep">Mục tiêu nghề nghiệp</a></li>
                            <li class="navprofile-item"><a href="#kinhnghiemlamviec">Kinh nghiệm làm việc</a></li>
                            <li class="navprofile-item"><a href="#hocvan">Học vấn</a></li>
                            <li class="navprofile-item"><a href="#hoatdong">Hoạt động</a></li>
                            <li class="navprofile-item"><a href="#chungchi">Chứng chỉ</a></li>
                            <li class="navprofile-item"><a href="#giaithuong">Giải thưởng</a></li>
                            <li class="navprofile-item"><a href="#kynang">Kỹ năng</a></li>
                            <li class="navprofile-item"><a href="#sothich">Sở thích</a></li>
                        </ul>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
