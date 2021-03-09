<?php
session_start();
include_once 'dbConnection.php';
$qid = $_POST["qid"];

$quest_query = mysqli_query($con, "SELECT * FROM questions WHERE qid='$qid'") or die('Error157');
$quest_data = [];
while ($row = $quest_query->fetch_assoc()) {
    $quest_data[] = $row;
}

$html = '';

// echo print_r($quest_data) . "Templear";

$html = $html . '<div class="quest-text">' . $quest_data[0]['qns'] . '</div>';

$html = $html . '<div class="options">';

$opts_query = mysqli_query($con, "SELECT qtype, option, optionid FROM options WHERE qid='$qid'") or die('Error158');

$options_data = [];
while ($row = $opts_query->fetch_assoc()) {
    $options_data[] = $row;
}

echo print_r($options_data);

if ($options_data[0]['qtype'] == 'trfl' || $options_data[0]['qtype'] == 'closed') {
    for ($i = 0; $i < count($options_data); $i++) {
        $html = $html .  '<input type="radio" id="' . $qid . '" name="' . $qid . '" value="' . $options_data[$i]['optionid'] . '">' . $options_data[$i]['option'] . '</input>';
    }
} elseif ($options_data[0]['qtype'] == 'trfl') {
}

$html = $html . '</div>';

$actual = array_search($qid, $_SESSION["questions"]);

echo "Estas en la pregunta " . $actual;
$html = $html . '<div class="botonera">';

if ($actual < count($_SESSION["questions"]) - 1) {
    if ($actual == 0) {
        $html = $html . '<button type="submit" id="nextQ" name="nextQ" onclick="fetchQuest(\'' . $_SESSION["questions"][$actual + 1] . '\')">Siguiente</button>';
    } else {
        $html = $html .  '<button type="submit" id="prevQ" name="prevQ" onclick="fetchQuest(\'' . $_SESSION["questions"][$actual - 1] . '\')">Anterior</button>';
        if (!($actual > count($_SESSION["questions"]) - 1)) {
            $html = $html . '<button type="submit" id="nextQ" name="nextQ" onclick="fetchQuest(\'' . $_SESSION["questions"][$actual + 1] . '\')">Siguiente</button>';
        }
    }
} else {
    $html = $html . '
    <button type="submit" id="prevQ" name="prevQ" onclick="fetchQuest(\'' . $_SESSION["questions"][$actual - 1] . '\')">Anterior</button>
    <button type="submit" id="finish" name="finish">Terminar</button>';
}
$html = $html . '</div>';

// guardar en storage

$_SESSION["current_question"] = $_SESSION["questions"][$actual];
echo $html;
