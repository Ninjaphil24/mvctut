<div class="box">
    <form action="index.php" method="post">
        <div class="inputBox">
            <input type="text" id="first_name" name="first_name" required>
            <label for="first_name">First Name</label>
        </div>
        <div class="inputBox">
            <input type="text" id="last_name" name="last_name" required>
            <label for="last_name">Last Name</label>
        </div>
        <div class="inputBox">
            <input type="email" id="email" name="email" required>
            <label for="email">Email</label>
            <?php if (isset($error)) echo $error;?>
        </div>
        <div class="inputBox">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>