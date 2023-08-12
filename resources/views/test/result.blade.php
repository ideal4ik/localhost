<body class="background-color">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="result-blank">
<h3 class="question_name_backround">Вопросы на которые вы ответили правильно подсвечены зеленым</h3>
@foreach ($questions as $question)
    <li class="test_question {{ $correctAnswers[$question->id] ? 'correct-answer' : '' }}">
        <h3 class="">{{ $question->question }}</h3>Правильный ответ: 
        {{ $question->correct_answer }}
        <!-- <p class="{{ $correctAnswers[$question->id] ? 'correct-answer' : '' }}">1: {{ $question->answer_1 }}</p>
        <p class="{{ $correctAnswers[$question->id] ? 'correct-answer' : '' }}">2: {{ $question->answer_2 }}</p>
        <p class="{{ $correctAnswers[$question->id] ? 'correct-answer' : '' }}">3: {{ $question->answer_3 }}</p>
        <p class="{{ $correctAnswers[$question->id] ? 'correct-answer' : '' }}">4: {{ $question->answer_4 }}</p> -->
    </li>
@endforeach
<h3>Ваш результат {{ $totalScore }} / {{ $questions->count() }} что составляет {{ round(($totalScore / $questions->count()) * 100, 2) }}%</h3>
<a class="back_result" href="#" onclick="goBack()">Перепройти тест</a>
<a class="exit_result" href="/dashboard">Вернуться на главную страницу</a>
</div>
</body>


<script>
function goBack() {
    window.history.back();
}
</script>