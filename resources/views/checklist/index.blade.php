@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="my-4">
                    <h1 class="float-left">Checklists</h1>
                    <a class="btn btn-primary float-right" href="{{ route('checklist.create') }}">Create</a>
                    <div class="clearfix"></div>
                </div>
                @foreach($checklists as $checklist)
                    <div class="card mb-4">
                        <div class="card-header">
                            <a href="{{ route('checklist.show', $checklist) }}">
                                {{ $checklist->name }}
                            </a>
                        </div>

                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @foreach( $checklist->items as $item)
                                    <li class="list-group-item d-flex justify-content-start align-items-center">
                                        {{ $item->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
