@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Home</div>

					<div class="panel-body">
						<script>
							var data = JSON.parse('{{ $stats }}');

							new Morris.Bar({
								// ID of the element in which to draw the chart.
								element: 'stats-container',
								data: data,
								xkey: 'date',
								ykeys: ['value'],
								labels: ['Users']
							});
						</script>

						<ul class="nav nav-pills">
							<li class="{{ Input::get('days') == 7 || Input::get('days') == '' ? 'active' : ''}}"><a href="{{ url('stats?days=7') }}">7 Days</a></li>
							<li class="{{ Input::get('days') == 30 ? 'active' : ''}}"><a href="{{ url('stats?days=30') }}">30 Days</a></li>
							<li class="{{ Input::get('days') == 60 ? 'active' : ''}}"><a href="{{ url('stats?days=60') }}">60 Days</a></li>
							<li class="{{ Input::get('days') == 90 ? 'active' : ''}}"><a href="{{ url('stats?days=90') }}">90 Days</a></li>
						</ul>

						<div id="stats-container" style="height: 250px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
