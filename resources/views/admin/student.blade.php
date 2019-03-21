@extends('layouts.app')

@section('content')
    <div class="toc_container">
    	<div class="row">
    		<div class="col-md">
    			<button class="btn btn-success" id="add-student-button">Thêm học sinh</button>
    		</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-md">
		    	<div class="table table-responsive">
    				<table class="table table-hover" id="all-student-table">
			        	<thead class="table table-dark">
			        		<tr>
			        			<td>Tên sinh viên</td>
			        			<td>Mã số sinh viên</td>
			        		</tr>
			        	</thead>
			        	<tbody>
			        		@foreach ($users as $user)
			        			<tr>
			        				<td>{{ $user->student->name }}</td>
			        				<td>{{ $user->student->mssv }}</td>
			        			</tr>
			    			@endforeach
			        	</tbody>
			        </table>
    			</div>
    		</div>
    	</div>
    	<div class="modal fade" tabindex="-1" role="dialog" id="add-student-modal">
		   <div class="modal-dialog" role="document">
		       <div class="modal-content">
		           <div class="modal-header">
		               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		           </div>
		           <div class="modal-body">
		               {{ Form::open(['route' => 'add-student', 'method' => 'POST', 'id' => 'form-add-student']) }}
		               		<div class="form-group">
			                   <label for="name">Tên sinh viên:</label>
			                   <input type="text" name="name" id="name" placeholder="Nhập tên sinh viên" class="form-control">
			               </div>
			               <div class="form-group">
			                   <label for="mssv">Mã số sinh viên:</label>
			                   <input type="text" name="mssv" id="mssv" placeholder="Nhập mã số sinh viên" class="form-control">
			               </div>
			               <div class="form-group">
			               		<button type="submit" class="btn btn-primary btn-block">Tạo mới</button>
			               </div>
		               {{ Form::close() }}
		           </div>
		           <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		           </div>
		       </div><!-- /.modal-content -->
		   </div><!-- /.modal-dialog -->
		</div>
    </div>
@endsection

@section('js')
	@parent
	<script type="text/javascript">
		$(document).on('click', '#add-student-button', function () {
			$('#add-student-modal').modal('show');
		})
		$(document).on('submit', '#form-add-student', function (e) {
			e.preventDefault();
			let name = $('input#name').text();
			let mssv = $('input#mssv').text();
			let data = $(this).serialize();
			let table = $('#all-student-table');
			console.log(data);
			$.ajax({
	            method: 'POST',
	            url: $(this).attr('action'),
	            data: data,
	            dataType: 'json'
	        })
	        .done(function (data) {
	            if (data.success) {
	                
	                $('#add-student-modal').modal('hide');
	            }
	        })
	        .fail(function (data) {
	            console.log(data);
	        });
		})
	</script>
@endsection
