<?php

namespace Php\Project\Games\Progression;

use function Php\Project\Engine\startGame;

function generateProgression(int $length, int $start, int $step)
{
    $result = [];

    for ($i = 0; $i < $length; $i += 1) {
        $result[] = $start + $i * $step;
    }

    return $result;
}

function run()
{
    $description = 'What number is missing in the progression?';

    $getQuestion = function () {
        $progression = generateProgression(rand(5, 10), rand(1, 10), rand(1, 10));
        $index = rand(0, count($progression) - 1);
        $progression[$index] = '..';
        return $progression;
    };

    $getTextQuestion = fn(array $progression) => implode(' ', $progression);

    $getAnswer = function (array $progression) {
        $index = (int) array_search('..', $progression, true);

        if ($index < 2) {
            $answer = $progression[$index + 1] - ($progression[$index + 2] - $progression[$index + 1]);
        } elseif ($index < count($progression) - 2) {
            $answer = $progression[$index - 1] + ($progression[$index + 2] - $progression[$index + 1]);
        } else {
            $answer = $progression[$index - 1] - ($progression[$index - 2] - $progression[$index - 1]);
        }

        return (string) $answer;
    };

    startGame($description, $getQuestion, $getAnswer, $getTextQuestion);
}
