<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\TechField;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('options','techField')->paginate(15);
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        $fields = TechField::all();
        return view('admin.questions.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text'          => 'required|string',
            'type'          => 'required|in:single,multiple,scale',
            'tech_field_id' => 'nullable|exists:tech_fields,id',
            'options_text'  => 'nullable|string',
        ]);

        $q = Question::create([
            'text'         => $data['text'],
            'type'         => $data['type'],
            'tech_field_id'=> $data['tech_field_id'],
        ]);

        // If single/multiple, parse options
        if (in_array($data['type'], ['single','multiple']) && !empty($data['options_text'])) {
            $lines = array_filter(array_map('trim', explode("\n", $data['options_text'])));
            foreach ($lines as $i => $label) {
                QuestionOption::create([
                    'question_id'=> $q->id,
                    'text'       => $label,
                    'value'      => $i,
                ]);
            }
        }

        return redirect()->route('admin.questions.index')
                         ->with('success','Question created.');
    }

    public function edit(Question $question)
    {
        $fields = TechField::all();
        // prepare existing options as newline text
        $options_text = $question->options->pluck('text')->implode("\n");
        return view('admin.questions.edit', compact('question','fields','options_text'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'text'          => 'required|string',
            'type'          => 'required|in:single,multiple,scale',
            'tech_field_id' => 'nullable|exists:tech_fields,id',
            'options_text'  => 'nullable|string',
        ]);

        $question->update([
            'text'         => $data['text'],
            'type'         => $data['type'],
            'tech_field_id'=> $data['tech_field_id'],
        ]);

        // rebuild options
        $question->options()->delete();
        if (in_array($data['type'], ['single','multiple']) && !empty($data['options_text'])) {
            $lines = array_filter(array_map('trim', explode("\n", $data['options_text'])));
            foreach ($lines as $i => $label) {
                QuestionOption::create([
                    'question_id'=> $question->id,
                    'text'       => $label,
                    'value'      => $i,
                ]);
            }
        }

        return redirect()->route('admin.questions.index')
                         ->with('success','Question updated.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')
                         ->with('success','Question deleted.');
    }
}
