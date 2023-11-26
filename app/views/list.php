<a href="/" class="myButton">Home</a>
<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Click to User</th>
    </tr>
    <?php
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($uri == "/list") {
        print_r($rows);
        foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="singleuser?id=<?php echo $row['id']; ?>" class="myButton">Foreach</a></td>
                <td><a href="singleuserfa?id=<?php echo $row['id']; ?>" class="myButton">Fetch Assoc</a></td>
                <td><a href="singleuserfawc/<?php echo $row['id']; ?>" class="myButton">Wild Card</a></td>
            <?php }
    } else if ($uri == "/listfa") {
        print_r($result);
        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="singleuser?id=<?php echo $row['id']; ?>" class="myButton">Foreach</a></td>
                <td><a href="singleuserfa?id=<?php echo $row['id']; ?>" class="myButton">Fetch Assoc</a></td>
                <td><a href="singleuserfawc/<?php echo $row['id']; ?>" class="myButton">Wild Card</a></td>
            <?php }
    } else if ($uri == "/singleuser") {
        foreach ($rows as $row) {
            print_r($rows);
            ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="list" class="myButton">List</a></td>
            <?php }
    } else if ($uri == "/singleuserfa" || preg_match("#^/singleuserfawc/([0-9]+)$#", $uri)) {
        print_r($result);
        echo "<br>";
        print_r($row);
            ?>
            <tr>
                <?php

                if (isset($row['id'])) {
                ?>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><a href="/list" class="myButton">List</a></td>
                <?php } else { ?>
                    <td>Don't mess with the urls</td>
            <?php }
            } ?>
            </tr>

</table>