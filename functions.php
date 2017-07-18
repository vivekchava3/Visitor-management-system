<?php
function db_connect()
    {
       $servername = "mysql.hostinger.in"; //mysql Server Name
       $username = "u738003910_admin"; //mysql db user name
       $password = "BcvW0aUOvYum"; //mysql db password 
       $dbname='u738003910_vms'; //database name 

   // Create connection
        $conn = new mysqli($servername, $username, $password,$dbname);

        // Check connection
        if ($conn->connect_error) {
            throw new mysqli_sql_exception('Could not connect to Servers');
        }

       
        return $conn;
    }


function mail_send($message,$email)
    { /*
    //send an email to the officer regarding status 
        $to=$email; //officer's or visitor or any email address 
        $subject=""; // set the subject 
        $from='vms.esy.es';//can be the current web address 
        $headers = 'From:'.$from."\r\n"; // Set from headers
        $m=mail($to, $subject, $message, $headers); // Send email to the officer about the status with a message or cancellation etc. 
        return $m;
        */
    }

function sms_send($mesasage,$off)
{
  /*
  $contact=$off;
  //connect to an sms service and send the message and status .
  */
}

function blacklist($image,$subject_id)
{
  
  enroll($image,$subject_id);

}

// whenever security clicks blacklist button then this function is called, which enroll the photo into the api gallery 

function enroll($image,$subject_id){

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.kairos.com/enroll");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
    \"image\": \"$image\",
    \"gallery_name\": \"MyGallery\",
    \"subject_id\": \"$subject_id\"
  }");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "app_id: 3fe2e486",
  "app_key: a1fb65fd9d5472a68fac14432a352cde"
));

$response = curl_exec($ch);
curl_close($ch);

return $response;

}



function face_detect($image,$subject_id){
 
  

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://api.kairos.com/verify");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);

  curl_setopt($ch, CURLOPT_POST, TRUE);

 
  curl_setopt($ch, CURLOPT_POSTFIELDS, "{
    \"image\": \"$image\",
    \"gallery_name\": \"MyGallery\",
    \"subject_id\": \"$subject_id\"
  }");

  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "app_id: 3fe2e486",
    "app_key: a1fb65fd9d5472a68fac14432a352cde"
  ));

  $response = curl_exec($ch);
  curl_close($ch);

   return $response;
}




?>