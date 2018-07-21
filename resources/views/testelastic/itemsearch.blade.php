<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Elasticsearch</title>
</head>
<body>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 class="text-primary" style="text-align: center;"></h1>
    </div>
</div>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <form action="{{route('book.search')}}" method="post">
                            @csrf
                        <input name="can_name" value="{{ old('can_name') }}" type="text" class="form-control" placeholder="Tìm kiếm">
                        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
          </span>
                        </form>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div>
        <div class="panel-body">


            <div class="row">
                <div class="col-lg-6">
                    @if(!empty($cans))
                        @php dump($cans) @endphp
                        @foreach($cans as $key => $value)
                            <h3 class="text-danger">{{ $value['title'] }}</h3>
                            <p>{{ $value['description'] }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tạo mới 1 sách và lưu vào Index
                        </div>
                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                <form action="{{route('book.store')}}" method="post">
                                    @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Tên sách:</strong>
                                        <input type="text" name="bk_name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Số lượng:</strong>
                                        <input type="text" name="bk_quantity">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Đơn giá:</strong>
                                        <input type="text" name="bk_price">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                                </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>