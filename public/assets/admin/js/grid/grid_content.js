function employeeDetails() {
    // Get selected row IDs
    var $grid = $("#list1");
    var idArray = $grid.getGridParam('selarrrow'); // Array of selected IDs

    // Check if no employee is selected
    if (idArray.length === 0) {
        alert("Please select Employee ID");
        return;
    }

    // Prepare the POST data
    var postData = {        // The first date parameter
        employee_ids: idArray,         // Array of selected employee IDs
        _token: "{{ csrf_token() }}"   // CSRF token for security
    };

    // Use the Laravel route (defined in web.php)
    var url = routes.employeeDetails; // Use Laravel's named route helper

    // AJAX request to send data to the backend
    $.ajax({
        url: url, // Laravel route
        type: 'GET', // POST request
        data: postData,
		beforeSend: function () {
            // Optionally show loader before the request
            showLoader();
        },
        success: function (response) {
            // Open the new window with the URL returned from the backend
            var newWindow = window.open('', 'daily_allowance', "menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
            newWindow.document.write(response); // Write the rendered view (HTML) to the new window
            newWindow.document.close(); 
        },
		complete: function () {
            // Hide the loader after the request completes
            hideLoader();
        },
        error: function (xhr, status, error) {
            console.error("Error generating daily allowance bills:", error);
            console.error("Response:", xhr.responseText);
            alert("An error occurred while generating the daily allowance bills. Please try again.");
        }
    });
}

function grid_all_search(){

	var branch = document.getElementById('filterBranch').value;
	var url = routes.searchByBranch;

	$.ajax({
        url: url,
        type: 'GET',
        data: {
            _token: "{{ csrf_token() }}", 
            branch: branch
        },
        success: function (response) {
			main_grid(response);
        },
        error: function (xhr, status, error) {
            console.error("Error occurred while sending data:", error);
            console.error("Response:", xhr.responseText);
        }
    });
}

function main_grid(data = null) {
    // Check if the grid is already initialized
    if ($("#list1").getGridParam("data")) {
        $("#list1").clearGridData();
        $("#list1").setGridParam({
            datatype: "jsonstring",
            datastr: data,
        }).trigger("reloadGrid");
    } else {
        // Initialize the grid for the first time
        $("#list1").jqGrid({
            datatype: "jsonstring",
            datastr: data,
            colModel: [
                {name: 'id', index: 'id', width: 100, label: 'EMP ID', hidden: false},
                {name: 'emp_full_name', index: 'id', width: 234, label: 'Full Name'}
            ],
			width: 334,
            height: 500,
            rowNum: 20000,
            rowList: [10, 20, 30],
            pager: $('#pager1'),
            sortname: 'id',
            viewrecords: true,
            sortorder: "asc",
            multiselect: true
        }).navGrid('#pager1', { edit: false, add: false, del: false });
    }
}

// function main_grid(data = null) {
	
//     jQuery("#list1").jqGrid({
//         datatype: "jsonstring",
//         datastr: data,
//         colModel: [
//             {name: 'id', index: 'id', width: 100, label: 'EMP ID', hidden: false},
//             {name: 'emp_full_name', index: 'emp_full_name', width: 200, label: 'Full Name'}
//         ],
//         rowNum: 20000,
//         rowList: [10, 20, 30],
//         pager: jQuery('#pager1'),
//         sortname: 'id',
//         viewrecords: true,
//         sortorder: "asc",
//         multiselect: true
//     }).navGrid('#pager1', { edit: false, add: false, del: false });
// }

// function main_grid(url)
// {
// 	jQuery("#list1").jqGrid({
// 	url: url,
// 	datatype: "json",
// 	//width:'600px',
// 	colModel: [
// 		{name:'id',index:'id', width:100, label: 'EMP ID', hidden: false},
// 		{name:'emp_full_name',index:'emp_full_name', width:200, label: 'Full Name'}
// 	],
// 	rowNum:20000, rowList:[10,20,30],
// 	//imgpath: gridimgpath,
// 	pager: jQuery('#pager1'),
// 	sortname: 'id',
// 	viewrecords: true,
// 	sortorder: "asc",
// 	multiselect:true
// 	}).navGrid('#pager1',{ edit:false, add:false, del: false });
 
// }