@extends('layouts.team')

@section('teamcontent')
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('teams.partials._nav')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Change Role</div>

                <div class="card-body">
					@if($user->isOnlyAdminInTeam($team))
						<p class="mb-0">
							<strong>{{ $user->name }}</strong> is the only Admin left in your team.
						</p>
					@else
						<form action="{{ route('teams.user.roles.update', [$team, $user,]) }}" method="post">
							@csrf
							@method('patch')
							<div class="form-group">
								<select name="role" id="role" class="form-control">
									@foreach($roles as $role => $data)
										<option value="{{ $role }}"
										{{ $user->hasRole($role) ? 'selected' : ''}}
										>
											{{ $data['name'] }}
										</option>
									@endforeach
								</select>
							</div>

							<button type="submit" class="btn btn-outline-success">Update</button>
						</form>
					@endif
                </div>
            </div>
        </div>
    </div>
@endsection    