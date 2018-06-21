@extends('layout.master')

@section('title')
    Sửa ngành nghề
    @endsection

@section('content')
    <div class="content-wrapper candidate">
        <!-- Content Header (Page header) -->
        <div class="content-header candidate-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sửa ngành nghề</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="career/list" class="btn btn-default btn-blue"><i class="nav-icon fa fa-list-ul" aria-hidden="true"></i> Danh sách ngành nghề</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <span class="line"></span>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <form action="career/edit/{{$career->id}}" method="post">
        @csrf
        <!-- Main content -->
            <section class="content candidate-add">
                <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-8 candidate-sideright">
                            <!-- box thông tin cơ bản -->
                            <div class="card" id="thongtincoban">
                                <div class="card-header  p-0">
                                    <h3 class="card-title ">
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row candidateBox">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="candidateBox-row row ml-14">
                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                    Tên ngành nghề <span class="important">*</span>
                                                </div>
                                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                    <input  type="text" name="ca_name" placeholder="IT phần mềm" value="{{old('ca_name')?old('ca_name'):$career->ca_name}}" class="form-group candidate-input">
                                                    @if($errors->has('ca_name'))
                                                        <span style="color: red;">{{$errors->first('ca_name')}}</span>
                                                    @endif
                                                </div>
                                            </div> <!-- /. candidateBox row -->

                                        </div>

                                    </div> <!-- /. candidateBox -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <button type="submit" name="submit" class="btn btn-default btn-submit btn-blue"><i class="nav-icon fa fa-wrench" aria-hidden="true"></i> Sửa</button>
                        </section>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </form>

    </div>
@endsection