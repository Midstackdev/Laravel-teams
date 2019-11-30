@extends('layouts.team')

@section('teamcontent')
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('teams.partials._nav')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Confirm user deletion</div>

                <div class="card-body">
                    <p>Are you sure you wan to remove {{ $user->name }} from <strong>{{ $team->name }}</strong>?</p>
                    <form action="{{ route('teams.users.destroy', [$team, $user]) }}" method="post">
                        @csrf
                        @method('delete')

                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection    