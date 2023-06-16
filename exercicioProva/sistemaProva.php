<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="testeSelecaoLoginPHP" />
    <meta name="author" content="floramarone" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Sistema de Prova</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</head>
<body>
 
<?php
$uid = $_POST['userid'];
$pw = $_POST['password'];
 
if($uid == 'floramarone' and $pw == 'password123')
{    
    session_start();
    $_SESSION['sid']=session_id();
    echo "Login efetuado.";
} 
?>
<div class="container">
    <!-- heading-->
    <br>
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Sistema de Prova</h2>
    <br>
    <!-- button -->
    <div class="text-center mt-4">
        <button id="submit" type="button" class="btn btn-outline-secondary" onclick="startExam();">Clique aqui para iniciar sua avaliação</button>
    </div>
</div>

<script>
function startExam() {
    // Define questoes e respostas
    var questions = [
        {
            question: "Pergunta 1",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0 
        },
        {
            question: "Pergunta 2",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0 
        },
        {
            question: "Pergunta 3",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0
        },
        {
            question: "Pergunta 4",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0
        },
        {
            question: "Pergunta 5",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0
        },
        {
            question: "Pergunta 6",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0
        },
        {
            question: "Pergunta 7",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0
        },
        {
            question: "Pergunta 8",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0
        },
        {
            question: "Pergunta 9",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0
        },
        {
            question: "Pergunta 10",
            options: [" 1", " 2", " 3", " 4", " 5"],
            answer: 0
        }
    ];

    // inicializa contadores de resposta
    var correctCount = 0;
    var wrongCount = 0;
    var wrongAnswers = [];

    //  HTML perguntas
    var questionContainer = document.getElementById("question-container");

    // mostra perguntas
    for (var i = 0; i < questions.length; i++) {
        var question = questions[i];

        // HTML para as perguntas
        var questionElement = document.createElement("div");
        var questionText = document.createElement("p");
        questionText.innerText = question.question;
        questionElement.appendChild(questionText);

        // HTML opções da pergunta
        var optionsList = document.createElement("ul");
        for (var j = 0; j < question.options.length; j++) {
            var option = question.options[j];
            var optionItem = document.createElement("li");
            var optionLabel = document.createElement("label");
            var optionRadio = document.createElement("input");
            optionRadio.type = "radio";
            optionRadio.name = "question" + i;
            optionRadio.value = j;
            optionLabel.appendChild(optionRadio);
            optionLabel.appendChild(document.createTextNode(option));
            optionItem.appendChild(optionLabel);
            optionsList.appendChild(optionItem);
        }
        questionElement.appendChild(optionsList);

        // adiciona questão no container
        questionContainer.appendChild(questionElement);
    }
    // referencia button e container para esconder
    var submitButton = document.getElementById("submit");
    var buttonContainer = submitButton.parentElement;

    // esconte button
    buttonContainer.style.display = "none";

    // cria submit button
    var submitButton = document.createElement("button");
    submitButton.type = "button";
    submitButton.className = "btn btn-outline-secondary";
    submitButton.innerText = "Submit";
    submitButton.onclick = function() {
        // itera cada pergunta
        for (var i = 0; i < questions.length; i++) {
            var question = questions[i];
            var selectedOption = document.querySelector('input[name="question' + i + '"]:checked');

            // Valida respostas selecionadas
            if (selectedOption) {
                var selectedAnswer = parseInt(selectedOption.value);
                if (selectedAnswer === question.answer) {
                    correctCount++;
                } else {
                    wrongCount++;
                    wrongAnswers.push({
                        question: question.question,
                        correctAnswer: question.options[question.answer],
                        userAnswer: question.options[selectedAnswer]
                    });
                }
            }
        }

        // exibe resultados
        var totalQuestions = questions.length;
        var score = (correctCount / totalQuestions) * 10;
        var resultMessage = "Você acertou " + correctCount + " questões e errou " + wrongCount + " questões.\n\n";
        if (score >= 7) {
            resultMessage += "Você foi aprovado com uma nota de " + score.toFixed(2) + "!";
        } else {
            resultMessage += "Você foi reprovado com uma nota de " + score.toFixed(2) + ".\n\nRespostas corretas:\n";
            
        }
        for (var j = 0; j < wrongAnswers.length; j++) {
                var wrongAnswer = wrongAnswers[j];
                resultMessage += "\nQuestão: " + wrongAnswer.question + "\nSua resposta: " + wrongAnswer.userAnswer + "\nResposta correta: " + wrongAnswer.correctAnswer + "\n";
            }
        alert(resultMessage);
    };

    // vincula button ao container
    questionContainer.appendChild(submitButton);
}
</script>


<div class="container" id="question-container"></div>

</body>
</html>
