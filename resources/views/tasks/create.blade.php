@extends('layout')

@section('content')
	<form action="{{ route('tasks.store') }}" method="post">
		{{ csrf_field() }}
		Task name:
		<br />
		<input type="text" name="name" />
		<br /><br />
		Task description:
		<br />
		<textarea name="description"></textarea>
		<br /><br />
		Start time:
		<br />
		<input type="text" name="task_date" class="date" />
		<br /><br />
		<input type="submit" value="Save" />
	</form>
@endsection