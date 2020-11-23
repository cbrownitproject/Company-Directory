// Function to show and hide the edit or delete options when a persons profile is clicked
$(".toggler-enabled").on("click", function() {
    var expdiv = $(this).children("div");
    expdiv.is(":visible")?expdiv.hide():expdiv.show();
});

// Function to show and hide the advacned search options when a persons profile is clicked
$("#advanced-button").on("click", function() {
    var button = $("#advanced-button");
    button.hide();
    var deploc = button.siblings("select");
    deploc.is(":visible")?deploc.hide():deploc.show();
    var rembutton = button.siblings("a");
    rembutton.is(":visible")?rembutton.hide():rembutton.show();
});

$("#remove-button").on("click", function() {
    var rembutton = $("#remove-button");
    rembutton.hide();
    var deploc = rembutton.siblings("select");
    deploc.is(":visible")?deploc.hide():deploc.show();
    var advance = rembutton.siblings("a");
    advance.is(":visible")?advance.hide():advance.show();
});

    $.ajax({
            url: "depList.php",
            type: 'POST',
            dataType: 'json',
            success: function(result) {
                console.log(result);
                //echo '<option value='.$row['id'].'>'.$row['name'].'</option>'; 
                for (i=0; i<result.length; i++) {

                    $("#depSel").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
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
                console.log(result);
                //echo '<option value='.$row['id'].'>'.$row['name'].'</option>'; 
                for (i=0; i<result.length; i++) {

                    $("#locSel").append('<option value=' + result[i]['id'] + '>' + result[i]['name'] + '</option>')
                }

            },
            error: function(jqXHR, exception){
                errorajx(jqXHR, exception);
                console.log("Get Locaiton");
            }
        }); 
// $.ajax({
//     url: "getall.php",
//     type: 'POST',
//     dataType: 'json',
//     success: function(result) {
//         $.each(result, function(index) {
//             $('#myUL').append('<li><div class="list-group-item list-group-item-action flex-column align-items-start toggler-enabled" id="profile"><a><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">' + result[index]['firstName'] + ' ' +  result[index]['lastName'] + '</h5><small>' + result[index]['id'] + '</small></div><div><p class="mb-1">' + result[index]['email'] + '</p><p class="mb-1">' + result[index]['department'] + '</p><p class="mb-1">' + result[index]['location'] + '</p></div></a><div class="container" id="edit-delete"><button type="button" class="col-5" id="edit" data-toggle="modal"  data-target="#edit-modal"> Edit </button><form action="delete.php" method="post"><button type="submit" name="id" value=' + result[index]['id'] + '>Delete</button></form></div></div></li>'); 
//         }); 
        
//     },
//     error: function(jqXHR, exception){
//         errorajx(jqXHR, exception);
//         console.log("Option select");
//     }
// }); 

// Search through list function
function search() {
    var input, filter, ul, li, a, i, txtValue;
    // Set input as the value in the text search
    input = document.getElementById("myInput");
    // Convert the text search to all uppercase
    filter = input.value.toUpperCase();
    // Set ul as the ul element which is the personnel list
    ul = document.getElementById("myUL");
    // Set the li ans the indivdual personnel
    li = ul.getElementsByTagName("li");
    // Loop through the entire list 
    for (i = 0; i < li.length; i++) {
        // Set a as the element of a which is contains all the information such as name 
        a = li[i].getElementsByTagName("a")[0];
        // Sets txt value to the text content of the node and all its decendants using .textContent and using .innetText
        // does the same but is aware of rendered text too so no information is missed
        txtValue = a.textContent || a.innerText;
        // Conditional statement to compare the text content set to uppercase to the index of it in the filter string if the text is in the results
        // the position is given which will be greater than one, if there is no result for it then a -1 is given
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            // If result matches search the display is kept the same keeping it visible
            li[i].style.display = "";
        } else {
            // If the result does not match the item is hidden
            li[i].style.display = "none";
        }
    }
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



//  Function to 
// function reduce() {
//     var result = confirm("Are you sure you want to permanently delete?");
//     if (result) {
//     //Logic to delete the item
// }
// };
// function sure() {
//     confirm("Are you sure you want to permanently delete?")
// };

/*
function profile(first, last, ID, jobTitle, email, department, location) {
    '<div>' +
        '<a class="list-group-item list-group-item-action flex-column align-items-start toggler-enabled" >' +
        '<div class="d-flex w-100 justify-content-between">' +
            '<h5 class="mb-1">' + first + last +'</h5>' +
            '<small>' + ID + '</small>' +
        '</div>' +
        '<div>' +
        '<p class="mb-1">' + jobTitle + '</p>' +
        '<p class="mb-1">' + email + '</p>' +
        '<p class="mb-1">' + department + '</p>' +
        '<p class="mb-1">' + location +'</p>' +
        '</div>' +
        '</a>' +
        '<div class="container" id="edit-delete">' +
        '<button type="button" class="col-5" id="edit"> Edit </button>' +
        '<button type="button" class="col-5" id="delete" data-toggle="modal"  data-target="#delete-modal"> Delete </button>' +
        '</div>' +
    '</div>'
};


$.ajax({
    url: "libs/php/getAll.php",
    type: 'POST',
    dataType: 'json',
    success: function(result) {
        console.log(result);
    },
    error: function(jqXHR, exception){
        errorajx(jqXHR, exception);
        console.log("Option select");
    }
}); 
*/
