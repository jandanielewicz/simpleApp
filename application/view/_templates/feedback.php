<?php

// get the feedback
$feedback_ok = Session::get('feedback_ok');
$feedback_fail = Session::get('feedback_fail');

// echo success messages
if (isset($feedback_ok)) {
    foreach ($feedback_ok as $feedback) {
        echo '<div class="feedback success">' . $feedback . '</div>';
    }
}

// echo fail messages
if (isset($feedback_fail)) {
    foreach ($feedback_fail as $feedback) {
        echo '<div class="feedback error">' . $feedback . '</div>';
    }
}
