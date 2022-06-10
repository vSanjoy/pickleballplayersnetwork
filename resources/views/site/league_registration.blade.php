@extends('site.layouts.app', [])
@section('content')

    @include('site.includes.header')

    <div class="innerContentArea registration">
		<div class="container">
            <div class="sec-title text-center">
				<h2>League Name</h2>
			</div>
			<div class="blockarea">
				<h3>Basic League Information</h3>
				<p>(Location, Play Type, Gender, Ratings, Status,</p>
				<p>Registration Dates, League play dates, cost etc.)</p>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Team Name</th>
							<th scope="col">Player 1</th>
							<th scope="col">Player 2 </th>
							<th scope="col">Home Courts</th>
							<th scope="col">Player Availability</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Braemar Warriors </td>
							<td>Adam Klein </td>
							<td>Brian Kostukovsky</td>
							<td>Private / Private</td>
							<td>Weekdays Evenings</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Braemar Warriors </td>
							<td>Adam Klein </td>
							<td>Brian Kostukovsky</td>
							<td>Private / Private</td>
							<td>Weekdays Evenings</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Braemar Warriors </td>
							<td>Adam Klein </td>
							<td>Brian Kostukovsky</td>
							<td>Private / Private</td>
							<td>Weekdays Evenings</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Braemar Warriors </td>
							<td>Adam Klein </td>
							<td>Brian Kostukovsky</td>
							<td>Private / Private</td>
							<td>Weekdays Evenings</td>
						</tr>
						<tr>
							<td>5</td>
							<td>Braemar Warriors </td>
							<td>Adam Klein </td>
							<td>Brian Kostukovsky</td>
							<td>Private / Private</td>
							<td>Weekdays Evenings</td>
						</tr>
						<tr>
							<td>6</td>
							<td>Braemar Warriors </td>
							<td>Adam Klein </td>
							<td>Brian Kostukovsky</td>
							<td>Private / Private</td>
							<td>Weekdays Evenings</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="registerfor">
				<div class="plusign"><a href="javascript:void(0);" class=""><i class="fa fa-plus-circle" aria-hidden="true"></i></a></div>
				<div class="registersec">
					<a href="javascript:void(0);" id="register-for-league">Register for this League Now</a>
					<h6>Registration Closes 06/02</h6>
				</div>
			</div>
			<div class="partnerarea">
				<h3><span>Players who need a partner</span> <a href="javascript:void(0);" data-toggle="tooltip" title="These are players who do not have a partner but are interested in playing in this league.  You must partner up and pay for the league prior to officially being considered registered"><i class="fa fa-question-circle" aria-hidden="true"></i></a></h3>
				<ul>
					<li>
						<span class="name">Brian Kostukovsky</span>
					    <span class="minus"><a href="javscript:void(0);"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></span>
					    <span class="user"><a href="javscript:void(0);"><i class="fa fa-user" aria-hidden="true"></i></a></span>
					    <span class="mail"><a href="mailto:brian@yopmail.com"><i class="fa fa-envelope-open" aria-hidden="true" data-toggle="tooltip" title="brian@yopmail.com"></i></a></span>
					</li>
					<li>
						<span class="name">Adam Klein</span>
					    <span class="plus"><a href="javscript:void(0);"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></span>
					    <span class="user"><a href="javscript:void(0);"><i class="fa fa-user" aria-hidden="true"></i></a></span>
					    <span class="mail"><a href="mailto:adam@yopmail.com"><i class="fa fa-envelope-open" aria-hidden="true" data-toggle="tooltip" title="adam@yopmail.com"></i></a></span>
					</li>
					<li>
						<span class="name">Joe Bob</span>
					    <span class="plus"><a href="javscript:void(0);"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></span>
					    <span class="user"><a href="javscript:void(0);"><i class="fa fa-user" aria-hidden="true"></i></a></span>
					    <span class="mail"><a href="mailto:joe@yopmail.com"><i class="fa fa-envelope-open" aria-hidden="true" data-toggle="tooltip" title="joe@yopmail.com"></i></a></span>
					</li>
				</ul>
			</div>
		</div>
	</div>

    @include('site.includes.footer')
    
@endsection

@push('scripts')
   
@endpush