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
                    				Menu
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
	                </div>
	            </div>
	        @endpermission    
        </div>
    </div>
@endsection