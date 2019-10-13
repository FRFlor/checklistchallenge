@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="my-4">
                    <a href="{{ route('checklist-template.index') }}">
                        All Checklist Templates:
                    </a>
                    <h1>{{ $checklistTemplate->name }}</h1>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Items</div>

                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach( $checklistTemplate->items as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        {{ $item->name }}
                                    </div>

                                    <form action="{{ route('item-template.delete', $item) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Add Item</div>

                    <div class="card-body">
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

                <form action="{{ route('checklist-template.delete', $checklistTemplate) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-outline-danger" type="submit">Delete Checklist Template</button>
                </form>
            </div>
        </div>
    </div>
@endsection
