@extends('layouts.team')

@section('teamcontent')
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('teams.partials._nav')
        </div>
        <div class="col-md-9">

        	@if(!$team->hasSubscription())
	            <div class="card">
	                <div class="card-header">Subscriptions</div>

	                <div class="card-body">
	                    <form action="{{ route('teams.subscriptions.store', $team) }}" method="post">
	                    	@csrf 

	                    	<div class="form-group">
	                    		<label>Choose a plan</label>

	                    		@foreach($plans as $index => $plan)
									<div class="form-check">
										<input 
										type="radio" 
										name="plan" 
										id="plan_{{ $plan->id }}" 
										class="form-check-input"
										value = "{{ $plan->id }}"
										{{ $index === 0 ? 'checked' : ''}}
										>
										<label class="form-check-label" for="plan_{{ $plan->id }}">
											{{ $plan->name }} ({{ $plan->team_limit}} users)
										</label>
									</div>
	                    		@endforeach
	                    	</div>

	                    	<div class="form-group">
	                    		<label>Payment details</label>
	                    		<stripe></stripe>
	                    	</div>

	                    	<button type="submit" class="btn btn-outline-dark">Process payment</button>
	                    </form>
	                </div>
	            </div>
            @endif
        </div>
    </div>
@endsection    