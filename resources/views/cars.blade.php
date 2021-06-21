@extends('layouts.master')

@section('title')
Dashboard | funda of web IT
@endsection

@section('content')
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Get your driver</title>

</head>
<body>

<div class="container" style="margin-top: 50px;">

    <h4 class="text-center">WASSALNY</h4><br>

    <h5>  Drivers</h5>
    <div class="card card-default">
        <div class="card-body">
            <form id="addCustomer" class="form-inline" method="POST" action="">
                <div class="form-group mb-2">
                    <label for="name" class="sr-only">Name</label>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Name"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="phone" class="sr-only">phone</label>
                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="address" class="sr-only">Address</label>
                    <input id="address" type="text" class="form-control" name="address" placeholder="address"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select name="status" id="status">
                            <option value="not active">not active</option>
                            <option value="active">active</option>                           
                    </select>
                </div>
            
                <button id="submitCustomer" type="button" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
    </div>

    <br>

    <h5> Drivers</h5>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>phone number</th>
            <th>Address</th>
            <th>Status</th>
            <th width="180" class="text-center">Action</th>
        </tr>
        <tbody id="tbody">

        </tbody>
    </table>
</div>

<!-- Update Model -->
<form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Update</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-success updateCustomer">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Model -->
<form action="" method="POST" class="users-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteRecord">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


{{--Firebase Tasks--}}
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "{{ config('services.firebase.api_key') }}",
        authDomain: "{{ config('services.firebase.auth_domain') }}",
        databaseURL: "{{ config('services.firebase.database_url') }}",
        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
    };
    firebase.initializeApp(config);
    var database = firebase.database();
    var lastIndex = 0;
    // Add Data
    $('#submitCustomer').on('click', function () {
        var values = $("#addCustomer").serializeArray();
        var name = values[0].value;
        var email = values[1].value;
        var phone = values[2].value;
        var address = values[3].value;
        var status = values[4].value;
        var userID = lastIndex + 1;
        console.log(values);
        firebase.database().ref('Users/Riders/' + userID).set({
            name: name,
            email: email,
            phone: phone,
            address: address,
            status: status,

        });
        // Reassign lastID value
        lastIndex = userID;
        $("#addCustomer input").val("");
    });
    // Get Data
    firebase.database().ref('Users/Riders/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
        		<td>' + value.name + '</td>\
        		<td>' + value.email + '</td>\
                <td>' + value.phone + '</td>\
                <td>' + value.address + '</td>\
                <td>' + value.status + '</td>\
        		<td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="' + index + '">Update</button>\
        		<button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
        	</tr>');
            }
            lastIndex = index;
        });
        $('#tbody').html(htmls);
        $("#submitUser").removeClass('desabled');
    });
   // Update Data
   var updateID = 0;
    $('body').on('click', '.updateData', function () {
        updateID = $(this).attr('data-id');
        firebase.database().ref('Users/Riders/' + updateID).on('value', function (snapshot) {
            var values = snapshot.val();
            var updateData = '<div class="form-group">\
		        <label for="first_name" class="col-md-12 col-form-label">Name</label>\
		        <div class="col-md-12">\
		            <input id="first_name" type="text" class="form-control" name="name" value="' + values.name + '" required autofocus>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="last_name" class="col-md-12 col-form-label">Email</label>\
		        <div class="col-md-12">\
		            <input id="last_name" type="text" class="form-control" name="email" value="' + values.email + '" required autofocus>\
		        </div>\
                <div class="form-group">\
		        <label for="phone" class="col-md-12 col-form-label">Phone</label>\
		        <div class="col-md-12">\
		            <input id="phone" type="text" class="form-control" name="phone" value="' + values.phone + '" required autofocus>\
		        </div>\
                <div class="form-group">\
		        <label for="address" class="col-md-12 col-form-label">Address</label>\
		        <div class="col-md-12">\
		            <input id="address" type="text" class="form-control" name="address" value="' + values.address + '" required autofocus>\
		        </div>\
                <div class="form-group">\
		        <label for="status" class="col-md-12 col-form-label">status</label>\
		        <div class="col-md-12">\
		            <input id="status" type="text" class="form-control" name="status" value="' + values.status + '" required autofocus>\
		        </div>\
		    </div>';
            $('#updateBody').html(updateData);
        });
    });
    $('.updateCustomer').on('click', function () {
        var values = $(".users-update-record-model").serializeArray();
        var postData = {
            name: values[0].value,
            email: values[1].value,
            phone: values[2].value,
            address: values[3].value,
            status: values[4].value,
        };
        var updates = {};
        updates['Users/Riders/' + updateID] = postData;
        firebase.database().ref().update(updates);
        $("#update-modal").modal('hide');
    });
    // Remove Data
    $("body").on('click', '.removeData', function () {
        var id = $(this).attr('data-id');
        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });
    $('.deleteRecord').on('click', function () {
        var values = $(".users-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('Users/Riders/' + id).remove();
        $('body').find('.users-remove-record-model').find("input").remove();
        $("#remove-modal").modal('hide');
    });
    $('.remove-data-from-delete-form').click(function () {
        $('body').find('.users-remove-record-model').find("input").remove();
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
@endsection

@section('scripts')
@endsection