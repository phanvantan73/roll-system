@extends('layouts.app')

@section('content')
    <div class="toc_container">
    	<div class="row">
    		<div class="col-md-3">
    			<div class="row">
    				<div class="col-md">
    					<div class="div-box">
		    				Họ và tên: {{ Auth::user()->student->name }}<br>
		    				Lớp: {{ Auth::user()->student->class }}<br>
		    				Mssv: {{ Auth::user()->student->mssv }}<br>
		    				Trường: Đại học Bách Khoa Đà Nẵng <br>
		    				Mô tả thêm: <p>Đại học Bách Khoa Đà Nẵng Đại học Bách Khoa Đà Nẵng Đại học Bách Khoa Đà Nẵng Đại học Bách Khoa Đà Nẵng Đại học Bách Khoa Đà Nẵng Đại học Bách Khoa Đà Nẵng</p>
		    			</div>
    				</div>
    			</div>
    			<hr style="margin-left: 30px; width: 300px">
    		</div>
    		<div class="col-md-9">
    			<div class="row">
		    		<div class="col-md-8 offset-2">
			               <div class="form-group row">
			                   <div class="col-md-6">
				                   	<label for="subject_id">Chọn môn học:</label>
				                   {!! Form::select('subject_id', $subjects, null, ['id' => 'select-subject', 'class' => 'form-control']) !!}
			                   </div>
			                   <div class="col-md-6">
			                   		<label for="day">Chọn ngày:</label>
								    {!! Form::date('day', null, ['class' => 'form-control', 'id' => 'select-day']) !!}
			                   	<div class="form-group input-group">
			               </div>
			               <div class="form-group text-right">
			               		<button class="btn btn-primary" id="see-result" data-url="{{ route('get-result') }}">Xem kết quả</button>
			               </div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md">
		    			<div id="result">
		    				@include('table')
		    			</div>
		    		</div>
		    	</div>
    		</div>
    	</div>
    </div>
@endsection
@section('js')
	@parent
	<script type="text/javascript">
		$(document).ready(function () {
			let d = new Date();
			let month = d.getMonth()+1;
			let day = d.getDate();
			let output = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;
			$('#select-day').val(output);
		})

		$(document).on('click', '#see-result', function (e) {
			e.preventDefault();
			let result = $('#result');
			let day = $('#select-day').val();
			let subject = $('#select-subject :selected').text();
			result.empty();
			$.ajax({
	            method: 'GET',
	            url: $(this).data('url'),
	            data: {
	            	day: day,
	            	subject_id: $('#select-subject').val()
	            },
	            dataType: 'json'
	        })
	        .done(function (data) {
	        	result.empty();
	            if (data.html.length) {
	                result.append(data.html);
	            } else {
	            	day = day.split('-').reverse();
	            	day = day[0] + '-' + day[1] + '-' + day[2];
	                result.append('<div class="text-danger">Bạn chưa điểm danh môn ' + subject + ' vào ngày ' + day + '</div>');
	            }
	        })
	        .fail(function (data) {
	            console.log(data);
	        });
		})
	</script>
@endsection
