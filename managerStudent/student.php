<?php
    $server = "localhost";
    $user = "root";
    $password ="";
    $dbName = "user21";
    $db = new mysqli($server, $user, $password, $dbName);

    if(isset($_POST['insert'])){

    }

    $sql = "SELECT * from U_ser";
    $result = $db->query($sql)->fetch_all();
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <style>
            #container{
                width: 1000px;
                margin: auto;
                margin-top:20px;
            }
            #mytable tr td{
                padding:10 10 10 30px;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <div id="inp">
                <form method="POST">
                    <input type="text" name="name">
                    <input type="text" name="math">
                    <input type="text" name="java">
                    <button class="btn btn-danger" name="insert">insert</button>
                </form>
            </div>
            <table align="center" width="600px" border="1" cellspacing="0" cellpadding="3"
                class="table table-hover table-bordered" id="mytable">
                <tr class="table-primary table-header" style="text-align: center;">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Math Score</th>
                    <th>Java Score</th>
                    <th>Delete</th>
                </tr>
                <?php
                    for($i=0;$i<count($result);$i++){
                        echo '<tr>';
                        echo '<td>'.$result[$i][0].'</td>';
                        echo '<td>'.ucfirst($result[$i][1]).'</td>';
                        echo '<td>'.$result[$i][2].'</td>';
                        echo '<td>'.$result[$i][3].'</td>';
                        echo '<td><button class="btn btn-danger" value="'.$i.'" name="delete">Delete</button></td>';
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>
    </body>        
</html>