<?php
if (!isset($_POST['submit'])) {
    //This page should not be accessed directly. Need to submit the form.
    echo "error; you need to submit the form!";
}
$name= $_POST['name'];
$nemail= $_POST['email'];
$typeOfBusiness= $_POST['typeOfBusiness'];
$averageMonthly = $_POST['averageMonthly'];
$tellUsMore1 = $_POST['tell-us-more1'];
$tellUsMore2 = $_POST['tell-us-more2'];

//Validate first
if (empty($name) || empty($nemail)) {
    echo "Name and email are mandatory!";
    exit;
}

if (IsInjected($nemail)) {
    echo "Bad email value!";
    exit; 
}

$email_from = 'info@go4profits.us'; //<== update the email address
$email_subject = "New Form submission";
$email_body = "You have received a new message from the website go4profits.us \n\n\n
Name: $name \n
Email:  $nemail\n
Type of Business: $typeOfBusiness \n
Average number of monthly transactions:      $averageMonthly  \n
Tell us more about your accounting needs:    $tellUsMore1 \n
Tell us any other questions, concerns, or special needs that you have  $tellUsMore2 \n\n\n  " .

$to = "ainurbookkeeper@gmail.com"; //<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $nemail \r\n";
//Send the email!
mail($to, $email_subject, $email_body, $headers);
//done. redirect to thank-you page.
header('Location: index.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
    $injections = array(
        '(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)'
    );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if (preg_match($inject, $str)) {
        return true;
    } else {
        return false;
    }
}
