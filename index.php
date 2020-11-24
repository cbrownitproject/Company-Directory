<!doctype html>
<html lang="en">
  <head>

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
        
    <!-- Buttons to select to add or delete locations, departments or add a new person -->
    <div class="row justify-content-around" id="nav">
      <button class="col-2 nav-button text-center" id="add" data-toggle="modal"  data-target="#location-modal"><img src="css/location.png" id="deptIcon"></button>
      <button class="col-2 nav-button text-center" id="add" data-toggle="modal"  data-target="#department-modal"><img src="css/department.png" id="deptIcon"></button>
      <button class="col-2 nav-button text-center" id="add" data-toggle="modal"  data-target="#add-modal"><img src="css/person.png" id="deptIcon"></button>
    </div>
    
    
    
    <div class="container" id="main">
      
      <!-- Div search bar and extended advance search which opens when click on button -->
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
      
      <!-- Section containing the list of employees that furfil the search criteria (all if no criteria) -->
      <div class="profile-section">
        <!-- Employee's profiles go in this un-ordered list element -->
        <ul id="profiles">

        </ul>

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
                    <!-- Form which is sent to edit.php when submitted, this updates users profiles -->
                    <form action="php/edit.php" method="post">
                      <table>
                        <tr>
                        <td>Employee Number: </td>
                        <!-- This input uses readonly as the employee ID is the primary key and so will be automatically given to the employee
                            and cannot be changed -->
                        <td><input type="text" class="editClass" name="id" id="editID" readonly></td>
                      </tr>
                      <tr>
                        <td>First Name:</td>
                        <!-- This  input uses a regular expression to make sure that only letters  then a space, apostrophy or hyphen can be inputted -->
                        <td><input type="text" class="editClass" name="first-name" id="editName" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                      </tr>
                      <tr>
                        <td>Last Name:</td>
                        <td><input type="text" class="editClass" name="last-name" id="editLast" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><input type="email" class="editClass" name="email" id="editEmail" required></td>
                      </tr>
                      <tr>
                        <td>Job Title:</td>
                        <td><input type="text" class="editClass" name="job-title" id="editJob" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" ></td>
                      </tr>
                      <tr>
                        <td>Department:</td>
                        <td><select name="department" id="editDep" required>
                        </select></td>
                      </tr>
                      <tr>
                        <td colspan="2"><input type="submit" value="Edit" id="editSubmit"></td>
                      </tr>
                      </table>
                    </form>
                    
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
                  <form action="php/addPerson.php" method="post">
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
                  <form action="php/addDepartment.php" method="post">
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
                  <form action="php/addLocation.php" method="post" id="locationAddForm" >
                    <table>
                      <tr>
                        <th colspan="3">Add New Location</th>
                      </tr>
                      <tr>
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



