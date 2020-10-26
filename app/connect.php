<?php

define('WP_USE_THEMES', false);

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);

include($path.'wp-load.php');



if(!empty($_POST['mail']) && !empty($_POST['mdp'])){
    $test = wp_get_current_user();
    update_user_meta($user_id, 'test', $test);
    global $wpdb;

    $mail = $_POST['mail'];

    $password = $_POST['mdp'];

    $r = $wpdb->get_row("SELECT * FROM wp_users where user_email='".$mail."'");

   

    if($r == null || !wp_check_password($password, $r->user_pass)){

        $_SESSION['errorConnect'] = "L'adresse mail ou le mot de passe ne sont pas corrects";

        wp_redirect( home_url() );

    }else{

        $creds = array(

            'user_login'    => $r->user_login,

            'user_password' => $password,

            'remember'      => true

        );

        //validation admin front
        if((int)get_user_meta($r->ID, "status", true) === 1){
            $_SESSION['userConnected'] = $r->ID;
            $user = wp_signon( $creds, false );
            $uid = $r->ID;
            wp_set_current_user($uid);
            setcookie('user', json_encode([
                "userConnected" => $r->ID,
            ]), time() + 3600 * 24 * 30);
            wp_redirect( home_url().'/accueil' );

        }else{
            $_SESSION['errorConnect'] = "votre compte est en attente d'activation par un administrateur.".$r->ID."--".get_user_meta($r->ID, "status", true);

            wp_redirect( home_url() );
        }

    }

}else{

    $_SESSION['errorConnect'] = "veuillez remplir tous les champs";

    wp_redirect( home_url() );

}



?>