<?php

namespace controllers;

use Exception;
use models\Hikes;
use models\Users;
use PHPMailer\PHPMailer\PHPMailer;

class AuthController
{

    private Users $User;
    private Hikes $hikes;

    public function __construct(){
        $this->User = new Users();
        $this->hikes = new Hikes();
        session_start();
    }

    public function register(){

        if (empty($_POST)) {

            include 'views/inc/header.view.php';
            include 'views/register.view.php';
            include 'views/inc/footer.view.php';

        }else {

            try {

                if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['nickname']) || empty($_POST['email']) || empty($_POST['password'])) {
                    throw new Exception('Formulaire non complet');
                }

                //$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                $firstname = htmlspecialchars($_POST['firstname']);
                $lastname = htmlspecialchars($_POST['lastname']);
                $nickname = htmlspecialchars($_POST['nickname']);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $this->User->add($firstname,$lastname,$nickname, $email, $passwordHash);

                $_SESSION['user'] = [
                    'id' => $this->User->lastInsertId(),
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'nickname' => $nickname,
                    'email' => $email,
                    'isAdmin' => false
                ];

                try {

                    $this->sendMail($email,$nickname);

                } catch (\PHPMailer\PHPMailer\Exception $e) {
                    throw new Exception('Erreur dans l\'envoie du mail : '. $e->getMessage(),$e->getCode());
                }

                header('location: /');


            } catch (Exception $e) {
                header('location: ');
//                throw new Exception($e->getMessage());
            }


        }

    }

    public function login(){

        if (empty($_POST)) {

            include 'views/inc/header.view.php';
            include 'views/login.view.php';
            include 'views/inc/footer.view.php';

        }else {

            try {

                if (empty($_POST['nickname'])  || empty($_POST['password'])) {
                    throw new Exception('Formulaire non complet');
                }

                $nickname = htmlspecialchars($_POST['nickname']);

                $user = $this->User->get($nickname);


                if (password_verify($_POST['password'], $user['password'])) {

                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'firstname' => $user['firstname'],
                        'lastname' => $user['lastname'],
                        'nickname' => $user['nickname'],
                        'email' => $user['email'],
                        'isAdmin' => $user['isAdmin']
                    ];

                    header('location: /');

                } else {
                    // Gérer le cas où l'utilisateur n'est pas trouvé ou l'authentification échoue
                    header('location: login?m=le%20compte%20n%27existe%20pas&color=red');
                }


            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }

    }

    public function profile(){

        if (!empty($_SESSION['user'])) {
            $id = $_SESSION['user']['id'];
            $tagsIndex=$this->hikes->getListTags();

            if($_SESSION['user']['isAdmin']){
                $users = $this->User->getAll();
                $tags = $this->hikes->getAllTags();

                if(isset($_GET['supUser'])){
                    $this->User->remove($_GET['supUser']);
                    header('location: /profile');
                }

                if(isset($_GET['supTag'])){
                    $this->hikes->removeTag($_GET['supTag']);
                    header('location: /profile');
                }

            }

            $favHikes = $this->hikes->getFavHikes($id);
            $hikesCreated = $this->hikes->getHikesCreated($id);
            $hikes = $this->hikes->getListHikes();
            $tagsIndex = $this->hikes->getListTags();

            include 'views/inc/header.view.php';
            include 'views/profile.view.php';
            include 'views/inc/footer.view.php';



            if(!empty($_POST) && $_POST['action'] == 'Update') {
                if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['nickname']) && !empty($_POST['email']) && !empty($_POST['password'])) {

                    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $this->User->modify($id,$_POST['firstname'], $_POST['lastname'], $_POST['nickname'], $_POST['email'], $passwordHash);

                    if($_POST['email'] != $_SESSION['user']['email']){
                        try {
                            $this->sendMail($_POST['email'],$_POST['nickname']);
                        } catch (\PHPMailer\PHPMailer\Exception $e) {
                            throw new Exception('Erreur dans l\'envoie du mail : ' . $e->getMessage(), $e->getCode());
                        }
                    }

                    $_SESSION['user'] = [
                        'id' => $id,
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'nickname' => $_POST['nickname'],
                        'email' => $_POST['email']
                    ];
                    header("location: /profile");


                } else {
                    throw new Exception("un ou plusieurs champs sont vides", 500);
                }
            }
            if(!empty($_POST)) {
                if ($_POST['action'] == 'Delete') {
                   $this->User->remove($_SESSION['user']['id']);
                   $this->logout();
                   header("location: /");
                }
            }

        }else{
            header('Location: /login');
        }

    }

    public function logout(){
        session_destroy();
        header('Location: /');
    }

    /**
     * @param $mailTo string mail du destianataire
     * @param $nickname string nom du destinataire
     * @return void
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendMail(string $mailTo, string $nickname): void
    {

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = getenv('SMTP_HOST'); //smtp.gmail.com pour gmail
            $mail->SMTPAuth = true;
            $mail->Username = getenv('SMTP_USERNAME');// le mail qui envoie
            $mail->Password = getenv('SMTP_PASSWORD'); // ! Pas le mdp du compte (voir config gmail).
            $mail->Port = getenv('SMTP_PORT'); //587 pour tls
            $mail->SMTPSecure = 'tls';
            // Destinataire et contenu de l'e-mail
            $mail->setFrom('thehikingprojectbecode@gmail.com', 'The Hiking Project');
            $mail->addAddress($mailTo,$nickname);// le mail qui reçois
            $mail->Subject = 'Confirmation modification de l\'adresse mail';
            $mail->Body = 'Votre adresse mail a bien été modifier';
            $mail->send();


    }

}