@extends('../layouts.app')

@section('content')
<a href="{{route('class.create')}}"> Thêm </a>
<table class="table table-stripped" border="1">
	<tr>
		<th>{{__('my_lang.name')}} </th>
		<th>{{__('my_lang.description')}}</th>
		<th>{{__('my_lang.action')}}</th>
	</tr>
	@foreach($classes as $class)
		<tr>
			<td>{{$class->name}} </td>
			<td>{{$class->description}} </td>
			<td>
				<a href="{{route('class.edit',['class'=>$class->id])}}">
					<button>{{__('my_lang.edit')}}</button>
				</a>

				<form action="{{route('class.destroy',['class'=>$class->id])}}" method="POST" onsubmit="return confirm('Bạn thực sự muốn xóa')">
					@method('DELETE')
					<!-- <input type="hidden" name="_method" value="delete"> -->
					@csrf
					<input type="submit" value="{{__('my_lang.delete')}}">
					
				</form>
			 </td>
		</tr>	
	@endforeach

</table>	

<div>
		{{$classes->onEachSide(5)->links()}}

</div>


@endsection