@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Locations</div>

                <div class="card-body">
                    <form action="{{ url('/locations') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Location</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                            <tr>
                                <td>{{ $location->name }}</td>
                                <td>
                                    
                                    <form action="{{ url('/locations/'.$location->id) }}" method="POST">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <a href="{{ url('/locations/'.$location->id) }}" class="btn btn-info text-white">
                                            Edit
                                        </a>
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
