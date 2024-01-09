@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center">
                            <h2 class="me-auto p-2">All Questions</h2>
                            <div class="p-2">
                                <a href="{{ route('questions.create') }}" class="btn btn-outline-success">Ask Question</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts._messages')
                        @foreach ($questions as $question)
                            <div class="media d-inline-flex">
                                <div class="d-inline-flex flex-column counters">
                                    <div class="vote">
                                        <strong>{{ $question->votes }}</strong> {{ Str::plural('vote', $question->votes) }}
                                    </div>
                                    <div class="status {{ $question->status }}">
                                        <strong>{{ $question->answers }}</strong>
                                        {{ Str::plural('answer', $question->answers) }}
                                    </div>
                                    <div class="view">
                                        {{ $question->views . ' ' . Str::plural('view', $question->views) }}
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="d-flex align-">
                                        <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                        <div class="ms-auto">
                                            @if (Auth::user()->can('update-question', $question))
                                                <a href="{{ route('questions.edit', $question->id) }}"
                                                    class="btn btn-sm btn-outline-info">Edit</a>
                                            @endif

                                            @if (Auth::user()->can('delete-question', $question))
                                                <form method="POST"
                                                    action="{{ route('questions.destroy', $question->id) }}"
                                                    class="form-delete" onsubmit="return confirm('are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="lead">
                                        Asked by
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        <small class="text-muted">{{ $question->created_date }}</small>
                                    </p>
                                    {{ Str::limit($question->body, 250) }}
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        <div class="mx-auto">
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
