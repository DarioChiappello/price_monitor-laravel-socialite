@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
                <div class="card-header">Add new Item</div>

                <div class="card-body">
                    <form action="{{ url('/items') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Item</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">Items</div>

                <div class="card-body">
                    <form action="{{ url('/items') }}" method="GET">
                        <div class="form-group">
                            <input type="text" name="search" placeholder="Search" class="form-control" value="{{ $search }}">
                        </div>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Date</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <form action="{{ url('/items/'.$item->id) }}" method="POST">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <a href="{{ url('/items/'.$item->id) }}" class="btn btn-info text-white">
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
                    {{ $items->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
