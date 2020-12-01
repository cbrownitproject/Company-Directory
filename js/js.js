////////////////////////////////////////////////// People ////////////////////////////////////////////////// 

// Function to fetch all of the people on the database and display in a human readable way the information
$.ajax({
    url: "php/getall.php",
    type: 'POST',
    dataType: 'json',
    //cache: false,
    success: function(result) {

        // Appends each persons profile into the scrollable section
        for (i=0; i<result.length; i++) {
        $("#profiles").append('<li class="col-xs-6 col-md-3 box" data-first=' + result[i]['firstName'] + ' data-last=' + result[i]['lastName'] + ' data-id=' + result[i]['id'] + ' data-email=' + result[i]['email'] + ' data-department=' + result[i]['department'] + ' data-location=' + result[i]['location'] + '><div class="list-group-item list-group-item-action flex-column align-items-start toggler-enabled" id="profile"><a><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">' + result[i]['lastName'] + ', ' + result[i]['firstName'] + '</h5></div><div><p class="mb-1">' + result[i]['jobTitle'] + '</p><p class="mb-1">' + result[i]['email'] + '</p><p class="mb-1">' + result[i]['department'] + '</p><p class="mb-1">' + result[i]['location'] + '</p></div></a><div class="container" id="edit-delete"><button type="button" class="col-5 btn btn-success btn-sm" name="id" onclick="showModal(' + result[i]['id'] + ')"> Edit </button><button type="submit" class="col-5 btn btn-danger btn-sm personDelete" name="id" value=' + result[i]['id'] + ' onclick="delPerson(' + result[i]['id'] + ')">Delete</button></div></div></li>')
        };

        ///////////////////// Edit employee /////////////////////

        // Function to edit employee data in the database using values in the edit person modal
        $("#editPerson").submit(function () {
            $.ajax({
                url: "php/edit.php",
                type: 'POST',
                dataType: 'json',
                data: {
                    firstName : $("#editName").val(), 
                    lastName : $("#editLast").val(),
                    jobTitle : $("#editJob").val(),
                    email : $("#editEmail").val(),
                    departmentID : $("#editDep").val(),
                    id : $("#editID").val()
                },
                success: function(result) {

                },
                error: function(jqXHR, exception){
                    errorajx(jqXHR, exception);
                    console.log("Edit profiles");
                }
            });   
        })

        ///////////////////// Delete employee /////////////////////

            // Function to delete a person such as if the left the business
            $("#personDelForm").submit(function () {
                $.ajax({
                    url: "php/delete.php",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: $("#deletePersInput").val()
                    },
                    success: function(result) {

                    },
                    error: function(jqXHR, exception){
                        errorajx(jqXHR, exception);
                    console.log("Delete profiles");
                    }
                });   
            });  
    },
    error: function(jqXHR, exception){
        errorajx(jqXHR, exception);
        console.log("Get profiles");
    }    
}); 

// // Function to populate the delete person modal and start the routine, when confirmed, to delte an employee
function delPerson(data) {

    $("#deletePersInput").val(data);
    $("#delete-employee-modal").modal();
}

// Function to  fill the input boxes with an employees current data. This is done for two reasons, one so the  user can easily see what they change and also
// so that the data does not have to be re-typed if it is the same.
function showModal(data) {
    $.ajax({
        url: "php/editEmployee.php",
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(result) {

            // Appends each input value to their respective data
            $("#editID").val(result['id']);
            $("#editName").val(result['firstName']);
            $("#editLast").val(result['lastName']);
            $("#editEmail").val(result['email']);
            $("#editJob").val(result['job'])
            $("#editDep").val(result['department'])
            $("#editLoc").val(result['location'])
            $("#edit-modal").modal();

        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Edit Employee");
        }
    }); 
};

// Function to add a new person to the database using the add person modal, very similar to edit but INSERT instead of UPDATE
$("#addPerson").submit(function () {
    $.ajax({
        url: "php/addPerson.php",
        type: 'POST',
        dataType: 'json',
        data: {
            firstName : $("#addName").val(), 
            lastName : $("#addLast").val(),
            jobTitle : $("#addJob").val(),
            email : $("#addEmail").val(),
            departmentID : $("#depSel").val(), 
            location : $("#locSel").val()
        },
        success: function(result) {

        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Add profiles");
        }
    });   
});

////////////////////////////////////////////////// Department ////////////////////////////////////////////////// 

///////////////////////// Department Lists /////////////////////////

// Function which uses the database to get all of the departments and append them to select options so user can pick departments
// with a full list as they are created or deleted
$.ajax({
    url: "php/depList.php",
    type: 'POST',
    dataType: 'json',
    success: function(result) {
        for (i=0; i<result.length; i++) {
            $("#depSel").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#editDep").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#dept").append('<option value=' + result[i]['name'] + '>' + result[i]['name'] + '</option>')
            $("#deptModal").append('<tr><td>' + result[i]['name'] + '</td><td><button type="button" class="col-5 btn btn-success btn-sm" name="id" onclick="editDeptModal(' + result[i]['id'] + ')"> Edit </button></td><td><button type="submit" class="btn btn-danger btn-sm"name="id" data-id=' + result[i]['id'] + ' value=' + result[i]['id'] + ' onclick="deleteDeptModal(' + result[i]['id'] + ')">Delete</button></td></tr>')
        }               
        
        ///////////////////////// Edit Department /////////////////////////

        // Function to edit department name
        $("#editDepartment").submit(function () {
            $.ajax({
                url: "php/editDpt.php",
                type: 'POST',
                dataType: 'json',
                data: {
                    name : $("#editDepModal").val(), 
                    id : $("#depValEdit").val(),
                    location: $("#editDepLoca").val()
                },
                success: function(result) {
        
                },
                error: function(jqXHR, exception){
                    errorajx(jqXHR, exception);
                    console.log("Edit Department");
                }
            });   
        })     
        
        ///////////////////////// Delete Department /////////////////////////

        // Function to delete a department from the database
        $("#deleteDepOk").on("click", function () {
            $.ajax({
                url: "php/deleteDepartment.php",
                type: 'POST',
                dataType: 'json',
                data: { 
                    id : $(this).val(),
                },
                success: function(result) {

                },
                error: function(jqXHR, exception){
                    errorajx(jqXHR, exception);
                    console.log("Delete Department");
                }
            });   
        });

    },
    error: function(jqXHR, exception){
        errorajx(jqXHR, exception);
        console.log("Get Department");
    }
}); 

///////////////////////// Delete Department Modal /////////////////////////

// Delete department function which takes department ID as a parameter
function deleteDeptModal(data) {
    // Call to php which gets all people in the department
    $.ajax({
        url: "php/getPeopleInDepartment.php",
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(result) {

            // Create variable count which is number of employees in department
            count = result.length;

            // Set an value of delete button to id of department to be deleted
            $("#deleteDepOk").val(data);

            // If employees are in department you cannot delete, message provided which tells user to edit deparmtnet or remove employees before deleting
            if (count > 0) {
                // Appends each input value to their respective data
                $("#departmentReplace").replaceWith('<div id="departmentReplace">' + result[0]['department'] + ' has ' + count  + ' employees.</br> Please edit to new department or move people out of department before deleting. </div>');
                $("#deleteDepOk").hide();
                $("#delete-department-modal").modal();
            } else {
                $("#departmentReplace").replaceWith('<div id="departmentReplace" >Are you sure you wish to delete? </div>');
                $("#deleteDepOk").show();
                $("#delete-department-modal").modal();
            }

        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Delete Department");
        }
    }); 
};

///////////////////////// Add Department /////////////////////////

// Function to add a department to the database
$("#addDepartment").submit(function () {
    $.ajax({
        url: "php/addDepartment.php",
        type: 'POST',
        dataType: 'json',
        data: {
            department : $("#departName").val(), 
            location : $("#locationSel").val(),   
        },
        success: function(result) {

        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Add Department");
        }
    });   
});

///////////////////////// Edit Department /////////////////////////

// Function to populate the edit field for the department and start the  routine when confirm the edit
function editDeptModal(data) {
    $.ajax({
        url: "php/editDepartment.php",
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(result) {

            // Appends each input value to their respective data
            $("#depValEdit").val(result['id']);
            $("#editDepModal").val(result['name']);
            $("#editDepLoca").val(result['location']);
            $("#edit-department-modal").modal();

        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Edit Location");
        }
    }); 
};

////////////////////////////////////////////////// Location ////////////////////////////////////////////////// 

///////////////////////// Location Lists /////////////////////////

// Function which does the same as the department function above but for locations
$.ajax({
    url: "php/getLoc.php",
    type: 'POST',
    dataType: 'json',
    success: function(result) {

        // Itterate through the results and append sections in the html with the a select of possible locations
        for (i=0; i<result.length; i++) {
            $("#locSel").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#editLoc").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#editDepLoca").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#loca").append('<option value=' + result[i]['name'] + '>' + result[i]['name'] + '</option>')
            $("#locationSel").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#locationModal").append('<tr><td>' + result[i]['name'] + '</td><td><button type="button" class="col-5 btn btn-success btn-sm" name="id" onclick="editLocModal(' + result[i]['id'] + ')"> Edit </button></td><td><button type="submit" name="id" class="btn btn-danger btn-sm deleteLocat" data-id=' + result[i]['id'] + ' value=' + result[i]['id'] + ' onclick="deleteLocModal(' + result[i]['id'] + ')">Delete</button></td></tr>')
        } 

        ///////////////////////// Delete Location /////////////////////////

        // Function to delete a location from the database 
        $("#deleLocButn").on("click", function () {
            $.ajax({
                url: "php/deleteLocation.php",
                type: 'POST',
                dataType: 'json',
                data: { 
                    id : $(this).val(),
                },
                success: function(result) {
                        
                },
                error: function(jqXHR, exception){
                    errorajx(jqXHR, exception);
                    console.log("Delete Location");
                }
            });   
        });

        ///////////////////////// Edit Location /////////////////////////

        // Function to edit Location name
        $("#editLocation").submit(function () {
            $.ajax({
                url: "php/editLoc.php",
                type: 'POST',
                dataType: 'json',
                data: {
                    name : $("#editLocModal").val(), 
                    id : $("#editLocationId").val()
                },
                success: function(result) {
        
                },
                error: function(jqXHR, exception){
                    errorajx(jqXHR, exception);
                    console.log("Edit Locaiton");
                }
            });   
        })

    },
    error: function(jqXHR, exception){
        errorajx(jqXHR, exception);
        console.log("Get Locaiton");
    }
}); 


///////////////////////// Delete Location Modal d/////////////////////////

// Delete department function which takes department ID as a parameter
function deleteLocModal(data) {
    // Call to php which gets all people in the department
    $.ajax({
        url: "php/getPeopleInLocation.php",
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(result) {

            // Create variable count which is number of employees in department
            count = result.length;

            // Set the value of the delete button to the unique id of the location
            $("#deleLocButn").val(data);

            // If employees are in department you cannot delete, message provided which tells user to edit deparmtnet or remove employees before deleting
            if (count > 0) {
                // Appends each input value to their respective data
                $("#deleteLocModalReplace").replaceWith('<div id="deleteLocModalReplace" >' + result[0]['location'] + ' has ' + count  + ' departments.</br> Please edit to new location or move departments out of location before deleting. </div>');
                $("#deleLocButn").hide();
                $("#delete-location-modal").modal();
            } else {
                $("#deleteLocModalReplace").replaceWith('<div>Are you sure you wish to delete? </div>');
                $("#deleLocButn").show();
                $("#delete-location-modal").modal();
            }

        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Delete Location");
        }
    }); 
};


///////////////////////// Add Location /////////////////////////

// Function to add a new location in the Location edit modal
$("#locationAddForm").submit(function () {
    $.ajax({
        url: "php/addLocation.php",
        type: 'POST',
        dataType: 'json',
        data: { 
            location : $("#addLoc").val(),
        },
        success: function(result) {

        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Add Location");
        }
    });   
});

///////////////////////// Edit Location /////////////////////////

// Function to populate the edit field for the location and start the routine when confirm the edit
function editLocModal(data) {
    $.ajax({
        url: "php/editLocation.php",
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(result) {

            // Appends each input value to their respective data
            $("#editLocationId").val(result['id']);
            $("#editLocModal").val(result['name']);
            $("#edit-location-modal").modal();

        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Edit Location");
        }
    }); 
};

////////////////////////////////////////////////// Search ////////////////////////////////////////////////// 

///////////////////////// Code for displaying search /////////////////////////

// This section is for the search bar
// when the search bar is typed in or the department and location selects are changed the function select is run
$("#dept").change(function() {
    select();
});
$("#search").keyup(function() {
    select();
});
$("#loca").change(function() {
    select();
});
  
// Function for searching the personnel data
function select() {
    // Sets each of the search sections values to a variable
    var department = $("#dept").val();
    var search = $("#search").val();
    var location = $("#loca").val();

    // Gets the data in the box class and hides all the elements 
    $(".box").hide();
    // Sets variable boxes equal to all the data sets that equal the function using the filter method.
    var boxes = $(".box").filter(function(index) {

        // Contain department = all or if a department if it is selected and
        return (department === 'all' || $(this).attr("data-department") === department) &&
        // The result from the search type bar equal to any of the data for names, email etc or if nothing is types all are shown (not search) and
        ((!search || $(this).attr("data-first").toLowerCase().indexOf(search.toLowerCase()) >= 0 ) ||
        (!search || $(this).attr("data-last").toLowerCase().indexOf(search.toLowerCase()) >= 0 ) ||
        (!search || $(this).attr("data-email").toLowerCase().indexOf(search.toLowerCase()) >= 0 )) &&
        // Locations if selected or all if none are
        (location === 'all' || $(this).attr("data-location") === location)
    });
    // The boxes that match the search criteria are then shown
    boxes.show();
  
};  

///////////////////////// Hide/Show advanced search options /////////////////////////

// Function to show and hide the advanced search options when advanced search button is clicked
$("#advanced-button").on("click", function() {
    $("#advanced-button").hide();
    $("#advancedRow").is(":visible")?$("#advancedRow").hide():$("#advancedRow").show();
    $("#remove-button").is(":visible")?$("#remove-button").hide():$("#remove-button").show();
});

// Function to do the oppsite of before and hide the advanced search
$("#remove-button").on("click", function() {
    $("#remove-button").hide();
    $("#advancedRow").is(":visible")?$("#advancedRow").hide():$("#advancedRow").show();
    $("#advanced-button").is(":visible")?$("#advanced-button").hide():$("#advanced-button").show();
    $('.loca').val('all').trigger('change');
    $('.dept').val('all').trigger('change');
});

//////////////////////////////////////////////////  Error ////////////////////////////////////////////////// 

// Function which returns the error for an ajax call depending on the error number and log to console
function errorajx(jqXHR, exception) {

    var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        console.log(msg);
};

////////////////////////////////////////////////// Scroll ////////////////////////////////////////////////// 

// Function to scroll back to top of list when scrolled below top
$(document).ready(function(){ 
    $(".profile-section").scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $(".profile-section").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
});