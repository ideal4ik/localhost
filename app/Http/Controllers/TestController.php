<?php
namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Question;    
use Illuminate\Http\Request;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    //выведение dashboard
    public function index()
    {
        $tests = Test::all();
        return view('dashboard', compact('tests'));
    }

    //выведение тестов
    public function show($id)
    {
        $test = Test::findOrFail($id);
        $questions = Question::all();
        return view('test/viewtest', compact('test', 'questions'));
    }
    //Выведение вопросов
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
    //сохранение результатов
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

        $correctAnswers = []; // массив для хранения правильных ответов

    foreach ($questions as $question) {
        if ($request->input('question_'.$question->id) === $question->correct_answer) {
            $correctAnswers[$question->id] = true;
        } else {
            $correctAnswers[$question->id] = false;
        }
    }

        // return redirect()->route('dashboard', ['testId' => $testId])->with('success', 'Тест успешно выполнен. Ваш результат сохранен.');
        return view('test.result', [
            'test' => $test,
            'testId' => $testId,
            'totalScore' => $correctAnswersCount,
            'questions' => $questions,
            'correctAnswers' => $correctAnswers,
        ]);
        
    }
    //тесты пользователя
    public function index2()
    {
        $user = auth()->user(); // Получаем текущего пользователя
        $tests = Test::where('user_id', $user->id)->get(); // Получаем тесты пользователя
    
        return view('test.mytests', compact('tests')); // Возвращаем представление с тестами
        
    }




    //CRUD
//     public function create()
//     {
//         $categories = Category::all();
//     return view('test.create', compact('categories'));
//     }

//     public function uploadImage(Request $request)
//     {
//         $request->validate([
//             'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Добавьте валидацию для изображения
//         ]);
    
//         if ($request->hasFile('img')) {
//             $image = $request->file('img');
//             $imageName = time() . '.' . $image->getClientOriginalExtension();
//             $image->move(public_path('images/tests'), $imageName);
    
//             return $imageName;
//         }
    
//         return 'no-image.png'; // Заглушка для случая, если изображение не было загружено
//     }
    

//     public function store(Request $request)
//     {
//         $user = auth()->user();
//         $image = $request->file('image');
//         $user_id = $request->input('user_id');
//         if (!$user_id) {
//             return back()->withInput()->with('error', 'User ID is missing.'); // Пример обработки ошибки
//         }

//         if ($request->hasFile('img')) {
//             $imagePath = $request->file('img')->store('images', 'public');
//             $data['img'] = $imagePath;
//         }

  


//         $data = $request->validate([
//             'name' => 'required|string|max:255',
//             'category_id' => 'required|int',
//             'user_id' => 'int',
//             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Подходящие расширения изображения
//         ]);

//         if ($request->hasFile('img')) {
//             $imagePath = $request->file('img')->store('images', 'public');
//             $data['img'] = $imagePath;
//         }
    
//         Test::create($data);

//         return redirect()->route('test.index')->with('success', 'Тест успешно создан.');
//     }
    
// }
public function create()
{
    $categories = Category::all();
    return view('test.create', compact('categories'));
}

public function uploadImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Правила валидации для изображения
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image'); // Получаем файл из запроса

        $filePath = 'images/' . $file->getClientOriginalName(); // Определите путь файла

        // Storage::disk('public')->put($filePath, file_get_contents($file)); // Сохраняем файл
        

        return redirect()->back()->with('success', 'Изображение успешно загружено.');
    }

    return redirect()->back()->with('error', 'Ошибка при загрузке изображения.');
}





public function store(Request $request)
{
  
    $user = auth()->user();
    $image = $request->file('img');
    $user_id = $request->input('user_id');
    
    if (!$user_id) {
        return back()->withInput()->with('error', 'User ID is missing.');
    }

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|int',
        'user_id' => 'int',
        'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'questions' => 'array',
    ]);

    if ($request->hasFile('img')) {
        $imagePath = $request->file('img')->store('images', 'public');
        $data['img'] = $imagePath;
    }

    $test = Test::create($data);

    foreach ($request->questions as $questionData) {
        $question = new Question([
            'test_id' => $test->id,
            'question' => $questionData['question'],
            'answer_1' => $questionData['answer_1'],
            'answer_2' => $questionData['answer_2'],
            'answer_3' => $questionData['answer_3'],
            'answer_4' => $questionData['answer_4'],
            'correct_answer' => $questionData['correct_answer'],
        ]);

        $question->save();
    }

    return redirect()->route('test.index')->with('success', 'Тест успешно создан.');
}
}