@extends('layout.master')

@section('title')
    Danh sách nguồn
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper candidate">
        <!-- Content Header (Page header) -->
        <div class="content-header candidate-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Danh sách nguồn</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <button type="button" data-toggle="modal" data-backdrop="static" data-target="#candidate-popup"
                                        class="btn btn-default btn-blue"><i class="nav-icon fa fa-plus" aria-hidden="true"></i> Thêm nguồn</button>
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
                            <form method="get">
                            <div class=" p-0 row">
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <input type="text" name="name" value="{{Request::get('name')}}" class="form-group" placeholder="Gõ tên nguồn">
                                </div>
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <select class="form-group" id="career-search-option" name="option">
                                        <option value="">-- Tìm kiếm tùy chọn --</option>
                                        <option value="new" {{Request::get('option')=='new'?'selected':''}}>Nguồn mới</option>
                                        <option value="top" {{Request::get('option')=='top'?'selected':''}}>Nguồn nhiều ứng viên nhất</option>
                                        <option value="">Nguồn ít ứng viên nhất</option>
                                    </select>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <button type="submit" class="btn btn-default full-width btn-blue"><i class="nav-icon fa fa-search" aria-hidden="true"></i> Tìm kiếm</button>
                                </div>
                            </div><!-- /.card-header -->
                            </form>
                            <div class="card-searchinfo">
                                <b>{{$sources->firstItem()}} - {{$sources->lastItem()}} </b> trong <b> {{$sources->total()}} </b> nguồn <span></span>
                            </div>
                            <div class="card-body" style="border-top: none; padding: 0; padding-top: 0!important; margin-top: 0!important">
                                <div class="row candidateBox career-list">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="candidateBox-row row ml-14">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="">STT</th>
                                                    <th>Tên nguồn</th>
                                                    <th>Số lượng ứng viên</th>
                                                    <th>Tùy chọn</th>
                                                </tr>
                                                </thead>
                                                <tbody class="result">
                                                @php $n=$sources->firstItem() @endphp
                                                @foreach($sources as $index => $item)
                                                <tr class="result-item">
                                                    <td class="result-index">{{$n++}}</td>
                                                    <td class="result-name">{{$item->so_name}}</td>
                                                    <td>12312</td>
                                                    <td><button type="button" data-id="{{$item->id}}" class="btn btn-default
                                                    source-list-edit" style=""><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                        <button type="button" data-id="{{$item->id}}"
                                                                data-toggle="modal" data-backdrop="static" data-target="#candidate-confirm"
                                                                class="btn btn-default source-list-delete" style=""><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- /. candidateBox row -->

                                    </div>

                                </div> <!-- /. candidateBox -->
                            </div><!-- /.card-body -->
                            <div class="card-footer">
                                {{$sources->appends(['name'=>Request::get('name'),'option'=>Request::get('option')])->render()}}
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
    <!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade candidate-popup source-popup" id="candidate-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="newcareer">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm nguồn</h5>
                    </div>
                    <div class="modal-body row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            Tên nguồn <span class="important">*</span>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <input type="hidden" name="id" value="">
                            <input type="text" name="so_name" class="source form-group full-width">
                            <span class="candidate-text-error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal"> Đóng</button><button type="button" class="btn btn-blue btn-default candidate-popup-button-add"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</button>
                        <button type="button" class="btn btn-blue btn-default candidate-popup-button-edit hide"><i class="fa fa-wrench" aria-hidden="true"></i> Sửa</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade candidate-popup source-confirm" id="candidate-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="newcareer">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa nguồn</h5>
                    </div>
                    <div class="modal-body row">
                        Bạn có muốn xóa nguồn này không?
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
                        <button type="button" class="btn btn-blue btn-default candidate-popup-button-trash"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection