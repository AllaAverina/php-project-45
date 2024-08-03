<?php

namespace Php\Project\Engine;

use function cli\line;
use function cli\prompt;

function startGame(string $description, callable $getQuestion, callable $getExpected, callable $getTextQuestion = null)
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, $name!");
    line($description);

    $result = (run($getQuestion, $getExpected, $getTextQuestion)) ? "Congratulations, $name!" : "Let's try again, $name!";
    line($result);
}

function run(callable $getQuestion, callable $getExpected, callable|null $getTextQuestion)
{
    $round = 0;
    $maxRounds = 3;

    for (; $round < $maxRounds; $round += 1) {
        $question = $getQuestion();
        $textQuestion = (is_null($getTextQuestion)) ? $question : $getTextQuestion($question);
        line("Question: $textQuestion");

        $expected = $getExpected($question);
        $answer = prompt('Your answer');

        if ($expected !== $answer) {
            line("'$answer' is wrong answer ;(. Correct answer was '$expected'.");
            break;
        }

        line('Correct!');
    }

    return ($round === $maxRounds);
}
