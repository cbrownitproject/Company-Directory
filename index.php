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
        
    <!-- Buttons to select to add or delete locations, departments or add a new person along with Title visible only when in desktop -->
    <div class="row justify-content-around" id="nav">
      <div class="nav-title col-7" > Company Directory </div>
          <button class="nav-button text-center" id="add" data-toggle="modal"  data-target="#location-modal"><img src="css/location.png" id="deptIcon"></button>
          <button class="nav-button text-center" id="add" data-toggle="modal"  data-target="#department-modal"><img src="css/department.png" id="deptIcon"></button>
          <button class="nav-button text-center" id="add" data-toggle="modal"  data-target="#add-modal"><img src="css/person.png" id="deptIcon"></button>
    </div>
    
    
    <!-- Div containing the rest of the app -->
    <div class="container" id="main">

      <!-- Div search bar and extended advance search which opens when user clicks on button -->
      <div class="col-12 search" id="changes">
        <div class="col-12 search">
          <div calss="container">
            <div class="row justify-content-md-center" id="search-row">
              <input class="col-sm-1 col-md-7" type="text" id="search" placeholder="Search...">
              <a class="btn btn-secondary btn-sm col-sm-1 col-md-2" id="advanced-button">Advanced search</a>
            </div>
          </div>
          <!-- Section for the Advanced Search which is initially hiiden -->
          <div class="container">
            <div class="row justify-content-md-center" id="advancedRow">
              <!-- Department select dropdown -->
              <select class="col-sm-2 col-md-4 dept" id="dept">
                <option value="all">All departments</option>
              </select>
              <!-- Location slect  dropdown -->
              <select class="col-sm-2 col-md-4 loca" id="loca">
                <option value="all">All locations</option>
              </select>
              <!-- Button to remove search criteria and hide sleects -->
              <a class="btn btn-secondary btn-sm col-1" id="remove-button">Remove</a>
            </div>
          </div>
        </div>
      </div>
      

      <!-- Section containing the list of employees that furfil the search criteria (all if no criteria) -->
      <div class="profile-section">
        <!-- Employee's profiles go in this un-ordered list element -->
        <div class="container">
          <ul class="row justify-content-md-center" id="profiles">
          </ul>
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
                <div class="modal-body" id="edit-modalContent">
                  <!-- Form which is sent to edit.php when submitted, this updates users profiles -->
                  <form id="editPerson">
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
                        <td><select name="department" id="editDep" required></select></td>
                      </tr>
                    </table>
                    <div class="modal-footer">
                      <td colspan="2"><input class="btn btn-success btn-sm" type="submit" value="Edit" id="editSubmit"></td>
                    </div>
                  </form>
                </div>
              </div>  
            </div>
          </div> 
        </div>

        <!-- Delete Employee modal -->
        <div>
          <div class="modal fade add" id="delete-employee-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered add">  
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalTitle">Delete Employee</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" id="deletePersonModalContent">
                  <div> Are you sure you wish to delete employee?</div>
                </div>
                <div class="modal-footer" id="deletePersonModalFoot">
                  <form id="personDelForm">
                    <input id="deletePersInput">
                    <button type="submit" class="btn btn-danger btn-sm" name="id" class="deletePers" >Delete</button>
                  </form>
                  <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
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
                  <form id="addPerson">
                    <table id="employeeModalTable">
                      <tr >
                        <td>First Name:</td>
                        <td><input type="text" id="addName" name="first-name" placeholder="John" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                      </tr>
                      <tr>
                        <td>Last Name:</td>
                        <td><input type="text" id="addLast" name="last-name" placeholder="Smith" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><input type="email" id="addEmail" name="email" placeholder="email@company.co.uk" required></td>
                      </tr>
                      <tr>
                        <td>Job Title:</td>
                        <td><input type="text" id="addJob" name="job-title" placeholder="Accountant" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                      </tr>
                      <tr>
                        <td>Department:</td>
                        <td><select name="department" id="depSel" required>
                        </select></td>
                      </tr>
                    </table>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-success btn-sm" value="Add" id="addEmployeeSubmit">
                    </div>
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
                  <h4 class="modal-title" id="modalTitle">Departments</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" id="modalContent">
                    <table id="deptModal">
                    </table>
                </div>
                <div class="modal-footer">
                  <button class="col-2 btn btn-success btn-sm text-center" id="add" data-toggle="modal"  data-target="#addDepartment-modal">Add Department</button>
                </div>
              </div>  
            </div>
          </div>
        </div>
        
        <!-- Edit Department Bootstrap modal -->
        <div>
          <div class="modal fade add" id="edit-department-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered add">  
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalTitle">Edit Department</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <form id="editDepartment">
                  <div class="modal-body" id="modalContent">
                    <table id="editDeptModal">
                      <tr>
                        <td>Department ID: </td>
                        <!-- This input uses readonly as the department ID is the primary key and so will be automatically given to the department
                            and cannot be changed -->
                        <td><input type="text" class="editClass" name="id"  id="depValEdit"  readonly></td>
                      </tr>
                      <tr>
                        <td>Department:</td>
                        <td><input type="text" class="editClass" name="job-title" id="editDepModal" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                      </tr>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button class="col-2 btn btn-success btn-sm text-center" id="add" type="submit">Edit</button>
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                  </div>
                </form>
              </div>  
            </div>
          </div>
        </div>

        <!-- Delete Department Bootstrap modal -->
        <div>
          <div class="modal fade add" id="delete-department-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered add">    
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalTitle">Delete Department</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <form id="deleteDepartment">
                  <div class="modal-body" id="deleteDepModalContent">
                    <div id="departmentReplace"></div>
                  </div></br>
                  <div class="modal-footer" id="delete-dep-modal-footer"> 
                    <input id="deleteDepInput" >
                    <button type="submit" class="btn btn-danger btn-sm" name="id" class="deleteDep" id="deleteDepOk">Delete</button>
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                  </div>
                </form>
              </div>  
            </div>
          </div>
        </div>


        <!-- Add Department Bootstrap modal -->
        <div>
          <div class="modal fade add" id="addDepartment-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered add">    
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalTitle">Add Departments</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" id="modalContent">
                  <form id="addDepartment">
                    <table>
                      <tr>
                        <td>Department: </td>
                        <td><input id="departName" type="text" name="department" placeholder="Accoutning" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                      </tr>
                      <tr>
                        <td>Location: </td>
                        <td><select name="location" id="locationSel" required></select>
                        </td>
                      </tr>
                    </table>
                    <div class="modal-footer">
                      <input class="btn btn-success btn-sm" type="submit" value="Add">
                    </div>
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
                  <h4 class="modal-title" id="modalTitle">Locations</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" id="modalContent">
                    <table id="locationModal">
                    </table>
                </div>
                <div class="modal-footer">
                  <button class="col-2 btn btn-success btn-sm text-center" id="add" data-toggle="modal"  data-target="#addLocation-modal">Add Location</button>
                </div>
              </div>  
            </div>
          </div>
        </div>  

        <!-- Edit Location Bootstrap modal -->
        <div>
          <div class="modal fade add" id="edit-location-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered add">  
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalTitle">Edit Location</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <form id="editLocation">
                  <div class="modal-body" id="modalContent">
                      <table id="editLocaModal">
                        <tr>
                          <td>Location ID: </td>
                          <!-- This input uses readonly as the department ID is the primary key and so will be automatically given to the department
                              and cannot be changed -->
                          <td><input type="text" class="editClass" name="id"  id="editLocationId"  readonly></td>
                        </tr>
                        <tr>
                          <td>Location:</td>
                          <td><input type="text" class="editClass" name="job-title" id="editLocModal" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                        </tr>
                      </table>
                  </div>
                  <div class="modal-footer">
                    <button class="col-2 btn btn-success btn-sm text-center" data-toggle="modal" >Edit</button>
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button
                  </div>
                </form>
              </div>  
            </div>
          </div>
        </div>

        <!-- Delete Location Bootstrap modal -->
        <div>
          <div class="modal fade add" id="delete-location-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered add">    
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalTitle">Delete Location</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <form id="deleteLocation">
                  <div class="modal-body" id="deleteLocModalContent">
                    <div id="deleteLocModalReplace"></div>
                  </div></br>
                  <div class="modal-footer" id="delete-loc-modal-footer">
                    <button class="btn btn-danger btn-sm" type="submit" name="id" class="delLocat" id="deleLocButn">Delete</button>
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                  </div>
                </form>
              </div>  
            </div>
          </div>
        </div>
      
        <!-- Add Location Bootstrap modal -->
        <div>
          <div class="modal fade add" id="addLocation-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered add">   
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalTitle">Add Location</h4>
                  <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" id="modalContent">
                  <form id="locationAddForm" >
                    <table>
                      <tr>
                      <td colspan="3"><input id="addLoc" type="text" name="location" placeholder="London" pattern="[a-zA-Z]+(?:[ '-][a-zA-Z]+)*" maxlength="21" required></td>
                      </tr>
                    </table>
                    <div class="modal-footer">
                      <input class="btn btn-success btn-sm" type="submit" value="Add">
                    </div>
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



