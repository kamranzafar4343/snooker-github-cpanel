<?php
include "../includes/config.php";
include "../includes/session.php";
 $sql=mysqli_query($conn, "SELECT * FROM users where user_id=$userid");

                        $data=mysqli_fetch_assoc($sql);


                        $c_write=$data['c_write'];
                        $c_delete=$data['c_delete'];

                        
                        $s_write=$data['s_write'];
                        $s_delete=$data['s_delete'];

                     
                        $a_write=$data['a_write'];
                        $a_delete=$data['a_delete'];




?>