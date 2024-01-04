<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DB::enableQueryLog();

        //$questions = Question::latest()->paginate(5);
        //we use this query call instead in order to solve the N + 1 query problem for user call

        $questions = Question::with('user')->latest()->paginate(5);

        //rendering a view will simply return the string content of the html page
        //view('questions.index', compact('questions'))->render();

        return view('questions.index', compact('questions'));

        //dd(DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $request->user()->questions()->create(
            $request->only('title', 'body')
        );

        return redirect()->route('questions.index')->with('success', 'your question has been submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->only('title', 'body'));
        return redirect()->route('questions.index')->with('success','your question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
