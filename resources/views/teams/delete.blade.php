@extends('layouts.team')

@section('teamcontent')
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('teams.partials._nav')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Confirm team deletion</div>

                <div class="card-body">
                    <p>Are you sure you wan to dele <strong>{{ $team->name }}</strong>?</p>
                    <form action="{{ route('teams.destroy', $team) }}" method="post">
                        @csrf
                        @method('delete')

                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection    