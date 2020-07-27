<?php
header('content-type:application/json');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

///récupération utilisateur
$user = $_SESSION["userConnected"];
$lastCheck = get_user_meta( $user, $key = 'notification', true );
//récupération valeur dernier check

//derniers quizs/modules/articles depuis cette date
$lastQuiz = $wpdb->get_results("SELECT id, name, tag_id, created_at FROM quiz WHERE created_at > '".$lastCheck."' ");

$lastModule = $wpdb->get_results("SELECT id, title, tag_id, created_at FROM module WHERE created_at > '".$lastCheck."' ");
$lastArticle = $wpdb->get_results("SELECT ID as pid, post_date, post_title, guid  FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' AND post_date > '".$lastCheck."' ");
//calcul nombre total
$nombre = count($lastModule) + count($lastArticle) + count($lastQuiz);
//return json

foreach ($lastQuiz as $q){
    $tag = new Tag();
    $tag->selectById($q->tag_id);
    $q->tag= $tag->getName();
}

foreach ($lastModule as $m){
    $tag = new Tag();
    $tag->selectById($m->tag_id);
    $m->tag= $tag->getName();
}

$notification['nombre'] = $nombre;

$notification['quiz'] = $lastQuiz;

$notification['module'] = $lastModule;

$notification['article'] = $lastArticle;


echo json_encode($notification);

?>