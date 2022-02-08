@extends('../layouts.app')

@section('content')
	<h3> Thêm Sinh Viên </h3>
	<p> Thòi gian bắt đầu: <?php echo $starting_time;?> </p>
	<div>
	<ul>
	@foreach($errors->all() as $error)
		<li>{{$error}} </li>
	@endforeach

	</ul>

	<form action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="fullname"> Họ Tên</label>

		<input type="text" name="fullname" class="col-sm-10 form-control" id="fullname" value="{{old('fullname')}}">
	</div>

		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="DOB"> Ngày Sinh</label>

		<input type="date" name="DOB" class="col-sm-10 form-control" id="DOB" value="{{old('DOB')}}">
	</div>

		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="sex"> Giới tính</label>

		<input type="radio" name="sex" class="col-sm-10 form-control" id="sex" value="1"
			{{old('sex')?"checked":""}}
		>Nam
		<input type="radio" name="sex" class="col-sm-10 form-control" id="sex" value="0"
			{{old('sex')?"":"checked"}}
		>Nữ	
	</div>


        <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="avatar"> Ảnh Thẻ</label>

        <input type="file" name="avatar" class="col-sm-10 form-control" id="avatar" value="{{old('avatar')}}">
    </div>

		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="address"> Địa Chỉ</label>

		<input type="text" name="address" class="col-sm-10 form-control" id="address" value="{{old('address')}}">
	</div>

		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="class_id"> Lớp</label>
           <select name="class_id" id="class_id" class="form-control">
                @foreach($classes as $class)
                    <option value="{{$class->id}}">
                        {{$class->name}}
                    </option>
                @endforeach
            </select>
	</div>

   <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="description">Mô tả</label>
            <textarea name="description" id="description" class="col-sm-10 form-control"></textarea>
    </div>
    <div class="form-group row">

            <input type="submit"  class="col-sm-6 form-control"  value="Thêm">
            <input type="reset"  class="col-sm-6 form-control"  value="Nhập lại">

    </div>
</form>

@endsection
