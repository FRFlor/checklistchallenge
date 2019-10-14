@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="my-4 d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('checklist.index') }}">
                            All Checklists:
                        </a>
                        <h1>{{ $checklist->name }}</h1>
                    </div>
                    <div class="float-right">
                        <form action="{{ route('attempt.store', $checklist) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Attempt
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Items</div>

                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach( $checklist->items as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        {{ $item->name }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Attempts:</div>

                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach( $checklist->attempts()->orderBy('created_at', 'desc')->get() as $attempt)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('attempt.show', $attempt) }}">
                                        {{ $attempt->created_at }}
                                    </a>
                                    <div>
                                        {{ $attempt->completed ? "Completed" : "Incomplete" }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    <a class="btn btn-outline-secondary" href="{{ route('checklist.edit', $checklist) }}">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
