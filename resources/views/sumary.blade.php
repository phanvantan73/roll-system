@extends('layouts.app')

@section('content')
    <div class="toc_container">
    	<div class="row">
    		<div class="col-md">Thông tin ngày {{ $requestDay }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md">
		    	<div class="table table-responsive">
    				<table class="table table-hover">
			        	<thead class="table table-dark">
			        		<tr>
			        			<td>Tên sinh viên</td>
			        			<td>Thời gian điểm danh</td>
			        		</tr>
			        	</thead>
			        	<tbody>
			        		@foreach ($data as $infoDay)
			        			<tr>
			        				<td>{{ $infoDay['student']->name }}</td>
			        				<td>{{ $infoDay['rollTime'] }}</td>
			        			</tr>
			    			@endforeach
			        	</tbody>
			        </table>
    			</div>
    		</div>
    	</div>
    </div>
@endsection
