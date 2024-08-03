<?php

namespace Php\Project\Games\Calc;

use function Php\Project\Engine\startGame;

function run()
{
    $description = 'What is the result of the expression?';
    $getQuestion = fn() => [rand(1, 20), array_rand(array_flip(['+', '-', '*'])), rand(1, 20)];
    $getTextQuestion = fn(array $question) => implode(' ', $question);
    $getAnswer = function (array $question) {
        [$left, $sign, $right] = $question;
        switch ($sign) {
            case '+':
                return (string)($left + $right);
            case '-':
                return (string)($left - $right);
            case '*':
                return (string)($left * $right);
            default:
                return null;
        }
    };

    startGame($description, $getQuestion, $getAnswer, $getTextQuestion);
}
