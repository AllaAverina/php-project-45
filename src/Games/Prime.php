<?php

namespace Php\Project\Games\Prime;

use function Php\Project\Engine\startGame;

function isPrime(int $number)
{
    if ($number <= 1) {
        return false;
    }

    for ($i = 2; $i <= sqrt($number); $i += 1) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true;
}

function run()
{
    $description = 'Answer "yes" if given number is prime. Otherwise answer "no".';
    $getQuestion = fn() => rand(1, 100);
    $getAnswer = fn(int $number) => isPrime($number) ? 'yes' : 'no';

    startGame($description, $getQuestion, $getAnswer);
}
