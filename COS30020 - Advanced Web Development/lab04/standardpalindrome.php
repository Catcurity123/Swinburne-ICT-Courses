
<?php
//Function to check for Palindrome
function isPalindrome($str)
{
    //Input validation
    if (!is_string($str) || strlen(trim($str)) < 2) {
        return '<span style="color:red;">The text you entered is invalid</span>';
    }

    //Input sanitizing, erase non-digit, non-letter and convert it to lowercase
    $cleanStr = preg_replace('/[^A-Za-z0-9\,\']/', '', strtolower($str));
    $isPalindrome = true;
    $len = strlen($cleanStr);

    //Loop half of the length as palindrome is the same from the other half
    for ($i = 0; $i < $len / 2; $i++) {
        //Take the first letter in the first half
        $initialString = substr($cleanStr, $i, 1);
        //Take the last letter in the second half
        $backwardString = substr($cleanStr, $len - $i - 1, 1);
        //If they are not the same then it is not a palindrome
        if ($initialString !== $backwardString) {
            $isPalindrome = false;
            break;
        }
    }

    //Ternary operator to create text
    $text = $isPalindrome
        ? '<span style="color:green;">The text you entered "' . $str . '" is a palindrome</span>'
        : '<span style="color:red;">The text you entered "' . $str . '" is not a palindrome</span>';

    return $text;
}

//This part is for a single word in the textbox
if (isset($_POST['strinput'])) {
    echo isPalindrome($_POST['strinput']);
}
//This part is for the "automate" testcase
elseif (isset($_GET["test"]) && $_GET["test"] == 1) {
    $testCases = array(
        "<>",
        "....",
        "...",
        "A man, a plan, a canal: Panama!",
        "Madam, in Eden, I'm Adam",
        "Eva, can I see bees in a cave?",
        "Able was I ere I saw Elba",
        "Deified, a lonesome era's selfless I, Ned",
        "上海自来水来自海上",
        "أبو بكر بورقيبة",
        "ΝΙΨΟΝΑΝΟΜΗΜΑΤΑΜΗΜΟΝΑΝΟΨΙΝ",
        "1a11a1",
        "!@#$%^^&%$#@!",
        "Was it a car or a cat I saw?!",
        "Was it a cat I saw?",
        "Was it a car I saw?"
    );

    foreach ($testCases as $str) {
        echo isPalindrome($str) . '<br>';
    }
}
?>
