<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product type terms</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style type="text/css">
        .custom-table {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-table thead {
            background-color: #343a40;
            color: white;
        }

        .custom-table tbody td {
            padding: 0.25rem;
        }

       
        .custom-table td, .custom-table th {
            text-align: center;       /* Horizontal centering */
            vertical-align: middle;   /* Vertical centering */
        }

    </style>
</head>

<body>
<?php include 'menu.php'; ?>

<div class="container mt-5">
    <h2>Add/Edit/Delete Products type terms</h2>

    <!-- Form for adding/editing -->
    <form id="productForm">
        <div class="form-group">
            <label for="txtText">Text:</label>
            <input type="text" class="form-control" id="txtText" name="txtText" required>
        </div>
        <div class="form-group">
            <label for="txtType">Type:</label>
            <input type="text" class="form-control" id="txtType" name="txtType" required>
        </div>
        <button type="button" class="btn btn-primary" id="addBtn">Add</button>
        <!-- Additional buttons for 'edit' and 'delete' can be added as needed -->
    </form>

    <h2 class="mt-5">Product type terms list</h2>
    <table class="table custom-table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Text</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- TODO: Fetch and display entries from the database using AJAX -->
        </tbody>
    </table>
</div>

<!-- AJAX Scripts -->
<script>
    $(document).ready(function() {
        $("#addBtn").click(function() {
            $.ajax({
                url: 'product_type_terms_action.php',
                method: 'POST',
                data: {
                    action: 'add',
                    text: $('#txtText').val(),
                    type: $('#txtType').val()
                },
                dataType: 'json',
                success: function(response) {
                    //console.log(response);
                    if(response.success) {
                        alert('Success !');
                        let txtTextValue = $('#txtText').val();
                        let txtTypeValue = $('#txtType').val();
                        let safeTxtTextValue = txtTextValue.replace(/'/g, "\\'");
                        $('table tbody').append(`<tr><td>${txtTextValue}</td><td>${txtTypeValue}</td><td>
                            <button class="btn btn-outline-info btn-sm btn-edit mr-2" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm btn-delete" onclick="delete_product_type_terms('${safeTxtTextValue}')" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button></td></tr>`);
                        $('#txtText').val('');
                        $('#txtType').val('');
                    }
                     else {
                        alert(response.message);
                    }
                }
            });
        });
    });

    fetchTerms();
    function fetchTerms() {
        $.ajax({
            url: 'product_type_terms_action.php',
            method: 'POST',
            data: {
                action: 'fetch'
            },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    populateTable(response.data);
                } else {
                    alert(response.message);
                }
            }
        });
    }

    function delete_product_type_terms(text) {
        if(confirm("Delete: " + text + "?")) {
            $.ajax({
                url: 'product_type_terms_action.php',
                method: 'POST',
                data: {
                    action: 'delete',
                    text: text
                },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                       $("table tbody tr").each(function() {
                            if($(this).children("td:first").text() === text) {
                                $(this).remove();
                            }
                        });
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    }
    function populateTable(data) {
        var tableBody = $(".table tbody");
        tableBody.empty(); // Clear existing rows

        data.forEach(function(typeterms) {
            let safeText = typeterms.text.replace(/'/g, "\\'");
            var row = "<tr>";
            row += "<td>" + typeterms.text + "</td>";
            row += "<td>" + typeterms.type + "</td>";
            row += `<td>
                <button class='btn btn-outline-info btn-sm btn-edit mr-2' onclick="delete_product_type_terms('${safeText}')" title='Edit'>
                    <i class='fas fa-edit'></i>
                </button>
                <button class='btn btn-outline-danger btn-sm btn-delete' onclick="delete_product_type_terms('${safeText}')" title='Delete'>
                    <i class='fas fa-trash-alt'></i>
                </button>
            </td>`;
            row += "</tr>";

            tableBody.append(row);
        });
    }

</script>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
