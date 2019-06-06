<?php
if (! function_exists('mostUsedWords')) {
    //output the Nword most used words in a paragraph given
    function mostUsedWords(string $paragraph, int $nWords) {
        // Get all words in the paragraph
        $wordList = preg_split("/[^\p{L}]+/u", $paragraph, null, PREG_SPLIT_NO_EMPTY);
        $wordGroup = [];
        // Cluster words
        foreach ($wordList as $word) {
            $lowerCaseWord =  strtolower($word);
            if (isset($wordGroup[$lowerCaseWord])) {
                $wordGroup[$lowerCaseWord] += 1;
            }
            else {
                $wordGroup[$lowerCaseWord] = 1;
            }
        }
        //sort in descending order
        arsort($wordGroup);
        //Get nWords first  words in the sorting paragraph
        return array_slice(array_keys($wordGroup), 0, $nWords);
    }
}

if (! function_exists('getMaximumPrimeNumberOnIntegerElement')) {
    // Get the maximum prime number can be combined by the elements of a given positive integer 
    function getMaximumPrimeNumberOnIntegerElement(int $number) {
        $stringNumber = (string)$number;
        $subNumberList =  [];
        $numberLength  = strlen($stringNumber);
        //Get all the sub number
        for ($i=0; $i < $numberLength; $i++) {
            for ($j = $i + 1; $j < $numberLength; $j++) {
                array_push($subNumberList, substr($stringNumber, $i, $j));
            }
        }
        //Get maximum prime number
        $maxPrimeNumber = 0;
        foreach ($subNumberList as $item) {
            if  ($item > $maxPrimeNumber &&  checkPrimeNumber($item)) {
                $maxPrimeNumber =  $item;
            }
        }
        return  $maxPrimeNumber;
    }
}

if (! function_exists('checkPrimeNumber')) {
    // Check if a number is a prime number
    function checkPrimeNumber(int $number) {
        if ($number <= 1) {
            return false;
        }
        for ($i = 2; $i <= sqrt($number); $i++){ 
            if ($number % $i == 0) 
                return false; 
        }
        return true; 
    }
}