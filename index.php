<!doctype html>
<html lang="en">
  <head>
  <?php
if(isset($_POST['first-name'])){
include("conn.php");
$stmt = $conn->prepare("INSERT INTO personnel (firstName, lastName, jobTitle, email, departmentID) VALUES (:firstName, :lastName, :jobTitle, :email, :departmentID)");
$stmt->bindParam(':firstName', $_POST['first-name']);
$stmt->bindParam(':lastName', $_POST['last-name']);
$stmt->bindParam(':jobTitle', $_POST['job-title']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':departmentID', $_POST['department']);
$stmt->execute();
}
?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta description -->
    <meta name="description" content="">
    <meta name="author" content="Myles King">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="team.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="./packages/bootstrap/css/bootstrap.min.css">

    <!-- Latest compiled and minified bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="./packages/bootstrap/bootstrap-select.min.css">

    <!-- Css link -->
    <link rel="stylesheet" type="text/css" href="./css/css.css">

    <title>Company Personnel</title>

  </head>
 
  <body>
        
    <div class="row justify-content-between" id="nav">
      <div class="col-8" id="title" href=".">Company Directory</div>
      <button class="col-2 nav-button" id="add" data-toggle="modal"  data-target="#add-modal"> + </button>
    </div>
    
    
    <!-- Div containing data -->
    <div class="container" id="main">

      <div class="col-12 search">
        <div class="row">
          <input class="col-5" type="text" id="myInput" onkeyup="search()" placeholder="Search...">
          <a class="col-5" id="advanced-button"><div>Advanced search</div></a>
            <select class="col-2 advanced" id="advanced-department" onchange="">
              <option value="" >Department</option>
              <?php 
                            require('conn.php');
                            $sql = "SELECT id, name FROM department";
                            $result = $conn->query($sql);
                            foreach($result as $row){
                              echo '<option value='.$row['id'].'>'.$row['name'].'</option>'; 
                            }

              ?>
            </select>
            <select class="col-2 advanced" id="advanced-location" onchange="">
              <option value="" >Location</option>
              <?php 
                              require('conn.php');
                              $sql = "SELECT id, name FROM location";
                              $result = $conn->query($sql);
                              foreach($result as $row){
                                echo '<option value='.$row['id'].'>'.$row['name'].'</option>'; 
                              }

              ?>
            </select>
            <a class="col-1" id="remove-button"><div>Remove</div></a>
        </div>
      </div>        
        
      <div class="profile-section">
        <ul id="myUL">
        <?php
  
              require('conn.php');
              $sql = "SELECT id, firstName, lastName, email, departmentID FROM personnel";
              $result = $conn->query($sql);
              foreach($result as $row){
                $sql = "SELECT name, locationID FROM department WHERE id = ".$row['departmentID'];
                $result = $conn->query($sql);
                $department = $result->fetch();
                $sql = "SELECT name FROM location WHERE id = ".$department['locationID'];
                $result = $conn->query($sql);
                $location = $result->fetch();
                echo '<li><div class="list-group-item list-group-item-action flex-column align-items-start toggler-enabled" id="profile">
                <a>
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">'.$row['firstName'].' '.$row['lastName'].'</h5>
                    <small>'.$row['id'].'</small>
                  </div>
                  <div>
                  <p class="mb-1">'.$row['email'].'</p>
                  <p class="mb-1">'.$department['name'].'</p>
                  <p class="mb-1">'.$location['name'].'</p>
                  </div>
                </a>
                <div class="container" id="edit-delete">
                  <button type="button" class="col-5" id="edit" data-toggle="modal"  data-target="#edit-modal"> Edit </button>
                  <form action="delete.php" method="post">
                    <button type="submit" name="id" value='.$row['id'].'>Delete</button>
                  </form>
                </div>
              </div></li>';
              }
          ?>
   </ul>
        
        
      <!-- Add employee Bootstrap modal -->
      <div>
        <div class="modal fade add" id="add-modal" role="dialog">
          <div class="modal-dialog modal-dialog-centered add">
                
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Add New Employee</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
              </div>
              <div class="modal-body" id="modalContent">
                <form action="index.php" method="post">
                  <table>
                    <tr>
                      <td>First Name:</td>
                      <td><input type="text" name="first-name" placeholder="John"></td>
                    </tr>
                    <tr>
                      <td>Last Name:</td>
                      <td><input type="text" name="last-name" placeholder="Smith"></td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td><input type="text" name="email" placeholder="email@company.co.uk"></td>
                    </tr>
                    <tr>
                      <td>Job Title:</td>
                      <td><input type="text" name="job-title" placeholder="Accountant"></td>
                    </tr>
                    <tr>
                      <td>Department:</td>
                      <td><select name="department">
                        <?php 
                        require('conn.php');
                        $sql = "SELECT id, name FROM department";
                        $result = $conn->query($sql);
                        foreach($result as $row){
                          echo '<option value='.$row['id'].'>'.$row['name'].'</option>'; 
                        }

                        ?>
                      </select></td>
                    </tr>
                    <tr>
                      <td>Location:</td>
                      <td><select name="location">
                        <?php 
                        require('conn.php');
                        $sql = "SELECT id, name FROM location";
                        $result = $conn->query($sql);
                        foreach($result as $row){
                          echo '<option value='.$row['id'].'>'.$row['name'].'</option>'; 
                        }

                        ?>
                      </select></td>
                    </tr>
                    <tr>
                      <td colspan=2 id="submit"><input type="submit"></td>
                    </tr>
                  </table>
                </form>
              </div>
            </div>  
          </div>
        </div>
      </div>   


      <!-- Edit employee Bootstrap modal -->
      <div>
        <div class="modal fade add" id="edit-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered add">
                  
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalTitle">Edit Employee</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" id="modalContent">
                  <form action="edit.php" method="post">
                    <table>
                      <tr>
                        <td>Employee Number: </td>
                        <td><input type="text" name="id" value="" readonly></td>
                      </tr>
                      <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="first-name" value=""></td>
                      </tr>
                      <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="last-name" value=""></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email" value=""></td>
                      </tr>
                      <tr>
                        <td>Job Title:</td>
                        <td><input type="text" name="job-title" value=""></td>
                      </tr>
                      <tr>
                        <td>Department:</td>
                        <td><select name="department" id="department">
                          <?php 
                          require('conn.php');
                          $sql = "SELECT id, name FROM department";
                          $result = $conn->query($sql);
                          foreach($result as $row){
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>'; 
                          }

                          ?>
                        </select></td>
                      </tr>
                      <tr>
                        <td>Location:</td>
                        <td><select name="location" id="location">
                          <?php 
                          require('conn.php');
                          $sql = "SELECT id, name FROM location";
                          $result = $conn->query($sql);
                          foreach($result as $row){
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>'; 
                          }

                          ?>
                        </select></td>
                      </tr>
                      <tr>
                        <td colspan=2 id="submit"><input type="submit"></td>
                      </tr>
                    </table>
                  </form>
                </div>
              </div>  
            </div>
        </div> 
      </div>
     
    <!-- Bootsrap required javascript - jQuery first, then Popper.js, then Bootstrap JS as stated in Bootstrap documentation-->
    <script type="text/javascript" src="./packages/bootstrap/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="./packages/bootstrap/popper.min.js" ></script>
    <script type="text/javascript" src="./packages/bootstrap/js/bootstrap.min.js"></script>

    <!-- Latest compiled and minified bootstrap JavaScript -->
    <script type="text/javascript" src="./packages/bootstrap/bootstrap-select.min.js"></script>

    <!-- JavaScript -->
    <script type="text/javascript" src="./js/js.js"></script>
  </body>
          
</html>



