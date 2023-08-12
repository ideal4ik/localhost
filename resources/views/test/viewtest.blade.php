<link rel="stylesheet" href="/public/css/style.css">
<h1>{{ $test->name }}</h1>

<form action=" route('test.save-result') " method="post">
<input type="hidden" name="test_id" value="{{ $test->id }}">
    @csrf
    @foreach ($questions as $question)
        <li class="test_question">
            <h3>{{ $question->question }}</h3>
            <p>1: <input  type="radio" name="question_{{ $question->id }}" value="{{ $question->answer_1 }}" >{{ $question->answer_1 }}</p>
            <p>2: <input  type="radio" name="question_{{ $question->id }}" value="{{ $question->answer_2 }}" >{{ $question->answer_2 }}</p>
            <p>3: <input  type="radio" name="question_{{ $question->id }}" value="{{ $question->answer_3 }}" >{{ $question->answer_3 }}</p>
            <p>4: <input  type="radio" name="question_{{ $question->id }}" value="{{ $question->answer_4 }}" >{{ $question->answer_4 }}</p>
        </li>
    @endforeach
    
    <input type="submit" value="Узнать свой результат">
</form>

