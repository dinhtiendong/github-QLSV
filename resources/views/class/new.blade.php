@extends('../layouts.app')
@section('content')
<h3> Thêm Lớp</h3>
<div>
	<ul>
	@foreach($errors->all() as $error)
		<li>{{$error}} </li>
	@endforeach

	</ul>
<form action="{{route('class.store')}}" method="POST">
	@csrf
	<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="name"> Tên Lớp</label>

		<input type="text" name="name" class="col-sm-10 form-control" id="name" value="{{old('name')}}">
	</div>

	<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="description"> Mô Tả</label>
		<textarea name="description" class="col-sm-10 form-control" id="description">{{old('name')}}
		</textarea>

	</div>

	<div class="form-group row">
			<input type="submit" class="col-sm-2 form-control" value="Thêm">

		<input type="reset" class="col-sm-2 form-control" value="Nhập Lại">
	</div>
	
</form>
</div>

@endsection