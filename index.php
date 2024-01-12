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
<button onclick="saveColor()">Save Color</button>
<script>
document.addEventListener("DOMContentLoaded", ()=>
document.body.style.backgroundColor = localStorage.getItem("bgcolor")
)
function saveColor() {
var color = document.getElementById("bgcolorpick").value
localStorage.setItem("bgcolor",color)
document.body.style.backgroundColor = localStorage.getItem("bgcolor")
}

</script>
</body>

</html>