@extends('layout.master')

@section('title')
    Danh sách kỹ năng
@endsection

@section('content')
    <div class="content-wrapper candidate">
        <!-- Content Header (Page header) -->
        <div class="content-header candidate-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Danh sách kỹ năng</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="skill/new" class="btn btn-default btn-blue"><i class="nav-icon fa fa-plus" aria-hidden="true"></i> Thêm kỹ năng</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @if(session('success'))
                    <div class="row" style="color: red">Thông báo: {{session('success')}}</div>
                @endif
                @if(session('fail'))
                    <div class="row" style="color: red">Thông báo: {{session('fail')}}</div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content candidate-add">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 candidate-sideright">
                        <!-- box thông tin cơ bản -->
                        <div class="card" id="thongtincoban">
                            <div class=" p-0 row">
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <input type="text" name="" class="form-group" placeholder="Ghõ tên kỹ năng">
                                </div>
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <select class="form-group">
                                        <option value="">-- Tìm kiếm tùy chọn --</option>
                                        <option value="">Kỹ năng mới</option>
                                        <option value="">Kỹ năng nhiều ứng viên nhất</option>
                                    </select>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <button type="button" class="btn btn-default full-width btn-blue"><i class="nav-icon fa fa-search" aria-hidden="true"></i> Tìm kiếm</button>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-searchinfo">
                                <b>1 - 12</b> trong <b>{{$skills->count()}}</b> kỹ năng <span></span>
                            </div>
                            <div class="card-body" style="border-toppadding: 0; padding-top: 0!important; margin-top: 0!important">
                                <div class="row candidateBox career-list">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="candidateBox-row row ml-14">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="">STT</th>
                                                    <th>Tên kỹ năng</th>
                                                    <th>Số lượng ứng viên</th>
                                                    <th>Tùy chọn</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($skills as $index => $skill)
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td><a href="#">{{$skill->sk_name}}</a></td>
                                                    <td>124</td>
                                                    <td><a href="skill/edit/{{$skill->id}}" class="btn btn-default btn" style=""><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="skill/delete/{{$skill->id}}" class="btn btn-default btn" style=""><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- /. candidateBox row -->

                                    </div>

                                </div> <!-- /. candidateBox -->
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
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
