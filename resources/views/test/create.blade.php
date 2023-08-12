<!-- tests/create.blade.php -->
<!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <h1>Создание нового теста</h1>

    <form action="{{ route('test.store') }}" method="post" class="testcreate">
        @csrf
        <label for="name">Название теста:</label>
        <input type="text" id="name" name="name" required>

        <button type="submit">Создать</button>
    </form> -->
    <body class="background-color">
        
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <div class="create-blank">
    <form action="{{ route('test.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="mb-3">
            <label for="name" class="form-label">Название теста:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Категория:</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value=""></option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4 form-label">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2 ">Выберите изображение:</label>
            <input type="file" name="img" id="img">
        </div>
        
        <div id="questions">
            <div class="mb-3 question">
                <label for="question" class="form-label">Вопрос</label>
                <input type="text" class="form-control" id="question" name="questions[0][question]">
                <div class="mb-3">
                    <label for="answer_1" class="form-label">Вариант ответа 1:</label>
                    <input type="text" class="form-control" id="answer_1" name="questions[0][answer_1]">
                </div>
                <div class="mb-3">
                    <label for="answer_2" class="form-label">Вариант ответа 2:</label>
                    <input type="text" class="form-control" id="answer_2" name="questions[0][answer_2]">
                </div>
                <div class="mb-3">
                    <label for="answer_3" class="form-label">Вариант ответа 3:</label>
                    <input type="text" class="form-control" id="answer_3" name="questions[0][answer_3]">
                </div>
                <div class="mb-3">
                    <label for="answer_4" class="form-label">Вариант ответа 4:</label>
                    <input type="text" class="form-control" id="answer_4" name="questions[0][answer_4]">
                </div>
                <div class="mb-3">
                    <label for="correct_answer" class="form-label">Правильный ответ:</label>
                    <select class="form-select" id="correct_answer" name="questions[0][correct_answer]">
                        <option value="1">Вариант ответа 1</option>
                        <option value="2">Вариант ответа 2</option>
                        <option value="3">Вариант ответа 3</option>
                        <option value="4">Вариант ответа 4</option>
                    </select>
                </div>
            </div>
        </div>
        
        <button type="button" id="add_question" class="btn btn-primary create-button">Добавить вопрос</button>
        <button type="submit" class="btn btn-success create-button" style="background-color: rgb(108, 213, 100);">Создать тест</button>
    </form>
</div>
</body>
<script>
    let questionCount = 1;
    
    document.getElementById('add_question').addEventListener('click', () => {
        const questionsDiv = document.getElementById('questions');
        const questionDiv = document.createElement('div');
        questionDiv.className = 'mb-3 question';
        questionDiv.innerHTML = `
            <label for="question_${questionCount}" class="form-label">Вопрос</label>
            <input type="text" class="form-control" id="question_${questionCount}" name="questions[${questionCount}][question]">
            <div class="mb-3">
                <label for="answer_1_${questionCount}" class="form-label">Вариант ответа 1</label>
                <input type="text" class="form-control" id="answer_1_${questionCount}" name="questions[${questionCount}][answer_1]">
            </div>
            <div class="mb-3">
                <label for="answer_2_${questionCount}" class="form-label">Вариант ответа 2</label>
                <input type="text" class="form-control" id="answer_2_${questionCount}" name="questions[${questionCount}][answer_2]">
            </div>
            <div class="mb-3">
                <label for="answer_3_${questionCount}" class="form-label">Вариант ответа 3</label>
                <input type="text" class="form-control" id="answer_3_${questionCount}" name="questions[${questionCount}][answer_3]">
            </div>
            <div class="mb-3">
                <label for="answer_4_${questionCount}" class="form-label">Вариант ответа 4</label>
                <input type="text" class="form-control" id="answer_4_${questionCount}" name="questions[${questionCount}][answer_4]">
            </div>
            <div class="mb-3">
                <label for="correct_answer_${questionCount}" class="form-label">Правильный ответ</label>
                <select class="form-select" id="correct_answer_${questionCount}" name="questions[${questionCount}][correct_answer]">
                    <option value="1">Вариант ответа 1</option>
                    <option value="2">Вариант ответа 2</option>
                    <option value="3">Вариант ответа 3</option>
                    <option value="4">Вариант ответа 4</option>
                </select>
            </div>
        `;
        questionsDiv.appendChild(questionDiv);
        questionCount++;
    });
</script>
