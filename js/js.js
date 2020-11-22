// Function to show and hide the edit or delete options when a persons profile is clicked
$(".toggler-enabled").on("click", function() {
    var expdiv = $(this).children("div");
    expdiv.is(":visible")?expdiv.hide():expdiv.show();
});

// Function to 
function reduce() {
    var result = confirm("Are you sure you want to permanently delete?");
    if (result) {
    //Logic to delete the item
}
};

function sure() {
    confirm("Are you sure you want to permanently delete?")
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


/*
$.each(result.data, function(index) {
    $('.profile-selection').append(profile(
        result.data.first,
        result.data.last,
        result.data.ID,
        result.data.jobTitle,
        result.data.email,
        result.data.department,
        result.data.location,
    )
    /*
        $("<option>", {
        value: result.data[index].code,
        text: result.data[index].name
    })); 
}); 

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
