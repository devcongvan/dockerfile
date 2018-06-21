@extends('layout.master')

@section('title')
Danh sách ứng viên
@endsection

@section('content')
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
                                <a href="candidate/add" class="btn btn-default btn-blue"><i class="fa fa-plus" aria-hidden="true"></i> Thêm ứng viên</a>
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
                            <div class="card-searchinfo">
                                <b>1 - 12 </b> trong <b> 208551 </b> ứng viên <span></span>
                            </div>
                            <div class="card-body candidate-list">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 candidate-main">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->

                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->

                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->

                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->

                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->

                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->

                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->

                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->

                                            <div class="candidate-item row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <div class="candidate-item-left">
                                                        <div class="image">
                                                            <img class="img-responsive" src="https://tinbandoc.com/wp-content/uploads/2016/01/hinh-anh-girl-xinh-mien-tay-de-thuong.jpg" alt="">
                                                        </div>
                                                        <div class="option">
                                                            <button type="button" style="background: #808080;color: #fff;" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</button>
                                                            <button type="button" style="background: #AB1D1D;color: #fff;" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
                                                        </div>
                                                    </div> <!-- /. candidate item left -->
                                                </div>
                                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                    <div class="candidate-item-main">
                                                        <div class="candidate-item-main-row">
                                                            <h5 class="pull-left candidate-item-main-name" toggle="false">Nguyễn Công Văn</h5>
                                                            <div class="pull-right time"><i class="fa fa-calendar" aria-hidden="true"></i> 22/05/2018</div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="candidate-item-main-row">
                                                            <div>Lập trình viên PHP</div>
                                                        </div>
                                                        <div class="candidate-item-main-row row special-box">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                                    <div class="box-text">Hà Nội</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                                                                    <div class="box-text">22 tuổi</div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                                                    <div class="box-text">0969.516.0425</div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">devcongvan@gmail.com</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                        <div class="candidate-item-main-row row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-skype" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-facebook-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                                <div class="box">
                                                                    <div class="box-icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                                                                    <div class="box-text"><a href="#">https://www.facebook.com/van.nguyen.cong</a></div>
                                                                </div> <!-- /. box -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- /. candidate item -->
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 candidate-sidebar">
                                        <h5 class="pull-left">Tìm kiếm nâng cao</h5>
                                        <div class="clearfix"></div>

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Thứ tự sắp xếp</div>
                                                <ul>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status" checked> Ứng viên mới <span class="badge pull-right">151</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> Ứng viên mới cập nhật <span class="badge pull-right">240</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> Đánh giá cao nhất <span class="badge pull-right">360</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> Đánh giá thấp nhất <span class="badge pull-right">100</span></label></li>
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Nguồn ứng viên</div>
                                                <ul>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status" checked> 123job <span class="badge pull-right">151</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> vietnamwork <span class="badge pull-right">240</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> itviec <span class="badge pull-right">360</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> vieclam24h <span class="badge pull-right">100</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> careerbuilder <span class="badge pull-right">100</span></label></li>
                                                </ul>
                                            </div>
                                        </div> <!-- /. candidate sidebar item -->

                                        <div class="candidate-sidebar-item radiobox d-flex" style="">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div>Đánh giá</div>
                                                <ul>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status" checked> 123job <span class="badge pull-right">151</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> vietnamwork <span class="badge pull-right">240</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> itviec <span class="badge pull-right">360</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> vieclam24h <span class="badge pull-right">100</span></label></li>
                                                    <li><label class="full-width"><input type="radio" name="candidate_status"> careerbuilder <span class="badge pull-right">100</span></label></li>
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
                                                        <input id="salary" type="text" data-slider-tooltip="always"/><br/>
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
                                                        <input id="age" type="text" data-slider-tooltip="always"/><br/>
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
                                                                <h5>Nguyễn Công Văn</h5>
                                                                <h6>Lập trình viên PHP</h6>
                                                            </div>
                                                        </div>
                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                THÔNG TIN CƠ BẢN <span></span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-calendar" aria-hidden="true"></i> <span>15/10/1998</span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-male" aria-hidden="true"></i> <span>Nam</span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-phone" aria-hidden="true"></i> <span>0969516425</span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <span><a href="#">devcongvan@gmail.com</a></span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i> <span>Số 42 Trần Quang Diệu, phường Ô Chợ Dừa, quận Đống Đa, Hà Nội</span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-skype" aria-hidden="true"></i> <span><a href="#">https://skype.com</a></span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-facebook" aria-hidden="true"></i> <span><a href="#">https://facebook.com</a></span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-linkedin" aria-hidden="true"></i> <span><a href="#">https://linkedin.com</a></span>
                                                            </div>
                                                            <div class="candidate-cv-item">
                                                                <i class="fa fa-github" aria-hidden="true"></i> <span><a href="#">https://github.com</a></span>
                                                            </div>
                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                CHỨNG CHỈ <span></span>
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

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left candidate-cv-item-time">
                                                                    22/05/2018
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Chứng chỉ tin học loại A1 - Khá
                                                                    Chứng chỉ tin học loại A1 - Khá
                                                                </div>
                                                            </div>

                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                GIẢI THƯỞNG <span></span>
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

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left candidate-cv-item-time">
                                                                    22/05/2018
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Chứng chỉ tin học loại A1 - Khá
                                                                    Chứng chỉ tin học loại A1 - Khá
                                                                </div>
                                                            </div>

                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box skill">
                                                            <div class="candidate-cv-box-title">
                                                                KỸ NĂNG <span></span>
                                                            </div>

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

                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                SỞ THÍCH <span></span>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                Áp dụng những kinh nghiệm về kỹ năng giao tiếp và sự
                                                                nhẫn nại trong công việc để trở thành một nhân viên
                                                                nhân sự chuyên nghiệp, thu hút được nhiều nhân viên tài
                                                                năng cho công ty, mang đến nhiều giá trị cho khách
                                                                hàng. Từ đó giúp Công ty tăng sự tin cậy và uy tín trên thị
                                                                trường lao động, đem lại hiệu quả cho công ty.

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
                                                                <div class="candidate-cv-item-right">
                                                                    Hà Nội
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Ngành nghề
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    IT phần mềm, IT phần cứng
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Kỹ năng
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Photoshop, PHP, HTML, CSS, Laravel, jQuery, Ajax
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Địa điểm làm việc
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Hà Nội, Hồ Chí Minh
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Mong muốm làm việc tại nước ngoài
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Có
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Kinh nghiệm làm việc
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Dưới 1 năm
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Trình độ chuyên môn
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Sinh viên
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Trình độ tiếng anh
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Đọc hiểu
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Loại hình công việc
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    Toàn thời gian
                                                                </div>
                                                            </div>

                                                            <div class="candidate-cv-item">
                                                                <div class="candidate-cv-item-left">
                                                                    Mức lương
                                                                </div>
                                                                <div class="candidate-cv-item-right">
                                                                    5 - 7 triệu
                                                                </div>
                                                            </div>
                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                HỌC VẤN <span></span>
                                                            </div>

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
                                                                    - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng. <br>
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
                                                                    - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng. <br>
                                                                    - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                    uống. <br>
                                                                    -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                    về dịch vụ. <br>
                                                                </div>
                                                            </div> <!-- /. candidate-cv-item -->
                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                KINH NGHIỆM THỰC TẾ <span></span>
                                                            </div>

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
                                                                    - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng. <br>
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
                                                                    - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng. <br>
                                                                    - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                    uống. <br>
                                                                    -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                    về dịch vụ. <br>
                                                                </div>
                                                            </div> <!-- /. candidate-cv-item -->
                                                        </div> <!-- /. candidate-cv-box -->

                                                        <div class="candidate-cv-box">
                                                            <div class="candidate-cv-box-title">
                                                                HOẠT ĐỘNG <span></span>
                                                            </div>

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
                                                                    - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng. <br>
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
                                                                    - Hỗ trợ nhằm đáp ứng nhu cầu của khách hàng. <br>
                                                                    - Giao tiếp, trao đổi với khách hàng về nhu cầu dịch vụ ăn
                                                                    uống. <br>
                                                                    -Thương lượng khi khách hàng phân vân, không hài lòng
                                                                    về dịch vụ. <br>
                                                                </div>
                                                            </div> <!-- /. candidate-cv-item -->
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
                            <ul class="pagination pagination-sm">
                                <li class="page-item"><a href="#" class="page-link">«</a></li>
                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">»</a></li>
                            </ul>
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
@endsection
