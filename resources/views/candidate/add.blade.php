@extends('layout.master')

@section('title')
    @if(isset($candidate)) Sửa ứng viên @else Thêm ứng viên @endif
@endsection

@section('content')
    <div class="content-wrapper candidate">
        <!-- Content Header (Page header) -->
        <div class="content-header candidate-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@if(isset($candidate)) Sửa ứng viên @else Thêm ứng viên @endif</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <form action="candidate/import" class="excelForm" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" class="excelForm-file" style="display: none;" name="file" accept=".xls,.xlsx">
                                    <button type="button" class="btn btn-default excelForm-btn btn-common"><i class="nav-icon fa fa-file-excel-o" aria-hidden="true"></i> Import Excel</button>
                                    <a href="{{route('candidate.list')}}" class="btn btn-default btn-common"><i class="nav-icon fa fa-list-ul" aria-hidden="true"></i> Danh sách</a>
                                </form>


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
                <form action="{{isset($candidate)?route('candidate.postEdit'):route('candidate.postNew')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" name="candidate_id" value="{{isset($candidate)?$candidate->id:''}}">
                    <input type="hidden" name="candidateInfo_id" value="{{isset($candidate->candidateInfo->id)?$candidate->candidateInfo->id:''}}">
                    {{--<input type="hidden" name="id" value="{{isset($candidate)?$candidate->id:''}}">--}}
                    {{--<input type="hidden" name="id" value="{{isset($candidate)?$candidate->id:''}}">--}}
                <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->

                        <section class="col-lg-9 candidate-sideright">
                            <!-- box thông tin cơ bảRn -->
                            @include('candidate.include.in_basic')
                            <!-- /.card -->

                            {{--include in info--}}
                            @include('candidate.include.in_info')
                            {{--end include--}}

                            <button type="submit" id="them" class="btn btn-submit centecr btn-common">@if(isset($candidate)) <i class="fa fa-wrench" aria-hidden="true"></i> Sửa @else
                                    <i class="fa fa-plus" aria-hidden="true"></i> Thêm @endif</button>
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
                                <li class="navprofile-item"><a href="#them">{{isset($candidate)?'Sửa':'Thêm'}}</a></li>
                            </ul>
                            <!-- /.card -->
                        </section>
                        <!-- /.Left col -->
                    </div>
                </form>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <div id="candidate-popup" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm nguồn</h5>
                </div>
                <div class="modal-body row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <div class="d-flex">
                            <div class="modal-body-name">Tên nguồn</div>
                            <span class="important">*</span>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="hidden" name="id" value="">
                        <input type="text" name="candidate_new" class="form-group full-width">
                        <span class="candidate-text-error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal"> Đóng</button>
                    <button type="button" class="btn btn-common btn-default candidate-popup-button-add">
                        <i class="fa fa-plus" aria-hidden="true"></i> Thêm
                    </button>
                    <button type="button" class="btn btn-common btn-default candidate-popup-button-edit hide">
                        <i class="fa fa-wrench" aria-hidden="true"></i> Sửa
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade candidate-popup candidate-confirm" id="candidate-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="newcareer">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm danh sách ứng viên từ Excel vào hệ thống</h5>
                    </div>
                    <div class="modal-body row">
                        Bạn có muốn thêm danh sách này vào hệ thống không?
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal"> Không</button>
                        <button type="button" class="btn btn-common btn-default candidate-popup-button-yes">
                             Có
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay">
        <ul class="spinner">
            <li><i class="fa fa-spinner" aria-hidden="true"></i></li>
            <li><span>Đang tải dữ liệu, vui lòng đợi trong giây lát ...</span></li>
        </ul>
    </div>

@endsection

@section('script')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    {{--<script>--}}

        {{--var placeSearch, autocomplete;--}}
        {{--var componentForm = {--}}
            {{--street_number: 'long_name',--}}
            {{--route: 'long_name',--}}
            {{--administrative_area_level_1: 'long_name',--}}
            {{--country: 'long_name',--}}
            {{--sublocality_level_1: 'long_name',--}}
            {{--administrative_area_level_2: 'long_name'--}}
        {{--};--}}

        {{--function initAutocomplete() {--}}
            {{--autocomplete = new google.maps.places.Autocomplete(--}}
                {{--/** @type {!HTMLInputElement} */(document.getElementById('hometown')),--}}
                {{--{types: ['geocode']});--}}
            {{--autocomplete.setComponentRestrictions({'country': ['vn']});--}}
            {{--autocomplete.addListener('place_changed', fillInAddress);--}}

            {{--autocomplete2 = new google.maps.places.Autocomplete(--}}
                {{--/** @type {!HTMLInputElement} */(document.getElementById('can_address')),--}}
                {{--{types: ['geocode']});--}}
            {{--autocomplete2.setComponentRestrictions({'country': ['vn']});--}}
            {{--autocomplete2.addListener('place_changed', fillInAddress2);--}}
        {{--}--}}

        {{--function fillInAddress() {--}}
            {{--var dataResult = {};--}}
            {{--var place = autocomplete.getPlace();--}}
            {{--var address_detail = "";--}}
            {{--for (var i = 0; i < place.address_components.length; i++) {--}}
                {{--var addressType = place.address_components[i].types[0];--}}
                {{--if (componentForm[addressType]) {--}}
                    {{--var val = place.address_components[i][componentForm[addressType]] || '';--}}
                    {{--if (addressType == 'street_number') address_detail += val;--}}
                    {{--if (addressType == 'route') address_detail += ' ' + val;--}}
                    {{--if (addressType == 'administrative_area_level_1') dataResult.city = val;--}}
                    {{--if (addressType == 'administrative_area_level_2') dataResult.district = val;--}}
                    {{--if (addressType == 'sublocality_level_1') dataResult.ward = val;--}}
                {{--}--}}
            {{--}--}}
            {{--dataResult.street = address_detail.trim();--}}
            {{--dataResult.title = $("#cla_name").val();--}}
            {{--// dataResult.title = document.getElementById('cla_name').value;--}}
            {{--dataResult.secret = 'e8970721455a090be8429338c564efa5';--}}
            {{--address = address_detail.trim();--}}
            {{--if (typeof(dataResult.ward) != "undefined") address += ((address != '') ? ", " : '') + dataResult.ward;--}}
            {{--if (typeof(dataResult.district) != "undefined") address += ((address != '') ? ", " : '') + dataResult.district;--}}
            {{--if (typeof(dataResult.city) != "undefined") address += ((address != '') ? ", " : '') + dataResult.city;--}}

            {{--document.getElementById('hometown').value=address;--}}
            {{--dataResult.address = address;--}}
            {{--document.getElementById('cla_lat').value= place.geometry.location.lat();--}}
            {{--document.getElementById('cla_lng').value= place.geometry.location.lng();--}}

            {{--// $("#hometown").val(address);--}}

            {{--// $("#cla_lat").val(place.geometry.location.lat());--}}
            {{--// $("#cla_lng").val(place.geometry.location.lng());--}}
        {{--}--}}

        {{--function fillInAddress2() {--}}
            {{--var dataResult = {};--}}
            {{--var place = autocomplete2.getPlace();--}}
            {{--var address_detail = "";--}}
            {{--for (var i = 0; i < place.address_components.length; i++) {--}}
                {{--var addressType = place.address_components[i].types[0];--}}
                {{--if (componentForm[addressType]) {--}}
                    {{--var val = place.address_components[i][componentForm[addressType]] || '';--}}
                    {{--if (addressType == 'street_number') address_detail += val;--}}
                    {{--if (addressType == 'route') address_detail += ' ' + val;--}}
                    {{--if (addressType == 'administrative_area_level_1') dataResult.city = val;--}}
                    {{--if (addressType == 'administrative_area_level_2') dataResult.district = val;--}}
                    {{--if (addressType == 'sublocality_level_1') dataResult.ward = val;--}}
                {{--}--}}
            {{--}--}}
            {{--dataResult.street = address_detail.trim();--}}
            {{--dataResult.title = $("#cla_name").val();--}}
            {{--dataResult.secret = 'e8970721455a090be8429338c564efa5';--}}
            {{--address = address_detail.trim();--}}
            {{--if (typeof(dataResult.ward) != "undefined") address += ((address != '') ? ", " : '') + dataResult.ward;--}}
            {{--if (typeof(dataResult.district) != "undefined") address += ((address != '') ? ", " : '') + dataResult.district;--}}
            {{--if (typeof(dataResult.city) != "undefined") address += ((address != '') ? ", " : '') + dataResult.city;--}}
            {{--$("#can_address").val(address);--}}
            {{--dataResult.address = address;--}}
            {{--$("#cla_lat").val(place.geometry.location.lat());--}}
            {{--$("#cla_lng").val(place.geometry.location.lng());--}}
        {{--}--}}

        {{--function geolocate() {--}}
            {{--if (navigator.geolocation) {--}}
                {{--navigator.geolocation.getCurrentPosition(function (position) {--}}
                    {{--var geolocation = {--}}
                        {{--lat: position.coords.latitude,--}}
                        {{--lng: position.coords.longitude--}}
                    {{--};--}}
                    {{--var circle = new google.maps.Circle({--}}
                        {{--center: geolocation,--}}
                        {{--radius: position.coords.accuracy--}}
                    {{--});--}}
                    {{--autocomplete.setBounds(circle.getBounds());--}}
                {{--});--}}
            {{--}--}}
        {{--}--}}

    {{--</script>--}}

    <script>
        var autocomplete1,autocomplete2;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            // country: 'long_name',
            postal_code: 'short_name'
        };

        function autoCompleteMaps() {
            var hometown = document.getElementById('hometown');
            var can_address = document.getElementById('can_address');
            var options = {
                types: ['geocode'],
                componentRestrictions: {country: 'vn'}
            };

            autocomplete1 = new google.maps.places.Autocomplete(hometown,options);
            autocomplete2 = new google.maps.places.Autocomplete(can_address,options);

            // autocomplete1.addListener('place_changed',fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete1.getPlace();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiaFoZ_KqyuAk1c8woLdAgYOThsNY-EDU&libraries=places&callback=autoCompleteMaps" async defer></script>

    @if(!isset($candidate))

    @endif

@endsection
