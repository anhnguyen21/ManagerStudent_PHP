<?php
    session_start();
    global $gioi;
    global $kha;
    global $tb;
    global $yeu;
    global $checkLogin;
    $server = "localhost";
    $user = "root";
    $password ="";
    $dbName = "user21";
    $db = new mysqli($server, $user, $password, $dbName);

    if(isset($_POST['insert'])){
        $fn=$_POST['fname'];
        $ln=$_POST['lname'];
        $m=$_POST['math'];
        $j=$_POST['java'];
        $sql="INSERT into U_ser values(null,'$fn','$ln',$m,$j)";
        $db->query($sql);
    }
    if(isset($_POST['delete'])){
        $d=$_POST['delete'];
        $sql = "DELETE from U_ser where id = ".$d;
        $db->query($sql);
    }
    $sql = "SELECT * from U_ser";
    $result = $db->query($sql)->fetch_all();

    $sql1 = "SELECT * from A_dmin";
    $result1 = $db->query($sql1)->fetch_all();
    // var_dump($result);
    class student21{
        private $id;
        private $fname;
        private $lname;
        private $math;
        private $java;
        function __construct($id,$fname,$lname,$math,$java){
            $this->id=$id;
            $this->fname=$fname;
            $this->lname=$lname;
            $this->math=$math;
            $this->java=$java;
        }
       
        function getId() {
            return $this->id;
        }
        function getFName() {
            return ucfirst($this->fname);
        }
        function getLName() {
            return ucfirst($this->lname);
        }
        function fullName(){
            return $this->getFName().' '.$this->getLName();
        }
        function getMath() {
            return $this->math;
        }
        function getJava() {
            return $this->java;
        }
        function average(){
            return ($this->getMath()+$this->getJava())/2;
        }
        function getType(){
            
            if($this->average()>8.5){
                return 'Gioi';
            }else if($this->average()>6.5){
                return 'Kha';
            }else if($this->average()>5){
                return 'TB';
            }else{
                return 'Yeu';
            }
        }
        
        function ThongKe(){
            global $gioi;
            global $kha;
            global $tb;
            global $yeu;
            if($this->average()>8.5){
                return ++$gioi;
            }else if($this->average()>6.5){
                return ++$kha;
            }else if($this->average()>5){
                return ++$tb;
            }else{
                return ++$yeu;
            }
        }
    }
    $student=array();
    for($i=0;$i<count($result);$i++){
        array_push($student,new student21($result[$i][0],$result[$i][1],$result[$i][2],$result[$i][3],$result[$i][4]));
    }
    if($_SESSION['check']==null){
        $checkLogin=false;
        $_SESSION['check']=$checkLogin;
    }
     
    if(isset($_POST['login'])){
        $userN=$_POST['nameLogin'];
        $pass=$_POST['passLogin'];
        for($i=0;$i<count($result1);$i++){
            if($result1[$i][0]==$userN&&$result1[$i][1]==$pass){
                $checkLogin=true;
                $_SESSION['check']=$checkLogin;
                break;
            }
        }
    }
    
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
            <div id="log"> 
            <button class="btn btn-danger" data-toggle="modal" data-target="#modalLoginForm">Login</button> 
            </div>
            <div id="inp">
                <form method="POST">
                    <input type="text" name="fname">
                    <input type="text" name="lname">
                    <input type="text" name="math">
                    <input type="text" name="java">
                    <button class="btn btn-danger" name="insert">insert</button>
                </form>
            </div>
            <table align="center" width="600px" border="1" cellspacing="0" cellpadding="3"
                class="table table-hover table-bordered" id="mytable">
                <tr class="table-primary table-header" style="text-align: center;">
                    <th>Id</th>
                    <th>Full Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Math Score</th>
                    <th>Java Score</th>
                    <th>Average</th>
                    <th>Type</th>
                    <?php if($_SESSION['check']==true){
                        echo '<th>Delete</th>';
                    } ?>
                </tr>
                <?php
                    for($i=0;$i<count($student);$i++){
                        echo '<tr>';
                        echo '<td>'.$student[$i]->getId().'</td>';
                        echo '<td>'.$student[$i]->fullName().'</td>';
                        echo '<td>'.$student[$i]->getFName().'</td>';
                        echo '<td>'.$student[$i]->getLName().'</td>';
                        echo '<td>'.$student[$i]->getMath().'</td>';
                        echo '<td>'.$student[$i]->getJava().'</td>';
                        echo '<td>'.$student[$i]->average().'</td>';
                        echo '<td>'.$student[$i]->getType().'</td>';
                        if($_SESSION['check']==true){
                            echo '<td><form method="POST"><button class="btn btn-danger" value="'.$student[$i]->getId().'" name="delete">Delete</button></form></td>';
                        }
                        echo '</tr>';
                        $student[$i]->ThongKe();
                    }
                ?>
            </table>
            <div>
            <?php
                if($gioi!=0||$kha!=0||$tb!=0||$yeu){
                    echo 'Tong so hoc sinh gioi :'.($gioi*100/count($student)).'%' ;
                    echo '<br>';
                    echo 'Tong so hoc sinh Kha : '.($kha*100/count($student)).'%';
                    echo '<br>';
                    echo 'Tong so hoc sinh trung binh :'.($tb*100/count($student)).'%' ;
                    echo '<br>';
                    echo 'Tong so hoc sinh yeu :'.($yeu*100/count($student)).'%' ;
                }
            ?>
            </div>
        </div>
        <!--====================Đăng nhập======================-->
        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Đăng nhập</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <i class="fas fa-user"></i>
                                <input type="text" id="defaultForm-user" class="form-control validate" name="nameLogin">
                                <label data-error="wrong" data-success="right" for="defaultForm-email">Account</label>
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input type="password" id="defaultForm-pass" class="form-control validate" name="passLogin">
                                <label data-error="wrong" data-success="right" for="defaultForm-pass">Mật khẩu</label>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-default" style="background-color:dodgerblue;" onclick="login()" name="login">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </body>        
</html>