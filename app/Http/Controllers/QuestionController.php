<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    public function index()
    {
        return view('questions');
    }

    public function table()
    {
        return DataTables::of(Question::all())->setTransformer(function ($value) {

            return [
                'id'            => $value->id,
                'question'      => $value->question,
                'is_published'  => $value->is_published,
                'created_at'    => Carbon::parse($value->created_at)->format('F j, Y'),
            ];
        })->make(true);
    }

    public function create()
    {
        return view('question-form');
    }

    public function store(Request $request)
    {
        Question::create([
            "user_id"       => auth()->id(),
            "answer"        => $request->answer,
            "question"      => $request->question,
            'is_published'  => 0,
            "details"       => $request->details,
        ]);

        return ['success' => true];
    }

    public function show($id)
    {
        $question = Question::query()->where('id', $id)->get()[0];

        return view('question-form', compact('question'));
    }

    public function update($question, Request $request)
    {
        Question::where('id', $question)->update([
            "user_id"     => auth()->id(),
            "answer"      => $request->answer,
            "question"    => $request->question,
            "details"     => $request->details,
        ]);

        return ['success' => true];
    }

    public function destroy($question, Request $request)
    {
        Question::destroy($question);

        return ['success' => true];
    }

    public function published(Request $request)
    {
        if($request->is_published == '0') {
            Question::where('id', $request->id)->update([
                "is_published" => '1',
            ]);
        } else {
            Question::where('id', $request->id)->update([
                "is_published" => '0',
            ]);
        }

        return ['success' => true];
    }
}
