@extends('../layouts.app')
@section('content')
<h3> Sửa Lớp</h3>
<div>
	<ul>
	@foreach($errors->all() as $error)
		<li>{{$error}} </li>
	@endforeach

	</ul>
<form action="{{route('class.update',['class'=>$class->id])}}" method="POST">

	@csrf
	@method('PUT')
	<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="name"> Tên Lớp</label>

		<input type="text" name="name" class="col-sm-10 form-control" id="name" value="{{count($errors)?old('name'):($class->name)}}">
	</div>

	<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="description"> Mô Tả</label>
		<textarea name="description" class="col-sm-10 form-control" id="description">{{count($errors)?old('description'):($class->description)}}
		</textarea>

	</div>

	<div class="form-group row">
			<input type="submit" class="col-sm-2 form-control" value="Cập Nhật">

		<input type="reset" class="col-sm-2 form-control" value="Nhập Lại">
	</div>
	
</form>
</div>

@endsection