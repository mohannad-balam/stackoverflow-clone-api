@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center">
                            <h2 class="me-auto p-2">{{ $question->title }}</h2>
                            <div class="p-2">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-danger">Back To
                                    All Questions</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! $question->body_html !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
