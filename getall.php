<?php
  
              require('conn.php');
              $sql = "SELECT id, firstName, lastName, email, departmentID FROM personnel";
              $result = $conn->query($sql);
              $array =[];
              foreach($result as $row){
                $sql = "SELECT name, locationID FROM department WHERE id = ".$row['departmentID'];
                $result = $conn->query($sql);
                $department = $result->fetch();
                $sql = "SELECT name FROM location WHERE id = ".$department['locationID'];
                $result = $conn->query($sql);
                $location = $result->fetch();
                $results = [];
                $results['firstName'] = $row['firstName'];
                $results['lastName'] =  $row['lastName'];
                $results['id'] = $row['id'];
                $results['email'] = $row['email'];
                $results['department'] = $department['name'];
                $results['location'] = $location['name'];
                
                
            //     '<li><div class="list-group-item list-group-item-action flex-column align-items-start toggler-enabled" id="profile">
            //     <a>
            //       <div class="d-flex w-100 justify-content-between">
            //         <h5 class="mb-1">'.$row['firstName'].' '.$row['lastName'].'</h5>
            //         <small>'.$row['id'].'</small>
            //       </div>
            //       <div>
            //       <p class="mb-1">'.$row['email'].'</p>
            //       <p class="mb-1">'.$department['name'].'</p>
            //       <p class="mb-1">'.$location['name'].'</p>
            //       </div>
            //     </a>
            //     <div class="container" id="edit-delete">
            //       <button type="button" class="col-5" id="edit" data-toggle="modal"  data-target="#edit-modal"> Edit </button>
            //       <form action="delete.php" method="post">
            //         <button type="submit" name="id" value='.$row['id'].'>Delete</button>
            //       </form>
            //     </div>
            //   </div></li>';

                array_push($array, $results);
              }
              echo json_encode($array)
          ?>