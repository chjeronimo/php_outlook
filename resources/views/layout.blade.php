<!DOCTYPE html>
<html>
	<head>
		<title>PHP Outlook</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">PHP Outlook</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="<?php echo ($_SERVER['REQUEST_URI'] == '/' ? 'active' : '');?>"><a href="/">Home</a></li>
						<li class="<?php echo ($_SERVER['REQUEST_URI'] == '/mail' ? 'active' : '');?>"><a href="/mail">Inbox</a></li>
						<li class="<?php echo ($_SERVER['REQUEST_URI'] == '/calendar' ? 'active' : '');?>"><a href="/calendar">Calendar</a></li>
						<li class="<?php echo ($_SERVER['REQUEST_URI'] == '/tasks' ? 'active' : '');?>"><a href="/tasks">Calendar View</a></li>
						<li class="<?php echo ($_SERVER['REQUEST_URI'] == '/contacts' ? 'active' : '');?>"><a href="/contacts">Contacts</a></li>
					</ul>
					@if (isset($username))
						<ul class="nav navbar-nav navbar-right">
							<li><p class="navbar-text">Hello {{ $username }}!</p></li>
						</ul>
					@endif
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<div class="container" role="main">
			@yield('content')
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		{{-- <script>
			$('.date').datepicker({
				autoclose: true,
				dateFormat: "yy-mm-dd"
			});

			$(document).ready(function() {
				// page is now ready, initialize the calendar...
				$('#calendar').fullCalendar({
					// put your options and callbacks here
					events : [
						@foreach($tasks ?? [] as $task)
						{
							title : '{{ $task->task_date . ', ' . $task->name }}',
							start : '{{ $task->task_date }}',
							url : '{{ route('tasks.edit', $task->id) }}'
						},
						@endforeach
					]
				})
			});
		</script> --}}
	</body>
</html>