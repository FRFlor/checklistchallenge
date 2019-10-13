@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="my-4">
                    <a href="{{ route('checklist.index') }}">
                        All Checklists:
                    </a>
                    <h1>{{ $attempt->name }}</h1>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Tasks</div>

                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach( $attempt->tasks as $task)
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div>
                                        <form action="{{ route('task.update', $task) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="checkbox"
                                                   name="completed"
                                                   value="1"
                                                   {{ $task->completed ? "checked" : ""}}
                                                   onChange="this.form.submit()">
                                        </form>
                                    </div>
                                    <div class="ml-2">
                                        {{ $task->name }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

{{--                <form action="{{ route('checklist.delete', $checklist) }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    @method('delete')--}}
{{--                    <button class="btn btn-outline-danger" type="submit">Delete Checklist</button>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
@endsection
