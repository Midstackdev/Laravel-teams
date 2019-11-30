@extends('layouts.team')

@section('teamcontent')
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('teams.partials._nav')
        </div>
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">
                	Dashboard
                </div>
                <div class="card-body">
                    @include('teams.subscriptions.partials._usage')
                    <table class="table table-striped mb-0">
                    	<thead>
                    		<tr>
                    			<th>User</th>
                    			<th>Role</th>
                    			<th>Joined</th>
                    			<th>Actions</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($team->users as $user)
                    		<tr>
                    			<td>{{ $user->name }}</td>
                    			<td>
                    				@if($team->ownedBy($user))
                    				    <span class="badge badge-pill badge-primary">Admin</span>
                    				@else
                    				    <span class="badge badge-pill badge-secondary">Member</span>
                    				@endif
                    			</td>
                    			<td>
                    				{{ $user->pivot->created_at }}
                    			</td>
                    			<td>
                    				<div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                      </button>
                                      <div class="dropdown-menu">
                                        @permission('delete user')
                                            @if(!$user->isOnlyAdminInTeam($team))
                                            <button class="dropdown-item" type="button">
                                                <a href="{{ route('teams.users.delete', [$team, $user]) }}">Delete</a>
                                            </button>
                                            @endif
                                        @endpermission
                                      </div>
                                    </div>
                    			</td>
                    		</tr>
                    		@endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
			@permission('add users', $team->id)
	            <div class="card">
    	                <div class="card-header">Add a user</div>

    	                <div class="card-body">
                            @if(!$team->hasSubscription())
                                <p class="mb-0">
                                    Please <a href="{{ route('teams.subscriptions.index', $team)}}">subscribe</a> to add users.
                                </p>
                            @elseif($team->hasReachedMemberLimit())    
                                <p class="mb-0">
                                    <a href="{{ route('teams.subscriptions.index', $team)}}">Upgrade</a> to add more users.
                                </p>
                            @else
    	                    <form action="{{ route('teams.users.store', $team) }}" method="post">
    	                        @csrf
    	                        <div class="form-group">
    	                            <label for="email">Email</label>
    	                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror">

    	                            @error('email')
    	                                <span class="invalid-feedback">
    	                                    <strong>{{ $message }}</strong>
    	                                </span>
    	                            @enderror
    	                        </div>

    	                        <button type="submit" class="btn btn-secondary">Add user</button>
    	                    </form>
                            @endif    
    	                </div>
	            </div>
	        @endpermission    
        </div>
    </div>
@endsection