<?php

namespace Php\Project\Games\Even;

use function Php\Project\Engine\startGame;

function isEven(int $number)
{
    return $number % 2 === 0;
}

function run()
{
    $description = 'Answer "yes" if the number is even, otherwise answer "no".';
    $getQuestion = fn() => rand(1, 100);
    $getAnswer = fn(int $number) => isEven($number) ? 'yes' : 'no';

    startGame($description, $getQuestion, $getAnswer);
}
