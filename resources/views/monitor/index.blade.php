@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Price Monitor</div>

                <div class="card-body">
                    <form action="{{ url('/monitor') }}" method="GET">
                        <div class="form-group">
                            <label for="search">Search Item</label>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Item" value="{{ $search }}">
                        </div>
                    </form>
                    <p>Values charged from {{ $startDate }} to {{ $endDate }}</p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Min Value</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->lowestValue($startDate, $endDate) }}</td>
                                <td>
                                    <a href="{{ 
                                        route('monitor',
                                         [
                                            'search' => $search,
                                            'page' => $items->currentPage(),
                                            'item_id' => $item->id
                                        ])
                                     }}" class="btn btn-info btn-sm text-white">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $items->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @if(count($prices) > 0)
            <div class="card mt-4">
                <div class="card-header">Item Details</div>

                <div class="card-body">
                    <a href="{{ url('/items/'.$itemId.'/prices') }}" class="btn btn-success">
                        Export
                    </a>
                    <table class="table table-hover mt-2">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Location</th>
                                <th>Value</th>
                                <th>Date</th>
                                @if(auth()->user()->is_admin)
                                <th>Options</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prices as $price)
                            <tr>
                                <td>{{ $price->user->name }}</td>
                                <td>{{ $price->location->name }}</td>
                                <td>{{ $price->value }}</td>
                                <td>{{ $price->created_at }}</td>
                                @if(auth()->user()->is_admin)
                                <td>
                                    <form action="{{ url('/prices/'.$price->id) }}" method="POST">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
