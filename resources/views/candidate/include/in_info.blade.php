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
                        <input type="text" name="can_title" id="chucdanh" value="{{old('can_title',isset($candidate->can_title)?$candidate->can_title:'')}}" placeholder="Nhập tên chức danh" class="form-group">
                    </div>
                </div>
                <div class="row candidateBox-row">
                    Ngành nghề

                    <select class=" career" name="career[]" data-placeholder="Chọn một ngành nghề" data-url="{{route('ajax.career.search')}}" multiple="multiple" placeholder="Chọn ngành nghề">
                        <option value="">-- Chọn một ngành nghề --</option>
                        @if(!empty($careers))
                            @foreach($careers as $index => $item)
                                @php $selected='' @endphp
                                @if(in_array($item->id,old('career',isset($candidate->career)?$candidate->career->pluck('cc_careers_id')->toArray():[])))
                                    @php $selected='selected="selected"' @endphp
                                @endif
                                <option value="{{$item->id}}" {{$selected}}>{{$item->ca_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="row candidateBox-row">
                    <div>Kỹ năng</div>

                    <div class="d-flex" style="width: 100%;">
                        <select class="skill" name="skill[]" data-url="{{route('ajax.skill.search')}}" multiple="multiple">
                            @foreach (old('skill',isset($candidate->skill)?$candidate->skill:[]) as $item)
                                @if(!empty(old('skill')))
                                    <option value="{{$item}}" selected="selected">{{preg_replace('/(\d+\|)/','', $item)}}</option>
                                @elseif(!empty($candidate->skill->toArray()))
                                    <option value="{{$item->cs_skills_id}}|{{ $item->sk_name}}" selected="selected">{{ $item->sk_name }}</option>
                                @endif
                            @endforeach
                        </select>

                        <button style="height: 30px!important;" data-toggle="modal" data-backdrop="static" data-url="{{route('ajax.skill.create')}}" data-btn="skill" data-target="#candidate-popup" type="button" class="btn btn-default btn-blue">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div class="row candidateBox-row">
                    Chọn thành phố/tỉnh thành mong muốn làm việc

                    <select class="select3" id="city_want_to_work" data-url="{{route('ajax.location.search')}}" name="city">
                        <option value="">Chọn thành phố nơi bạn muốn làm việc</option>

                        @if(isset($city))
                            @foreach($city as $item)
                                <option value="{{ $item->id }}" {{old('city',isset($candidate)?(!empty($candidate->location->first()->wp_locations_id)?$candidate->location->first()->wp_locations_id:''):'')==$item->id?'selected':''}}
                                >{{ $item->loc_name  }}</option>

                                @if(isset($candidate->location)&&!empty($candidate->location))  unset($candidate->location[0]) @endif
                                {{--<option value="{{ $item->id }}" >{{ $item->loc_name  }}</option>--}}
                            @endforeach
                        @endif

                    </select>
                </div>

                <div class="row candidateBox-row {{!empty($candidate)||!empty(old('district'))?'':'hide'}} ">
                    Chọn quận/huyện mong muốn làm việc

                    <select class="select3" id="district_want_to_work" data-url="{{route('ajax.location.search')}}" data-parent-id=""
                            name="district[]" multiple="multiple">
                        @foreach (old('district',isset($candidate->location)?$candidate->location->toArray():[]) as $item)
                            @if(!empty(old('district')))
                                <option value="{{$item}}" selected="selected">{{preg_replace('/(\d+\|)/','', $item)}}</option>
                            @elseif(!empty($candidate->location->toArray()))
                                <option value="{{ $item['wp_locations_id'] }}|{{ $item['loc_name']}}" selected="selected">{{ $item['loc_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <div class="row candidateBox-row want-to-abroad">
                    <p>Mong muốn làm việc tại nước ngoài</p>
                    <div class="clearfix"></div>
                    <label style="margin-right: 50px;">
                        <span><input type="radio" name="ci_work_abroad" {{old('ci_work_abroad',isset($candidate->candidateInfo->ci_work_abroad)?$candidate->candidateInfo->ci_work_abroad:'')==1?'checked':''}}
                            value="1" class="form candidate-input-group"></span> Có
                    </label>
                    <label>
                        <input type="radio" name="ci_work_abroad" {{old('ci_work_abroad',isset($candidate->candidateInfo->ci_work_abroad)?$candidate->candidateInfo->ci_work_abroad:'')==0?'checked':''}}
                        value="0" class="form candidate-input-group">
                        <span>Không</span>
                    </label>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="row candidateBox-row">
                    Kinh nghiệm
                    <select class=" select3" name="ci_time_experience" id="ci_time_experience">
                        <option value="-1">-- Chọn thời gian kinh nghiệm --</option>
                        @foreach($time_experience as $item)
                            <option {{old('ci_time_experience',isset($candidate->candidateInfo->ci_time_experience)?$candidate->candidateInfo->ci_time_experience:'')==$item['id']?'selected':''}}
                                    value="{{$item['id']}}"> {{$item['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row candidateBox-row">
                    Trình độ chuyên môn
                    <select class=" select3" name="ci_qualification">
                        <option value="-1">-- Chọn trình độ chuyên môn --</option>
                        @foreach($qualification as $item)
                            <option {{old('ci_qualification',isset($candidate->candidateInfo->ci_qualification)?$candidate->candidateInfo->ci_qualification:'')==$item['id']?'selected':''}}
                                    value="{{$item['id']}}">{{$item['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row candidateBox-row">
                    Trình độ tiếng anh
                    <select class=" select3" name="ci_english_level">
                        <option value="-1">-- Chọn trình độ tiếng anh --</option>
                        @foreach($english_level as $item)
                            <option {{old('ci_english_level',isset($candidate->candidateInfo->ci_english_level)?$candidate->candidateInfo->ci_english_level:'')==$item['id']?'selected':''}}
                                    value="{{$item['id']}}">{{$item['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row candidateBox-row">
                    Loại hình công việc
                    <select class=" select3" name="ci_type_of_work">
                        <option value="-1">-- Chọn loại hình công việc --</option>
                        @foreach($type_of_work as $item)
                            <option {{old('ci_type_of_work',isset($candidate->candidateInfo->ci_type_of_work)?$candidate->candidateInfo->ci_type_of_work:'')==$item['id']?'selected':''}}
                                    value="{{$item['id']}}">{{$item['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row candidateBox-row">
                    Mức lương
                    <select class=" select3" name="ci_salary">
                        <option value="-1">-- Chọn mức lương mong muốn --</option>
                        @foreach($salary as $item)
                            <option {{old('ci_salary',isset($candidate->candidateInfo->ci_salary)?$candidate->candidateInfo->ci_salary:'')==$item['id']?'selected':''}}
                                    value="{{$item['id']}}">{{$item['name']}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row candidateBox-row">
                    <div>Nguồn</div>
                    <div class="d-flex" style="width: 100%;">
                        <select class="select3" name="can_source_id">
                            @foreach($sources as $item)
                                <option value="{{$item->id}}" {{old('can_source_id',isset($candidate->can_source_id)?$candidate->can_source_id:'')==$item->id?'selected':''}}
                                >{{$item->so_name}}</option>
                            @endforeach
                        </select>
                        <button style="height: 30px;" data-toggle="modal" data-backdrop="static" data-url="{{route('ajax.source.create')}}" data-btn="source" data-target="#candidate-popup" type="button" class="btn btn-default btn-blue">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>


                    @if($errors->has('can_source_id'))
                        <span style="color: red;">{{$errors->first('can_source_id')}}</span>
                    @endif
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
                    <textarea class="form-group" name="ci_target">{{old('ci_target',isset($candidate->candidateInfo->ci_target)?$candidate->candidateInfo->ci_target:'')}}</textarea>
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
                    <textarea class="form-group" name="ci_about">{{old('ci_about',isset($candidate->candidateInfo->ci_about)?$candidate->candidateInfo->ci_about:'')}}</textarea>
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
        <button type="button" class="btn btn-clone btn-default ">
            <i class="fa fa-plus"></i> Thêm kinh nghiệm
        </button>
    </div><!-- /.card-header -->
    <div class="card-body">
        @forelse(old('ci_work_experience_company',!empty($candidate->candidateInfo->ci_work_experience)?(is_array($candidate->candidateInfo->ci_work_experience)?$candidate->candidateInfo->ci_work_experience:[]):[]) as $index => $item)
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên công ty
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_company[]" value="{{!empty(old('ci_work_experience_company'))?$item:(!empty($candidate->candidateInfo->ci_work_experience)?$item->company:'')}}" placeholder="Nhập tên công ty" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_start[]" value="{{!empty(old('ci_work_experience_start'))?old('ci_work_experience_start')[$index]:(!empty($candidate->candidateInfo->ci_work_experience)?$item->start:'')}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="row candidateBox-row center-block">
                        <p style="margin: auto;">đến</p>
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_finish[]" value="{{!empty(old('ci_work_experience_finish'))?old('ci_work_experience_finish')[$index]:(!empty($candidate->candidateInfo->ci_work_experience)?$item->finish:'')}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="row candidateBox-row center-block">
                        <p style="margin: auto;">hoặc</p>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_time[]" value="{{!empty($candidate->candidateInfo->ci_work_experience->time)?$candidate->candidateInfo->ci_work_experience->time:''}}" placeholder="10/10/2000" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Chức vụ
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_position[]" value="{{!empty(old('ci_work_experience_position'))?old('ci_work_experience_position')[$index]:(!empty($candidate->candidateInfo->ci_work_experience)?$item->position:'')}}" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Quá trình làm việc
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <textarea class="form-group" name="ci_work_experience_process[]">{{!empty(old('ci_work_experience_process'))?old('ci_work_experience_process')[$index]:(!empty($candidate->candidateInfo->ci_work_experience)?$item->process:'')}}</textarea>
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @empty
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên công ty
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_company[]" value="{{!empty($candidate->candidateInfo->ci_work_experience)?$candidate->candidateInfo->ci_work_experience->company:''}}" placeholder="Nhập tên công ty" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_start[]" value="{{!empty($candidate->candidateInfo->ci_work_experience)?$candidate->candidateInfo->ci_work_experience->start:''}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="row candidateBox-row center-block">
                        <p style="margin: auto;">đến</p>
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_finish[]" value="{{!empty($candidate->candidateInfo->ci_work_experience)?$candidate->candidateInfo->ci_work_experience->finish:''}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="row candidateBox-row center-block">
                        <p style="margin: auto;">hoặc</p>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_time[]" value="{{!empty($candidate->candidateInfo->ci_work_experience->time)?$candidate->candidateInfo->ci_work_experience->time:''}}" placeholder="10/10/2000" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Chức vụ
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_work_experience_position[]" value="{{!empty($candidate->candidateInfo->ci_work_experience)?$candidate->candidateInfo->ci_work_experience->position:''}}" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Quá trình làm việc
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <textarea class="form-group" name="ci_work_experience_process[]">{{!empty($candidate->candidateInfo->ci_work_experience)?$candidate->candidateInfo->ci_work_experience->process:''}}</textarea>
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @endforelse

    </div><!-- /.card-body -->
</div>
<!-- /.card -->

<!-- box hoạt động -->
<div class="card" id="hocvan">
    <div class="card-header  p-0">
        <h3 class="card-title ">
            Học vấn
        </h3>
        <button type="button" class="btn btn-clone btn-default ">
            <i class="fa fa-plus"></i> Thêm học vấn
        </button>
    </div><!-- /.card-header -->
    <div class="card-body">
        @forelse(old('ci_education_name',!empty($candidate->candidateInfo->ci_education)?(is_array($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education:[]):[]) as $index => $item)
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên trường/ trung tâm
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_education_name[]" value="{{!empty(old('ci_education_name'))?$item:(!empty($candidate->candidateInfo->ci_education)?(!is_array($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->schoolname:$item->schoolname):'')}}" placeholder="Nhập tên trường/trung tâm" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_education_start[]" value="{{!empty(old('ci_education_start'))?old('ci_education_start')[$index]:(!empty($candidate->candidateInfo->ci_education)?(!is_array($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->start:$item->start):'')}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="row candidateBox-row center-block">
                        <p style="margin: auto;">đến</p>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_education_finish[]" value="{{!empty(old('ci_education_finish'))?old('ci_education_finish')[$index]:(!empty($candidate->candidateInfo->ci_education)?(!is_array($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->finish:$item->finish):'')}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Khoa, ngành
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_education_faculty[]" value="{{!empty(old('ci_education_faculty'))?old('ci_education_faculty')[$index]:(!empty($candidate->candidateInfo->ci_education)?(!is_array($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->faculty:$item->faculty):'')}}" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Quá trình học tập
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <textarea class="form-group" name="ci_education_process[]">{{!empty(old('ci_education_process'))?old('ci_education_process')[$index]:(!empty($candidate->candidateInfo->ci_education)?(!is_array($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->process:$item->process):'')}}</textarea>
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @empty
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên trường/ trung tâm
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_education_name[]" value="{{!empty($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->schoolname:''}}" placeholder="Nhập tên trường/trung tâm" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_education_start[]" value="{{!empty($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->start:''}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="row candidateBox-row center-block">
                        <p style="margin: auto;">đến</p>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_education_finish[]" value="{{!empty($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->finish:''}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Khoa, ngành
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_education_faculty[]" value="{{!empty($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->faculty:''}}" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Quá trình học tập
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <textarea class="form-group" name="ci_education_process[]">{{!empty($candidate->candidateInfo->ci_education)?$candidate->candidateInfo->ci_education->process:''}}</textarea>
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @endforelse

    </div><!-- /.card-body -->
</div>
<!-- /.card -->

<!-- box chứng chỉ -->
<div class="card" id="hoatdong">
    <div class="card-header  p-0">
        <h3 class="card-title ">
            Hoạt động
        </h3>
        <button type="button" class="btn btn-clone btn-default ">
            <i class="fa fa-plus"></i> Thêm hoạt động
        </button>
    </div><!-- /.card-header -->
    <div class="card-body">
        @forelse(old('ci_activity_name',!empty($candidate->candidateInfo->ci_activity)?(is_array($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity:[]):[]) as $index => $item)
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên hoạt động
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_activity_name[]" value="{{!empty(old('ci_activity_name'))?$item:(!empty($candidate->candidateInfo->ci_activity)?(!is_array($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->name:$item->name):'')}}" placeholder="Nhập tên công ty" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_activity_start[]" value="{{!empty(old('ci_activity_start'))?old('ci_activity_start')[$index]:(!empty($candidate->candidateInfo->ci_activity)?(!is_array($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->start:$item->start):'')}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="row candidateBox-row center-block">
                        <p style="margin: auto;">đến</p>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_activity_finish[]" value="{{!empty(old('ci_activity_finish'))?old('ci_activity_finish')[$index]:(!empty($candidate->candidateInfo->ci_activity)?(!is_array($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->finish:$item->finish):'')}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Vị trí đảm nhận
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_activity_position[]" value="{{!empty(old('ci_activity_position'))?old('ci_activity_position')[$index]:(!empty($candidate->candidateInfo->ci_activity)?(!is_array($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->position:$item->position):'')}}" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Quá trình hoạt động
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <textarea class="form-group" name="ci_activity_process[]">{{!empty(old('ci_activity_process'))?old('ci_activity_process')[$index]:(!empty($candidate->candidateInfo->ci_activity)?(!is_array($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->process:$item->process):'')}}</textarea>
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @empty
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên hoạt động
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_activity_name[]" value="{{!empty($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->name:''}}" placeholder="Nhập tên công ty" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_activity_start[]" value="{{!empty($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->start:''}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="row candidateBox-row center-block">
                        <p style="margin: auto;">đến</p>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_activity_finish[]" value="{{!empty($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->finish:''}}" placeholder="10/10/2000" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Vị trí đảm nhận
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_activity_position[]" value="{{!empty($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->position:''}}" placeholder="Chức vụ bạn đã đảm nhận" class="form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Quá trình hoạt động
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <textarea class="form-group" name="ci_activity_process[]">{{!empty($candidate->candidateInfo->ci_activity)?$candidate->candidateInfo->ci_activity->process:''}}</textarea>
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @endforelse

    </div><!-- /.card-body -->
</div>
<!-- /.card -->

<!-- box giải thưởng -->
<div class="card" id="chungchi">
    <div class="card-header  p-0">
        <h3 class="card-title ">
            Chứng chỉ
        </h3>
        <button type="button" class="btn btn-clone btn-default ">
            <i class="fa fa-plus"></i> Thêm chứng chỉ
        </button>
    </div><!-- /.card-header -->
    <div class="card-body">
        @forelse(old('ci_certificate_time',!empty($candidate->candidateInfo->ci_certificate)?(is_array($candidate->candidateInfo->ci_certificate)?$candidate->candidateInfo->ci_certificate:[]):[]) as $index => $item)
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian cấp
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_certificate_time[]" value="{{!empty(old('ci_certificate_time'))?old('ci_certificate_time')[$index]:(!empty($candidate->candidateInfo->ci_certificate)?(!is_array($candidate->candidateInfo->ci_certificate)?$candidate->candidateInfo->ci_certificate->time:$item->time):'')}}" placeholder="Nhập thời gian cấp" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên chứng chỉ
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_certificate_name[]" value="{{!empty(old('ci_certificate_name'))?old('ci_certificate_name')[$index]:(!empty($candidate->candidateInfo->ci_certificate)?(!is_array($candidate->candidateInfo->ci_certificate)?$candidate->candidateInfo->ci_certificate->name:$item->name):'')}}" placeholder="Nhập tên công ty" class="form-group">
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @empty
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian cấp
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_certificate_time[]" value="{{!empty($candidate->candidateInfo->ci_certificate)?$candidate->candidateInfo->ci_certificate->time:''}}" placeholder="Nhập thời gian cấp" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên chứng chỉ
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_certificate_name[]" value="{{!empty($candidate->candidateInfo->ci_certificate)?$candidate->candidateInfo->ci_certificate->name:''}}" placeholder="Nhập tên công ty" class="form-group">
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @endforelse

    </div><!-- /.card-body -->
</div>
<!-- /.card -->

<!-- box kỹ năng -->
<div class="card" id="giaithuong">
    <div class="card-header  p-0">
        <h3 class="card-title ">
            Giải thưởng
        </h3>
        <button type="button" class="btn btn-clone btn-default ">
            <i class="fa fa-plus"></i> Thêm giải thưởng
        </button>
    </div><!-- /.card-header -->
    <div class="card-body">
        @forelse(old('ci_prize_time',!empty($candidate->candidateInfo->ci_prize)?(is_array($candidate->candidateInfo->ci_prize)?$candidate->candidateInfo->ci_prize:[]):[]) as $index => $item)
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian cấp
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_prize_time[]" value="{{!empty(old('ci_prize_time'))?old('ci_prize_time')[$index]:(!empty($candidate->candidateInfo->ci_prize)?(!is_array($candidate->candidateInfo->ci_prize)?$candidate->candidateInfo->ci_prize->time:$item->time):'')}}" placeholder="Nhập thời gian cấp" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên giải thưởng
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_prize_name[]" value="{{!empty(old('ci_prize_name'))?old('ci_prize_name')[$index]:(!empty($candidate->candidateInfo->ci_prize)?(!is_array($candidate->candidateInfo->ci_prize)?$candidate->candidateInfo->ci_prize->name:$item->name):'')}}" placeholder="Nhập tên công ty" class="form-group">
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @empty
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Thời gian cấp
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_prize_time[]" value="{{!empty($candidate->candidateInfo->ci_prize)?$candidate->candidateInfo->ci_prize->time:''}}" placeholder="Nhập thời gian cấp" class="datepicker form-group">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên giải thưởng
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_prize_name[]" value="{{!empty($candidate->candidateInfo->ci_prize)?$candidate->candidateInfo->ci_prize->name:''}}" placeholder="Nhập tên công ty" class="form-group">
                    </div>
                </div>
                <a class="remove-item remove-item-left"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @endforelse
    </div><!-- /.card-body -->
</div>
<!-- /.card -->

<!-- box sở thích -->
<div class="card" id="kynang">
    <div class="card-header  p-0">
        <h3 class="card-title ">
            Kỹ năng
        </h3>
        <button type="button" class="btn btn-clone btn-default ">
            <i class="fa fa-plus"></i> Thêm kỹ năng
        </button>
    </div><!-- /.card-header -->
    <div class="card-body">
        @forelse(old('ci_skill_name',!empty($candidate->candidateInfo->ci_skill)?(is_array($candidate->candidateInfo->ci_skill)?$candidate->candidateInfo->ci_skill:[]):[]) as $index => $item)
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên kỹ năng
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_skill_name[]" value="{{!empty(old('ci_skill_name'))?old('ci_skill_name')[$index]:(!empty($candidate->candidateInfo->ci_skill)?(!is_array($candidate->candidateInfo->ci_skill)?$candidate->candidateInfo->ci_skill->name:$item->name):'')}}" placeholder="Nhập tên kỹ năng" class="form-group">
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
                            <div class="rateskill-item {{!empty(old('ci_skill_evaluate'))?(old('ci_skill_evaluate')[$index]>=1?'rateskill-check':''):(!empty($candidate->candidateInfo->ci_skill)?($item->evaluate>=1?'rateskill-check':''):'')}}" data-value="1" data-hehe="5"></div>
                            <div class="rateskill-item {{!empty(old('ci_skill_evaluate'))?(old('ci_skill_evaluate')[$index]>=2?'rateskill-check':''):(!empty($candidate->candidateInfo->ci_skill)?($item->evaluate>=2?'rateskill-check':''):'')}}" data-value="2" data-hehe="5"></div>
                            <div class="rateskill-item {{!empty(old('ci_skill_evaluate'))?(old('ci_skill_evaluate')[$index]>=3?'rateskill-check':''):(!empty($candidate->candidateInfo->ci_skill)?($item->evaluate>=3?'rateskill-check':''):'')}}" data-value="3" data-hehe="5"></div>
                            <div class="rateskill-item {{!empty(old('ci_skill_evaluate'))?(old('ci_skill_evaluate')[$index]>=4?'rateskill-check':''):(!empty($candidate->candidateInfo->ci_skill)?($item->evaluate>=4?'rateskill-check':''):'')}}" data-value="4" data-hehe="5"></div>
                            <div class="rateskill-item {{!empty(old('ci_skill_evaluate'))?(old('ci_skill_evaluate')[$index]>=5?'rateskill-check':''):(!empty($candidate->candidateInfo->ci_skill)?($item->evaluate>=5?'rateskill-check':''):'')}}" data-value="5" data-hehe="5"></div>
                            <input type="hidden" name="ci_skill_evaluate[]" value="{{!empty(old('ci_skill_evaluate'))?old('ci_skill_evaluate')[$index]:(!empty($candidate->candidateInfo->ci_skill)?$item->evaluate:0)}}" class="rateskill-input">
                        </div>
                    </div>
                </div>
                <a class="remove-item remove-item-right"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @empty
            <div class="row candidateBox border-bottom">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="row candidateBox-row">
                        Tên kỹ năng
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row candidateBox-row">
                        <input type="text" name="ci_skill_name[]" placeholder="Nhập thời gian cấp" class="form-group">
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
                            <input type="hidden" name="ci_skill_evaluate[]" class="rateskill-input">
                        </div>
                    </div>
                </div>
                <a class="remove-item remove-item-right"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
            </div> <!-- /. row -->
        @endforelse

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
                    <textarea class="form-group" name="ci_hobby" placeholder="Nhập sở thích của bạn">{{old('ci_hobby',!empty($candidate->candidateInfo->ci_hobby)?$candidate->candidateInfo->ci_hobby:'')}}</textarea>
                </div>
            </div>
        </div> <!-- /. row -->
    </div><!-- /.card-body -->
</div>
<!-- /.card -->