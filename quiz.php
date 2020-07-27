<?php /* Template Name: Quiz */ get_header(); ?>

<?php

define('WP_USE_THEMES', false);
require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

//JSON encode 
$quiz = new Quiz();
$quiz->selectById(1);

$questions = $wpdb->get_results( "SELECT * FROM question WHERE id_quiz=$quiz->getId()");
$quizArray = [];

    $quiz = array(
        $quizArray['id'] => $quiz->getId(),
        $quizArray['name'] => $quiz->getName(),
        $quizArray['tag_id'] => $quiz->getTagId(),
        $quizArray['img'] => $quiz->getImgPath(),
    );
    foreach($questions as $q){
        $question = array(  
            "id" => $q->id,
            "id_quiz" => $q->id_quiz,
            "content" => $q->content,
            "img_path" => $q->img_path,
            "url" => $q->url,
            "points" => $q->points,
        );
        
        $answers = $wpdb->get_results( "SELECT * FROM answer where id_question=$q->id" );
        foreach($answers as $a){
            $answer = array(
                'id' => $a->id,
                'id_question' => $a->id_question,
                'content' => $a->content,
                'is_true' => $a->is_true,
            );
            $question['answers'][] = $answer;
        }
        $quiz['questions'][] = $question;
    }


echo json_encode($quizArray);





?>

<?php get_footer()?>