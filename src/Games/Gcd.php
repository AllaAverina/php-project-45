<?php

namespace Php\Project\Games\Gcd;

use function Php\Project\Engine\startGame;

function gcd(int $left, int $right)
{
    return ($right > 0) ? gcd($right, $left % $right) : $left;
}

function run()
{
    $description = 'Find the greatest common divisor of given numbers.';
    $getQuestion = fn() => [rand(1, 100), rand(1, 100)];
    $getTextQuestion = fn(array $question) => implode(' ', $question);
    $getAnswer = fn(array $question) => (string)gcd(...$question);

    startGame($description, $getQuestion, $getAnswer, $getTextQuestion);
}
