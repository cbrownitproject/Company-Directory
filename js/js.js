// Function to show and hide the edit or delete options when a persons profile is clicked
$(".toggler-enabled").on("click", function() {
    var expdiv = $(this).children("div");
    expdiv.is(":visible")?expdiv.hide():expdiv.show();
});

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



function showModal(data) {
    
    console.log(data);
    //you can do anything with data, or pass more data to this function. i set this data to modal header for example
    $.ajax({
        url: "editEmployee.php",
        type: 'POST',
        dataType: 'json',
        data: {
            id: data
        },
        success: function(result) {
            console.log(result);
            
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
    var department = $(".dept").val();
    var search = $("#search").val();
    var location = $(".loca").val();
  
    $(".box").hide();
    var boxes = $(".box").filter(function(index) {

        return (department === 'all' || $(this).attr("data-department") === department) &&
        ((!search || $(this).attr("data-first").toLowerCase().indexOf(search.toLowerCase()) >= 0 ) ||
        // (!search || $(this).attr("data-last").toLowerCase().indexOf(search.toLowerCase()) >= 0 ) ||
        (!search || $(this).attr("data-email").toLowerCase().indexOf(search.toLowerCase()) >= 0 ) ||
        (!search || $(this).attr("data-id").toLowerCase().indexOf(search.toLowerCase()) >= 0 )) &&
        (location === 'all' || $(this).attr("data-location") === location)
    });
    boxes.show();
  
};
  


$('.confdel').click(function areYouSure() {
    console.log("test");
    if (confirm('Are you sure you want to permanently delete?')) {
        $('.confdel').submit()
    } else {
        return false;
    }
});


  

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
