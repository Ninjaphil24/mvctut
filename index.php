<?php
require "vendor/autoload.php";

use RouterSpace\Routes;

require_once('env.php');
require_once('mysqlconnect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/index.css">
    <title>Vanilla Form</title>
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(function(OneSignal) {
            OneSignal.init({
                appId: "f06ab8e3-2ebd-4be5-9400-7326cf760973",
            });
        });
    </script>
</head>

<body>
    <?php
    $router = new Routes;
    $router->dispatch();
    ?>
    <select id="bgcolorpick">
        <option value="">Original</option>
        <option value="red">Red</option>
        <option value="green">Green</option>
        <option value="purple">Purple</option>
    </select>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.body.style.backgroundColor = localStorage.getItem("bgcolor")
            document.getElementById('bgcolorpick').value = localStorage.getItem('bgcolor')
        })
        document.getElementById('bgcolorpick').addEventListener('change', function() {
            var color = document.getElementById("bgcolorpick").value
            localStorage.setItem("bgcolor", color)
            document.body.style.backgroundColor = this.value
        })
    </script>
</body>

</html>