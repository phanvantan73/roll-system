@if (count($data))
	<table class="table table-hover">
		<thead class="table table-dark">
			<tr>
				<td>Tên môn học</td>
				<td>Trạng thái</td>
				<td>Thời gian điểm danh</td>
			</tr>
		</thead>
		<tbody>
			@foreach ($data as $rollSubject)
				<tr>
					<td>{{ $rollSubject->name }}</td>
					<td>{{ $rollSubject->pivot->status == 1 ? 'Đã điểm danh' : 'Chưa điểm danh' }}</td>
					<td>{{ $rollSubject->pivot->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="text-danger">Bạn chưa điểm danh môn {{ $defaultSubjectName }} vào ngày {{ $defaultDay }}</div>
@endif
