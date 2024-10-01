<?php
// Get the user's message from the input
$user_message = $_POST['message'];


if ($user_message == "question" || $user_message == "main menu") {
?>

    <span class='smart-options' onclick='sendMessageToChatbot(`What is a Bank Reconciliation System?`)'>What is a Bank Reconciliation System?</span>

    <span class='smart-options' onclick='sendMessageToChatbot(`Why is a Bank Reconciliation System important?`)'>Why is a Bank Reconciliation System important?</span>

    <span class='smart-options' onclick='sendMessageToChatbot(`How does a Bank Reconciliation System work?`)'>How does a Bank Reconciliation System work?</span>

    <span class='smart-options' onclick='sendMessageToChatbot(`What are the key features of a Bank Reconciliation System?`)'>
        What are the key features of a Bank Reconciliation System?</span>

    <span class='smart-options' onclick='sendMessageToChatbot(`What are the benefits of using a Bank Reconciliation System?`)'>What are the benefits of using a Bank Reconciliation System?</span>

    <span class='smart-options' onclick='sendMessageToChatbot(`Is a Bank Reconciliation System suitable for my organization?`)'>
        Is a Bank Reconciliation System suitable for my organization?</span>

    <span class='smart-options' onclick='sendMessageToChatbot(`How do I choose the right Bank Reconciliation System for my organization?`)'>
        How do I choose the right Bank Reconciliation System for my organization?</span>

    <span class='smart-options' onclick='sendMessageToChatbot(`Is training required to use a Bank Reconciliation System?`)'>
        Is training required to use a Bank Reconciliation System?</span>



<?php

    exit;
}

// Define some sample responses
$responses = array(
    "hi" => "<p class='right'>Hello! How can I assist you?</p>",
    "how are you?" => "I'm just a savvy bot, but I'm functioning well. Thanks for asking!",
    "What is a Bank Reconciliation System?" => "A Bank Reconciliation System is a software tool that helps organizations compare their internal financial records with the records provided by their bank to ensure that they match. It helps identify and rectify any discrepancies between the two sets of records.",

    "Why is a Bank Reconciliation System important?" => "
    <ul>
    <p>A Bank Reconciliation System is important because it helps organizations:</p>
      <li>Ensure accuracy: Identifies errors or discrepancies in financial records.</li>
      <li>Prevent fraud: Helps detect unauthorized transactions or fraudulent activities</li>
      <li>Improve financial control: Ensures that all transactions are properly recorded and accounted for.</li>
      <li>Save time: Automates the reconciliation process, saving time compared to manual reconciliation.</li>
    </ul>",


    "How does a Bank Reconciliation System work?" =>
    "A Bank Reconciliation System works by comparing the transactions recorded in an organization's accounting system with the transactions reported by the bank. It identifies any differences between the two sets of records and allows users to investigate and resolve these differences.",


    "What are the key features of a Bank Reconciliation System?" =>
    "<ul>
    <p>Key features of a Bank Reconciliation System may include:</p>
      <li>Automated reconciliation: Matches transactions between the bank statement and internal records automatically.</li>
      <li>Exception handling: Flags and investigates transactions that do not match.</li>
      <li>Reporting: Generates reports on reconciliation status and outstanding items.</li>
      <li>Integration: Integrates with accounting software and bank systems for seamless data exchange.</li>
    </ul>",


    "What are the benefits of using a Bank Reconciliation System?" =>
    "<ul>
    <p>Some benefits of using a Bank Reconciliation System include:</p>
      <li>Improved accuracy: Reduces the risk of errors in financial reporting.</li>
      <li>Increased efficiency: Automates the reconciliation process, saving time and effort.</li>
      <li>Enhanced financial control: Helps identify and prevent fraudulent activities.</li>
      <li>Better decision-making: Provides accurate and up-to-date financial information.</li>
    </ul>",

    "Is a Bank Reconciliation System suitable for my organization?" =>
    "A Bank Reconciliation System is suitable for organizations of all sizes and industries that need to reconcile their financial records with bank statements. Whether you are a small business or a large corporation, a Bank Reconciliation System can help streamline your reconciliation process and improve accuracy.",

    "How do I choose the right Bank Reconciliation System for my organization?" =>
    "When choosing a Bank Reconciliation System, consider factors such as your organization's size, complexity, budget, and specific requirements. It's also important to evaluate the system's ease of use, integration capabilities, and support options.",


    "Is training required to use a Bank Reconciliation System?" =>
    "While many Bank Reconciliation Systems are user-friendly, some level of training may be beneficial to fully utilize all features. Many vendors offer training resources such as tutorials, webinars, and customer support.",


    "bye" => "Goodbye! Have a great day!"
);

//echo $responses["What is a Compliance Management System (CMS)?"];

// Convert the user's message to lowercase for case-insensitive comparison

if (empty($user_message)) {
    //    $user_message = strtolower($user_message);
}
// Check if the user's message matches any predefined responses
if (array_key_exists($user_message, $responses)) {
    $bot_response = $responses[$user_message];
} else {
    $bot_response = "I'm sorry, I don't understand that.";
}

// Output the bot's response
echo "<p><b>Savvy Bot:</b> " . $bot_response . "</p>";
?>
<span class='smart-options' onclick='sendMessageToChatbot(`main menu`)'>main menu</span>