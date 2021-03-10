<?php
session_start();
$schoolnumber=$_SESSION['schoolnumber'];
include_once 'dbConnection.php';
$qid = $_POST["qid"];

$quest_query = mysqli_query($con, "SELECT * FROM questions WHERE qid='$qid'") or die('Error157');
$quest_data = [];
while ($row = $quest_query->fetch_assoc()) {
    $quest_data[] = $row;
}

$html = '';

//echo print_r($quest_data) . "Templear";
$html = '<form action="prueba.php?eid='.@$_GET['eid'].'&t='.@$_GET['t'].'&schnum='.$schoolnumber.'" method="POST">';

$html = $html .'<div class="quest-text">
                    <b>Pregunta &nbsp;'.$quest_data[0]['sn'].':</b> '.$quest_data[0]['qns'].'                        
                    <br />
                    <br />
                    <b>Tema: </b> '.$quest_data[0]['topic'].'
                    <br /><b>Subtema: </b> '.$quest_data[0]['subtopic'].'
                    <br /><b>Objetivo: </b> '.$quest_data[0]['objective'].'
                    <br /><b>Competencia: </b> '.$quest_data[0]['competence'].'<br />
                    <b>Valor: '.$quest_data[0]['qval'].' pts.</b><br><br />
                </div>';

$html = $html . '<div class="options">';

$opts_query = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid'") or die('Error158');

$options_data = [];
while ($row = $opts_query->fetch_assoc()) {
    $options_data[] = $row;
}

if ($options_data[0]['qtype'] == 'trfl' || $options_data[0]['qtype'] == 'closed') {
    for ($i = 0; $i < count($options_data); $i++) {
        $html = $html .  '<input type="radio" id="' . $options_data[$i]['optionid'] . '" name="' . $qid . '" value="' . $options_data[$i]['optionid'] . '">' . $options_data[$i]['option'] . '</input><br /><br />';
    }
} elseif ($options_data[0]['qtype'] == 'trfl') {
}

$html = $html . '</div>';

$actual = array_search($qid, $_SESSION["questions"]);

$html = $html . '<div class="botonera">';

if ($actual < count($_SESSION["questions"]) - 1) {
    if ($actual == 0) {
        $html = $html . '<button type="button" class="btn btn-default" id="nextQ" name="nextQ" onclick="fetchQuest(\'' . $_SESSION["questions"][$actual + 1] . '\')">Siguiente<span class = "glyphicon glyphicon-chevron-right"></ span></button>';
    } else {
        $html = $html .  '
        <button type="button" class="btn btn-default" id="prevQ" name="prevQ" onclick="fetchQuest(\'' . $_SESSION["questions"][$actual - 1] . '\')">
            <span class="glyphicon glyphicon-chevron-left"></span> Anterior
        </button> ';
        if (!($actual > count($_SESSION["questions"]) - 1)) {
            $html = $html . '<button type="button" class="btn btn-default" id="nextQ" name="nextQ" onclick="fetchQuest(\'' . $_SESSION["questions"][$actual + 1] . '\')">Siguiente<span class = "glyphicon glyphicon-chevron-right"></ span></button>';
        }
    }
} else {
    $html = $html . '
    <button type="button" class="btn btn-default" id="prevQ" name="prevQ" onclick="fetchQuest(\'' . $_SESSION["questions"][$actual - 1] . '\')">
        <span class="glyphicon glyphicon-chevron-left"></span> Anterior
    </button>
    <button type="submit" class="btn btn-default" id="finish" name="finish">Terminar <span class="glyphicon glyphicon-send"></span></button>';
}
$html = $html . '</div></form>';

// guardar en storage

$_SESSION["current_question"] = $_SESSION["questions"][$actual];

echo $html;
