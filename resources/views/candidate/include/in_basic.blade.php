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
                        <input type="text" name="can_name" value="{{old('can_name',isset($candidate->can_name)?$candidate->can_name:'')}}" placeholder="Nguyễn Văn A" class="form-group candidate-input datepicker">

                        @if($errors->has('can_name'))
                            <span style="color: red;">{{$errors->first('can_name')}}</span>
                        @endif
                    </div>
                </div> <!-- /. candidateBox row -->
                <div class="candidateBox-row row ml-14">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        Ngày sinh/Năm sinh <span class="important">*</span>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <input type="text" name="can_birthday" data-provide="datepicker" placeholder="10/10/2000" value="{{old('can_birthday',isset($candidate->can_birthday)?date("d-m-Y", strtotime($candidate->can_birthday)):'')}}" class="datepicker form-group candidate-input">
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <input type="text" name="can_year" placeholder="Năm sinh" value="{{old('can_year',isset($candidate->can_year)?$candidate->can_year:'')}}" class=" form-group candidate-input">
                    </div>
                </div>
                <div class="candidateBox-row row ml-14">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        Giới tính <span class="important">*</span>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <label style="margin-right: 50px;">
                            <span><input type="radio" name="can_gender"  {{old('can_gender',isset($candidate->can_gender))==1?'checked':''}}
                                value="1" class="form candidate-input-group"></span> Nam
                        </label>
                        <label>
                            <input type="radio" name="can_gender" {{old('can_gender',isset($candidate->can_gender))==0?'checked':''}}
                            value="0" class="form candidate-input-group">
                            <span>Nữ</span>
                        </label>
                        @if($errors->has('can_gender'))
                            <span style="color: red;">{{$errors->first('can_gender')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <input type="file" name="avatar" id="file" accept="image/*" >
                <a class="candidate-upimage" style="{{!empty($candidate->can_avatar)?'display: none':''}}"><span>Click để thêm ảnh đại điện</span></a>
                <a class="avatar candidate-upimage" style="{{!empty($candidate->can_avatar)?'':'display: none'}}">
                    <input type="hidden" name="old_avatar" value="{{!empty($candidate->can_avatar)?$candidate->can_avatar:''}}">
                    <img id="after_image" src="{{!empty($candidate->can_avatar)?$candidate->can_avatar:''}}"></img>
                    <div class="avatar-text">Đổi ảnh đại diện</div>
                </a>
                <!-- <button type="button" class="btn btn-default">Đổi ảnh</button> -->
            </div>
        </div> <!-- /. candidateBox -->
        <div class="row candidateBox">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="row candidateBox-row">
                    Điện thoại
                    <input type="text" name="can_phone" placeholder="0969516425" value="{{old('can_phone',isset($candidate->can_phone)?$candidate->can_phone:'')}}" class="form-group">
                    @if($errors->has('can_phone'))
                        <span style="color: red;">{{$errors->first('can_phone')}}</span>
                    @endif
                </div>
                <div class="row candidateBox-row">
                    Email
                    <input type="text" name="can_email" placeholder="devcongvan@gmail.com" value="{{old('can_email',isset($candidate->can_email)?$candidate->can_email:'')}}" class="form-group">
                    @if($errors->has('can_email'))
                        <span style="color: red;">{{$errors->first('can_email')}}</span>
                    @endif
                    @if($error=session('email_phone_error'))
                        <span style="color: red;">{{$error}}</span>
                        @endif
                </div>
                <div class="row candidateBox-row">
                    Quê quán
                    <div style="margin-bottom: 5px; display: block; width: 100%; height: 0px;"></div>
                    <input type="text" value="{{old('hometown',isset($candidate->hometown)?$candidate->hometown:'')}}" id="hometown" placeholder="Nhập quê quán của ứng viên"
                           name="hometown" class="form-group find_addrss">
                    {{--<select class="location" name="can_location_id">--}}
                    {{--</select>--}}
                    @if($errors->has('hometown'))
                        <span style="color: red;">{{$errors->first('hometown')}}</span>
                    @endif
                </div>
                <div class="row candidateBox-row">
                    Nơi ở hiện tại
                    <input type="text" name="can_address" value="{{old('can_address',isset($candidate->can_address)?$candidate->can_address:'')}}" id="can_address" placeholder="Lê Thanh Nghị, Hai Bà Trưng, Hà Nội" class="form-group full-address">
                    @if($errors->has('can_address'))
                        <span style="color: red;">{{$errors->first('can_address')}}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="row candidateBox-row">
                    Skype
                    <input type="text" placeholder="https://www.facebook.com" value="{{old('can_skype',isset($candidate->can_skype)?$candidate->can_skype:'')}}" name="can_skype" class="form-group">
                    @if($errors->has('can_skype'))
                        <span style="color: red;">{{$errors->first('can_skype')}}</span>
                    @endif
                </div>
                <div class="row candidateBox-row">
                    Facebook
                    <input type="text" placeholder="https://www.facebook.com/" value="{{old('can_facebook',isset($candidate->can_facebook)?$candidate->can_facebook:'')}}" name="can_facebook" class="form-group">
                    @if($errors->has('can_facebook'))
                        <span style="color: red;">{{$errors->first('can_facebook')}}</span>
                    @endif
                </div>
                <div class="row candidateBox-row">
                    LinkedIn
                    <input type="text" placeholder="https://www.facebook.com/" value="{{old('can_linkedin',isset($candidate->can_linkedin)?$candidate->can_linkedin:'')}}" name="can_linkedin" class="form-group">
                    @if($errors->has('can_linkedin'))
                        <span style="color: red;">{{$errors->first('can_linkedin')}}</span>
                    @endif
                </div>
                <div class="row candidateBox-row">
                    Github
                    <input type="text" placeholder="https://www.facebook.com/" name="can_github" value="{{old('can_github',isset($candidate->can_github)?$candidate->can_github:'')}}" class="form-group">
                    @if($errors->has('can_github'))
                        <span style="color: red;">{{$errors->first('can_github')}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- /.card-body -->
</div>