@extends('../layouts.app')

@section('content')
	<div class="container">
		<label for="keyword">Tìm kiếm</label>
		<div class="form-g">
		<input type="text" name="keyword" id="keyword" class="form-control">
		</div>
	</div>
	<h3> {{__('pagination.student_list')}} </h3>
	<a href="{{route('student.create')}}"> Thêm Sinh Viên </a>
	<table class="table table-stripped table-bordered">
		<tr>
			<th>{{__('my_lang.avatar')}}</th>
			<th>{{__('my_lang.fullname')}}</th>
			<th>{{__('my_lang.DOB')}}</th>
			<th>{{__('my_lang.sex')}}</th>
			<th>{{__('my_lang.address')}}</th>
			<th>{{__('my_lang.class')}}</th>
			<th>{{__('my_lang.description')}}</th>
			<th>{{__('my_lang.action')}}</th>
		</tr>
		<tbody id="listStudent">
		@foreach($students as $student)
		<tr>
			<td><?php
				if(file_exists("./uploads/{$student->id}.jpg"))
				{
					?>
				
				<img src="<?php echo "./uploads/{$student->id}.jpg";?>" width="75" height="100">

				<?php
			}
				else 
				{
					?>
					<img src="<?php echo "./uploads/NoPhoto.jpg"; ?>" width="75" height="100">
				<?php
			}
			 ?> </td>
			<td>{{$student->fullname}}</td>
			<td>{{$student->DOB}}</td>
			<td>{{$student->sex?"Nam":"Nữ"}}</td>
			<td>{{$student->address}}</td>
			<td>{{$student->class->name}}</td>
			<td>{{$student->description}}</td>
			

			<td>
				<a href="{{route('student.edit',['student'=>$student->id])}}">
					<button>{{__('my_lang.edit')}}</button>
				</a>

				<form action="{{route('student.destroy',['student'=>$student->id])}}" method="POST" onsubmit="return confirm('Bạn thực sự muốn xóa')">
					@method('DELETE')
					<!-- <input type="hidden" name="_method" value="delete"> -->
					@csrf
					<input type="submit" value="{{__('my_lang.delete')}}">
					
				</form>
			</td>
	
		</tr>
		</tbody>
		@endforeach
	</table>
	<div>
		{{$students->onEachSide(10)->links()}}
		

</div>


@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('keyup', '#keyword', function(){
            var keyword = $(this).val();

            $.ajax({
                type: "get",
                url: "/search",
                data:{
                    keyword:keyword
                },
                dataType:"json",
                success: function(response)
                {
                    $('#listStudent').html(response);
                }
            });
        });
    });
</script>
@endsection