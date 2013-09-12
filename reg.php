<?php
//Variablen deklarieren
$prename = $_POST['prename'];
$lastname = $_POST['lastname'];
$email = $_POST['mail'];
$password = $_POST['password'];
if($prename != "" && $lastname !="" && $email != "" && $password != "")
{
    //†berprŸfen, ob Passwort und E-Mail Adressen Ÿberein stimmen
    if($email == $_POST['rmail'])
    {
            if($password == $_POST['rpassword'])
            {
                //†berprŸfen ob Name korrekt
                $zeichen = "!&$%()/\?=1234567890{}[]<>|,;:._^^^^+*#'";
                $pospn = strpos($prename, $zeichen);
                $posln = strpos($lastname, $zeichen);
                if($pospn === false && $posln === false)
                {
                        //†berprŸfen ob E-Mail Korrekt
                        $posm1 = strpos($email, "@");
                        $posm2 = strpos($email, ".");
                        if($posm2 != "" && $posm1 != "")
                        {
                            //Sicherheit
                            $prename = htmlspecialchars($prename);
                            $prename = mysql_real_escape_string($prename);
                            $prename = htmlentities($prename);
                            $lastname = htmlspecialchars($lastname);
                            $lastname = mysql_real_escape_string($lastname);
                            $lastname = htmlentities($lastname);
                            $email = htmlspecialchars($email);
                            $email = mysql_real_escape_string($email);
                            $email = htmlentities($email);
                            $password = md5($password);
                            //Verbindung mit Datenbank
                            mysql_connect("localhost", "root", "") or die("Fehler bei der Verbindung mit der Datenbank.");
                            mysql_select_db("netorial");
                            //†berprŸfen, ob E-Mail schon vorhanden
                            $selectEMail = mysql_query("SELECT * FROM user WHERE email = '{$email}'");
                            if(mysql_num_rows($selectEMail) == 0)
                            {
                                $insertDate = mysql_query("INSERT INTO  user VALUES ('' ,  '{$prename}',  '{$lastname}',  '{$email}',  '{$password}')");
								$selctLastID = mysql_query("SELECT id FROM user ORDER BY id DESC LIMIT 1");
								$LastId = mysql_fetch_assoc($selctLastID);
								$lID = $LastId['id'];
								$createProfile = mysql_query("INSERT INTO  profile (id ,administraedFrom ,type ,profileName )VALUES ('',  '{$lID}',  '1',  '{$prename} {$lastname}')");
                            }
                            else
                            {
                                    $output = "Diese E-Mail Adresse wurde bereits verwendet.";
                            }
                        }
                        else
                        {
                                $output = "E-Mail Adreese nicht korrekt";
                        }
                }
                else
                {
                        $output = "Ihr Name kann nicht korrekt sein. Bitte &auml;ndern sie diesen.";
                }
            }
            else
            {
                    $output = "Die E-Mail Adrssen stimmen nicht &uuml;berein.";
            }
    }
    else
    {
            $output = "Die E-Mail Adrssen stimmen nicht &uuml;berein.";
    }
}
else
{
        $output = "Bitte f&uuml;llen Sie alle Felder aus.";
}

echo $output;
?>