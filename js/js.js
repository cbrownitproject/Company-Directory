// Function to show and hide the advacned search options when a persons profile is clicked
$("#advanced-button").on("click", function() {
    $("#advanced-button").hide();
    $("#advancedRow").is(":visible")?$("#advancedRow").hide():$("#advancedRow").show();
    $("#remove-button").is(":visible")?$("#remove-button").hide():$("#remove-button").show();
});

$("#remove-button").on("click", function() {
    $("#remove-button").hide();
    $("#advancedRow").is(":visible")?$("#advancedRow").hide():$("#advancedRow").show();
    $("#advanced-button").is(":visible")?$("#advanced-button").hide():$("#advanced-button").show();
    $('.loca').val('all').trigger('change');
    $('.dept').val('all').trigger('change');
});

$.ajax({
    url: "depList.php",
    type: 'POST',
    dataType: 'json',
    success: function(result) {
        for (i=0; i<result.length; i++) {
            $("#depSel").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#editDep").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#dept").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
            $("#deptModal").append('<tr><td>' + result[i]['name'] + '</td><td>' + result[i]['id'] + '</td><td><form action="deleteDepartment.php" method="post"><button type="submit" name="id" class="confdel" value=' + result[i]['id'] + '>Delete</button></form></td></tr>')
        }

    },
    error: function(jqXHR, exception){
        errorajx(jqXHR, exception);
        console.log("Get Department");
    }
}); 


    $.ajax({
        url: "getLoc.php",
        type: 'POST',
        dataType: 'json',
        success: function(result) {

            for (i=0; i<result.length; i++) {
                $("#locSel").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
                $("#editLoc").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
                $("#loca").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
                $("#locationSel").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
                $("#locationModal").append('<tr><td>' + result[i]['name'] + '</td><td>' + result[i]['id'] + '</td><td><form action="deleteLocation.php" method="post"><button type="submit" name="id" class="confdel" value=' + result[i]['id'] + '>Delete</button></form></td></tr>')
            }

            $('.confdel').on("click", function areYouSure() { 
                if (confirm('Are you sure you want to permanently delete?')) {
                    $('.confdel').submit()
                } else {
                    return false;
                }
            });  
        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Get Locaiton");
        }
    }); 


    $.ajax({
        url: "getall.php",
        type: 'POST',
        dataType: 'json',
        success: function(result) {

            for (i=0; i<result.length; i++) {
            $("#profiles").append('<li class="box" data-first=' + result[i]['firstName'] + ' data-last=' + result[i]['lastName'] + 'data-id=' + result[i]['id'] + ' data-email=' + result[i]['email'] + ' data-department=' + result[i]['departmentID'] + ' data-location=' + result[i]['locationID'] + '><div class="list-group-item list-group-item-action flex-column align-items-start toggler-enabled" id="profile"><a><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">' + result[i]['firstName'] + ' ' + result[i]['lastName'] + '</h5><small>' + result[i]['id'] + '</small></div><div><p class="mb-1">' + result[i]['job'] + '</p><p class="mb-1">' + result[i]['email'] + '</p><p class="mb-1">' + result[i]['department'] + '</p><p class="mb-1">' + result[i]['location'] + '</p></div></a><div class="container" id="edit-delete"><button type="button" class="col-5" name="id" onclick="showModal(' + result[i]['id'] + ')"> Edit </button><form action="delete.php" method="post"><button type="submit" class="col-5 delete confdel" name="id" value=' + result[i]['id'] + '>Delete</button></form></div></div></li>')
            };

            // Function to show and hide the edit or delete options when a persons profile is clicked
            $(".toggler-enabled").on("click", function() {
                var expdiv = $(this).children("div");
            expdiv.is(":visible")?expdiv.hide():expdiv.show();
            });
        },
        error: function(jqXHR, exception){
            errorajx(jqXHR, exception);
            console.log("Get profiles");
        }
    }); 


function showModal(data) {
    $.ajax({
        url: "editEmployee.php",
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(result) {

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


$("#dept").change(function() {
    select();
});
$("#search").keyup(function() {
    select();
});
$("#loca").change(function() {
    select();
});
  
select = function() {
    var department = $("#dept").val();
    var search = $("#search").val();
    var location = $("#loca").val();
  
    $(".box").hide();
    var boxes = $(".box").filter(function(index) {

        return (department === 'all' || $(this).attr("data-department") === department) &&
        ((!search || $(this).attr("data-first").toLowerCase().indexOf(search.toLowerCase()) >= 0 ) ||
        (!search || $(this).attr("data-last").toLowerCase().indexOf(search.toLowerCase()) >= 0 ) ||
        (!search || $(this).attr("data-email").toLowerCase().indexOf(search.toLowerCase()) >= 0 )) &&
        (location === 'all' || $(this).attr("data-location") === location)
    });
    boxes.show();
  
};  

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
