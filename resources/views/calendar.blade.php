@extends('layout')

@section('content')
	<div id="inbox" class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Calendar</h1>
		</div>
		<div class="list-group">
			{!! $calendar->calendar() !!}
			{!! $calendar->script() !!}
			{{-- @if (isset($events))
				@foreach($events as $event)
					<div class="list-group-item">
						<h3 class="list-group-item-heading">{{ $event->getSubject() }}</h3>
						<p class="list-group-item-heading text-muted">Start: {{ (new DateTime($event->getStart()->getDateTime()))->format(DATE_RFC2822) }}</p>
						<p class="list-group-item-heading text-muted">End: {{ (new DateTime($event->getEnd()->getDateTime()))->format(DATE_RFC822) }}</p>
					</div>
				@endforeach
			@endif --}}
		</div>
	</div>
@endsection