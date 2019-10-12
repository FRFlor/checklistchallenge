@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="my-4">
                    <h1 class="float-left">Checklist Templates</h1>
                    <a class="btn btn-primary float-right" href="{{ route('checklist-template.create') }}">Create</a>
                    <div class="clearfix"></div>
                </div>
                @foreach($checklistTemplates as $checklistTemplate)
                    <div class="card mb-4">
                        <div class="card-header">
                            <a href="{{ route('checklist-template.show', $checklistTemplate) }}">
                                {{ $checklistTemplate->name }}
                            </a>
                        </div>

                        <div class="card-body">
                            Items:
                            <ul>
                                @foreach( $checklistTemplate->items as $item)
                                    <li>{{ $item->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
