<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student\QuizResult;
use App\Models\Teacher\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function viewQuiz($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);

        return response()->json([
            'success' => true,
            'quiz' => $quiz,
        ]);
    }

    public function submit(Request $request, $quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        $answers = $request->input('answers', []);
        $user = Auth::user();

        $score = 0;
        $total = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $selectedOptionId = $answers[$question->id] ?? null;
            if (!$selectedOptionId) continue;

            $correctOption = $question->options->firstWhere('is_correct', 1);

            if ($correctOption && $correctOption->id == $selectedOptionId) {
                $score++;
            }
        }

        $percentage = $total > 0 ? round(($score / $total) * 100, 2) : 0;

        // Store or update result
        QuizResult::updateOrCreate(
            [
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
            ],
            [
                'score' => $score,
                'percentage' => $percentage,
            ]
        );

        return response()->json([
            'success' => true,
            'score' => $score,
            'total' => $total,
            'percentage' => $percentage,
        ]);
    }
}
