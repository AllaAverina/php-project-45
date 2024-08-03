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

    $getQuestion = function() {
        $progression = generateProgression(rand(5, 10), rand(1, 10), rand(1, 10));
        $hiddenIndex = rand(0, count($progression) - 1);
        $progression[$hiddenIndex] = '..';
        return $progression;
    };

    $getTextQuestion = fn(array $progression) => implode(' ', $progression);

    $getAnswer = function(array $progression) {
        $hiddenIndex = array_search('..', $progression);

        if ($hiddenIndex < 2) {
            $answer = $progression[$hiddenIndex + 1] - ($progression[$hiddenIndex + 2] - $progression[$hiddenIndex + 1]);
        } elseif ($hiddenIndex < count($progression) - 2) {
            $answer = $progression[$hiddenIndex - 1] + ($progression[$hiddenIndex + 2] - $progression[$hiddenIndex + 1]);
        } else {
            $answer = $progression[$hiddenIndex - 1] - ($progression[$hiddenIndex - 2] - $progression[$hiddenIndex - 1]);
        }

        return (string) $answer;
    };
    
    startGame($description, $getQuestion, $getAnswer, $getTextQuestion);
}
