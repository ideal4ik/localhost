<?php
namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Question;    
use Illuminate\Http\Request;
use App\Models\Result;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('dashboard', compact('tests'));
    }

    public function show($id)
    {
        $test = Test::findOrFail($id);
        $questions = Question::all();
        return view('test/viewtest', compact('test', 'questions'));
    }

    public function getQuestionsForTest($testId)
    {
        $test = Test::findOrFail($testId);

        if ($test) {
            $questions = $test->questions; // получаем все вопросы для данного теста
            return view('test/viewtest', compact('test', 'questions'));
        } else {
            return redirect()->route('main')->with('error', 'Тест с указанным test_id не найден');
        }
    }
    // public function saveResult(Request $request)
    // {
    //     dd($request);
    //     // Получение данных из формы
    //     $userId = auth()->user()->id; // Предполагается, что вы используете аутентификацию и имеете доступ к пользовательскому ID
    //     $testId = $request->input('test_id');
    //     $answer1 = $request->input('answer_1');
    //     $answer2 = $request->input('answer_2');
    //     $answer3 = $request->input('answer_3');
    //     $answer4 = $request->input('answer_4');

    //     // Сохранение данных в базу данных
    //     Result::create([
    //         'user_id' => $userId,
    //         'test_id' => $testId,
    //         'answer_1' => $answer1,
    //         'answer_2' => $answer2,
    //         'answer_3' => $answer3,
    //         'answer_4' => $answer4,
    //     ]);

    //     // Вы можете добавить дополнительные действия после сохранения данных, если нужно

    //     // Перенаправление пользователя после успешного сохранения данных
    //     return redirect()->route('test.result.success')->with('success', 'Результат успешно сохранен.');
    // }
    public function saveResult(Request $request)
    {
        $testId = $request->input('test_id');
        $questions = Question::where('test_id', $testId)->get();
        $test = Test::find($testId);
        $questionsCount = $test->questions->count();
        $correctAnswersCount = 0;

        foreach ($questions as $question) {
            $selectedAnswer = $request->input('question_' . $question->id);
            if ($selectedAnswer === $question->correct_answer) {
                $correctAnswersCount++;
            }
        }

        // Сохранение результатов в таблицу Result
        $userId = auth()->user()->id; // Предполагается, что у вас есть аутентификация пользователей
        Result::create([
            'user_id' => $userId,
            'test_id' => $testId,
            'total_score' => $correctAnswersCount . "/" . $questionsCount,
        ]);

        return redirect()->route('dashboard', ['testId' => $testId])->with('success', 'Тест успешно выполнен. Ваш результат сохранен.');
        return view('test.result', [
            'testId' => $testId,
            'totalScore' => $correctAnswersCount,
            // Другие данные, которые вы хотите передать в представление
        ]);
    
    }
}