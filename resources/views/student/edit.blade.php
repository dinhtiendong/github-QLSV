@extends('../layouts.app')

@section('content')
	<h3> Sửa Sinh Viên </h3>
	<div>
	<ul>
	@foreach($errors->all() as $error)
		<li>{{$error}} </li>
	@endforeach

	</ul>

	<form action="{{route('student.update',['student'=>$student->id])}}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="fullname"> Họ Tên</label>

		<input type="text" name="fullname" class="col-sm-10 form-control" id="fullname" value="{{count($errors)?old('fullname'):($student->fullname)}}">
	</div>

		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="DOB"> Ngày Sinh</label>

		<input type="date" name="DOB" class="col-sm-10 form-control" id="DOB" value="{{count($errors)?old('DOB'):(new DateTime($student->DOB))->format('Y-m-d')}}">
	</div>

		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="sex"> Giới tính</label>

		<input type="radio" name="sex" class="col-sm-6 " id="sex" value="1"
			{{old('sex')?"checked":""}}
		>Nam
		<input type="radio" name="sex" class="col-sm-6 " id="sex" value="0"
			{{old('sex')?"":"checked"}}
		>Nữ	
	</div>


        <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="avatar"> Ảnh Thẻ</label>
      	<div class="col-sm-10" >
      		@if(file_exists("./uploads/{$student->id}.jpg"))
      			<img style="width:220px; height:300px" src={{"/uploads/{$student->id}.jpg"}} >
      			@else
      			<img style="width:220px; height:300px" src={{"/uploads/NoPhoto.jpg"}}>
      			@endif
      	</div>

        <input type="file" name="avatar" class=" form-control" id="avatar" value="{{count($errors)?old('avatar'):($student->avatar)}}">
    </div>

		<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="address"> Địa Chỉ</label>

		<input type="text" name="address" class="col-sm-10 form-control" id="address" value="{{count($errors)?old('address'):($student->address)}}">
	</div>

	
    </div>
    <div class="form-group row">
		<label class="col-sm-2 col-form-label" for="class_id"> Lớp</label>
           <select name="class_id" id="class_id" class="form-control">
           	<?php
           	$current_class_id =count($errors)?old('class_id'):$student->class_id;
           	?>
                @foreach($classes as $class)
                    <option value="{{$class->id}}" <?php echo  $class->id == $current_class_id?"selected":"" ;?>>
                        {{$class->name}}
                    </option>
                @endforeach
            </select
   <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="description">Mô tả</label>
            <textarea name="description" id="description" class="col-sm-10 form-control">
            	{{count($errors)?old('description'):($student->description)}}
            </textarea>
    </div>
    <div class="form-group row">

            <input type="submit"  class="col-sm-2 form-control"  value="Cập Nhật">
            <input type="reset"  class="col-sm-2 form-control"  value="Nhập lại">

    </div>
</form>

@endsection
