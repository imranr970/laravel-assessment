<?php

$word = "hello";

function change_word($word) {
    $word = "World";
}

change_word($word);

echo $word;