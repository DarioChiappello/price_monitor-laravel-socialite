@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Locations # {{ $location->id }}</div>

                <div class="card-body">
                    <form action="{{ url('/locations/'.$location->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="name">Location</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $location->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                        <a href="{{ url('/locations') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
