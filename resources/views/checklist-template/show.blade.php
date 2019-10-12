@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $checklistTemplate->name }}</div>

                    <div class="card-body">
                        Items:
                        <ul>
                            @foreach( $checklistTemplate->items as $item)
                                <li>{{ $item->name }}</li>
                            @endforeach
                        </ul>

                        <hr>
                        <h2>Add Item:</h2>
                        <form action="{{ route('item-template.store', $checklistTemplate) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="name:">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
