<!doctype html>
<html lang="en">
  <head>
  <?php
if(isset($_POST['first-name'])){
include("conn.php");
$stmt = $conn->prepare("INSERT INTO personnel (firstName, lastName, jobTitle, email, departmentID) VALUES (:firstName, :lastName, :jobTitle, :email, :departmentID)");
$stmt->bindParam(':firstName', ucwords(strtolower($_POST['first-name'])));
$stmt->bindParam(':lastName', ucwords(strtolower($_POST['last-name'])));
$stmt->bindParam(':jobTitle', ucwords(strtolower($_POST['job-title'])));
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
        
    <div class="row justify-content-around" id="nav">
      <button class="col-2 nav-button text-center" id="add" data-toggle="modal"  data-target="#location-modal"><img src="css/location.png" id="deptIcon"></button>
      <button class="col-2 nav-button text-center" id="add" data-toggle="modal"  data-target="#department-modal"><img src="css/department.png" id="deptIcon"></button>
      <button class="col-2 nav-button text-center" id="add" data-toggle="modal"  data-target="#add-modal"><img src="css/person.png" id="deptIcon"></button>
    </div>
    
    
    <!-- Div containing data -->
    <div class="container" id="main">
      
      <div class="col-12 search" id="changes">
        <div class="col-12 search">
          
          <div class="row">
            <input class="col-7" type="text" id="search" placeholder="Search...">
            <a class="col-4" id="advanced-button"><div>Advanced search</div></a>
          </div>
          
          <div class="row" id="advancedRow">
            <select class="col-5 dept" id="dept">
              <option value="all">All departments</option>
            </select>

            <select class="col-5 loca" id="loca">
              <option value="all">All locations</option>
            </select>

            <a class="col-1" id="remove-button"><div>Remove</div></a>
          </div>
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
                echo '<li class="box" data-first='.$row['firstName'].' data-last='.$row['lastName'].' data-id='.$row['id'].' data-email='.$row['email'].' data-department='.$row['departmentID'].' data-location='.$department['locationID'].'>
                <div class="list-group-item list-group-item-action flex-column align-items-start toggler-enabled" id="profile">
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
                
                  <button type="button" class="col-5" name="id" onclick="showModal('.$row['id'].')"> Edit </button>
                  <form action="delete.php" method="post">
                    <button type="submit" class="col-5 delete confdel" name="id" value='.$row['id'].'>Delete</button>
                  </form>
                </div>
              </div>
              </li>';
              }
          ?>
   </ul>
   <!--data-toggle="modal"  data-target="#edit-modal" value='.$row['id'].'-->
        

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
                <div class="modal-body" id="edit-modalContent">

                  <!-- // if(isset($_POST['ff26y'])){
                  // include("conn.php");
                  // $sql = "SELECT firstName, lastName, email, departmentID FROM personnel WHERE id = ".$_POST['ff26y'];
                  // $result = $conn->query($sql);
                  // $person = $result->fetch();
                  // $sql = "SELECT name, locationID FROM department WHERE id = ".$row['departmentID'];
                  // $result = $conn->query($sql);
                  // $department = $result->fetch();
                  // $sql = "SELECT name FROM location WHERE id = ".$department['locationID'];
                  // $result = $conn->query($sql);
                  // $location = $result->fetch();
                  // echo '
                  // <form action="edit.php" method="post">
                  // <table>
                  //   <tr>
                  //     <td>Employee Number: </td>
                  //     <td><input type="text" name="id" value='.$person['id'].' readonly></td>
                  //   </tr>
                  //   <tr>
                  //     <td>First Name:</td>
                  //     <td><input type="text" name="first-name" value='.$person['firstName'].'></td>
                  //   </tr>
                  //   <tr>
                  //     <td>Last Name:</td>
                  //     <td><input type="text" name="last-name" value='.$person['lastName'].'></td>
                  //   </tr>
                  //   <tr>
                  //     <td>Email:</td>
                  //     <td><input type="text" name="email" value='.$person['email'].'></td>
                  //   </tr>
                  //   <tr>
                  //     <td>Job Title:</td>
                  //     <td><input type="text" name="job-title" value='.$person['jobTitle'].'></td>
                  //   </tr>
                  //   <tr>
                  //     <td>Department:</td>
                  //     <td><select name="department" id="depSel">
                  //     </select></td>
                  //   </tr>
                  //   <tr>
                  //     <td>Location:</td>
                  //     <td><select name="location" id="locSel">
                  //     </select></td>
                  //   </tr>
                    
                  // ';
                  // } -->

                </div>
              </div>  
            </div>
        </div> 
      </div>
        
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
              <div class="modal-body employee" id="modalContent">
                <form action="index.php" method="post">
                  <table id="employeeModalTable">
                    <tr >
                      <td>First Name:</td>
                      <td><input type="text" name="first-name" placeholder="John" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                    </tr>
                    <tr>
                      <td>Last Name:</td>
                      <td><input type="text" name="last-name" placeholder="Smith" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td><input type="email" name="email" placeholder="email@company.co.uk" required></td>
                    </tr>
                    <tr>
                      <td>Job Title:</td>
                      <td><input type="text" name="job-title" placeholder="Accountant" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                    </tr>
                    <tr>
                      <td>Department:</td>
                      <td><select name="department" id="depSel" required>
                      </select></td>
                    </tr>
                    <tr>
                      <td>Location:</td>
                      <td><select name="location" id="locSel" required>
                      </select></td>
                    </tr>
                    <tr>
                      <td colspan=2 id="submit"><input type="submit" value="Add" id="addEmployeeSubmit"></td>
                    </tr>
                  </table>
                </form>
              </div>
            </div>  
          </div>
        </div>
      </div>   


      <!-- Department Bootstrap modal -->
      <div>
        <div class="modal fade add" id="department-modal" role="dialog">
          <div class="modal-dialog modal-dialog-centered add">
                
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Edit Departments</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
              </div>
              <div class="modal-body" id="modalContent">
                  <table id="deptModal">
                    <tr>
                      <th>Department</th>
                      <th>ID</th>
                    </tr>
                  </table></br>
                <form action="addDepartment.php" method="post">
                  <table>
                    <tr>
                      <th colspan="2"> Add New Department </th>
                    </tr>
                    <tr>
                      <td>Department Name: </td>
                      <td><input type="text" name="department" placeholder="Accoutning" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                    </tr>
                    <tr>
                      <td>Department Location: </td>
                      <td><select name="location" id="locationSel" required></select>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" id="submit"><input type="submit" value="Add"></td>
                    </tr>
                  </table>
                </form>
              </div>
            </div>  
          </div>
        </div>
      </div>  


      <!-- Location Bootstrap modal -->
      <div>
        <div class="modal fade add" id="location-modal" role="dialog">
          <div class="modal-dialog modal-dialog-centered add">
                
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Edit Locations</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
              </div>
              <div class="modal-body" id="modalContent">
                  <table id="locationModal">
                    <tr>
                      <th>Location</th>
                      <th>ID</th>
                      <th>Delete</th>
                    </tr>
                  </table></br>
                <form action="addLocation.php" method="post" id="locationAddForm" >
                  <table>
                    <tr>
                      <th colspan="3">Add New Location</th>
                    </tr>
                    <tr>
                      <!-- Regex String with letters plus at least 0 or more spaces, dashes, apostrophy or letters -->
                    <td colspan="3"><input type="text" name="location" placeholder="London" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                    </tr>
                    <tr>
                      <td colspan="3" id="submit"><input type="submit" value="Add"></td>
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



