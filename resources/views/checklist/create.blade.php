@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Checklist</div>

                    <div class="card-body">
                        <form action="{{ route('checklist.store') }}" method="POST">
                            @csrf
                            <input type="text" name="name" placeholder="name:">
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
