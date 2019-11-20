@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Teams</div>

                <div class="card-body">
                    @if($teams->count())
                        <ul class="list-group">
                            @foreach($teams as $team)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('teams.show', $team) }}">{{$team->name}}</a>
                                    @if($team->ownedByCurrentUser())
                                        <span class="badge badge-pill badge-primary">Admin</span>
                                    @endif    
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mb-0">You have no teams</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">Create a Team</div>

                <div class="card-body">
                    <form action="{{ route('teams.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Team name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-secondary">Create team</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection