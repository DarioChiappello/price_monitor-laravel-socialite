@extends('layouts.app')

@section('styles')
    <!-- <link rel="stylesheet" href="{{ asset('css/base.min.css') }}" > -->
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}" >
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <p>Errors</p>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ url('prices') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select name="location_id" id="location" class="form-control">
                                <option placeholder value="">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item">Item</label>
                            <select name="item_id" id="item" class="form-control">
                                <option placeholder value="">Select Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Value</label>
                            <input type="text" class="form-control" name="value">
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Confirm
                        </button>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Last values</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Location</th>
                                <th>Value</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prices as $price)
                            <tr>
                                <td>{{ $price->item->name }}</td>
                                <td>{{ $price->location->name }}</td>
                                <td>{{ $price->value }}</td>
                                <td>{{ $price->created_at }}</td>
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

@section('scripts')
    <script src="{{ asset('js/choices.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            const locationChoices = new Choices('#location');
            const itemChoices = new Choices('#item');
        })
        
    </script>
@endsection