<?php
define('WP_USE_THEMES', false);
global $wpdb;
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}
function delTree($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
}

$error = "Veuillez remplir tous les champs";

if(!empty($_POST['first_mail']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['id_user']) && !empty($_POST['location']))
{
    global $wpdb;

    $imgPath = $_FILES['avatar'];
    $mail = $_POST['first_mail'];
    $name = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $idUser = $_POST['id_user'];
    $location = $_POST['location'];

    $id = $_SESSION['userConnected'];

    $error = '';
    if($_FILES['avatar']['error'] != UPLOAD_ERR_NO_FILE && !empty($_FILES['avatar']))
    {
        // //créer dossier image au nom de l'id de l'User
        // $directoryName = $r->id;
        // mkdir(public_path(home_url().'img/avatar/').$directoryName, 0775);
        //upload image
        $content_dir_plug =  get_template_directory().'/img/avatar/';
        $content_dir = wp_upload_dir()['basedir']."/avatars/".$id."/";
        $tmp_file = $_FILES['avatar']['tmp_name'];
        delTree($content_dir);
        if(!is_dir($content_dir))
        {
            mkdir($content_dir, 0755, true);
        }

        if(!is_dir($content_dir_plug))
        {
            mkdir($content_dir_plug, 0755, true);
        }

        if(!is_uploaded_file($tmp_file))
        {
            $error="Le fichier est introuvable";
        }
        $type_file = $_FILES['avatar']['type'];

        if( !strpos($type_file, 'jpg') && !strpos($type_file, 'jpeg') && !strpos($type_file, 'png'))
        {
            $error="Le format du fichier n'est pas pris en charge";
        }
        // on copie le fichier dans le dossier de destination
        $name_file = $id .'-bpfull.'.preg_replace("#image\/#","",$type_file);

        if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
        {
            $error = "Impossible de copier le fichier $name_file dans $content_dir";
        }

        $name_file_tb = $id .'-bpthumb.'.preg_replace("#image\/#","",$type_file);
        if( !copy($content_dir.$name_file, $content_dir.$name_file_tb) )
        {
            $error = "Impossible de copier le fichier $name_file dans $content_dir";
        }

        if( !copy($content_dir.$name_file, $content_dir_plug . $name_file) )
        {
            $error = "Impossible de copier le fichier $name_file dans $content_dir";
        }


        $imgPath = $name_file;

    }
    if( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $mail))
    {
        $error = "L'adresse mail n'est pas valide.";
    }
    if( !preg_match("#^[0-9]{1,6}$# ", $idUser))
    {
        $error = "Votre identifiant n'est pas correct";
    }

    if($error == "")
    {
        update_user_meta($id, 'id_alc', $idUser);
        update_user_meta($id, 'location', $location);
        update_user_meta($id, 'avatar', $imgPath);
        $userdata = array(
            'ID' => $_SESSION['userConnected'],
            'first_name' =>   $name,
            'last_name' =>   $lastName,
            'user_login' =>   esc_attr($mail),
            'user_email' =>   esc_attr($mail),
           );
           $user = wp_update_user( $userdata );

        $updateOk = "Modifications validées.";
    }
}

$_SESSION["updateOk"] = $updateOk;
$_SESSION["errorRegister"] = $error;

wp_redirect( home_url()."/profil" );

?>
