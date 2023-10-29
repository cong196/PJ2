<!DOCTYPE html>
<html>
<head>
    <title>Add Tag Terms</title>
    <!-- Include Bootstrap CSS here -->
    <link rel="icon" href="/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .tag-term {
            display: inline-block;
            font-size: 14px;
            font-weight: 600;
            background-color: #8ea7ff;
            border: none;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 20px; /* Rounded pill shape */
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .tag-term:hover {
           
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .tag-term:active {
            background-color: #004492;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(1px);
        }
        .notification {
            display: none;
            padding: 10px 10px;
            background-color: #4CAF50;
            color: white;
            position: fixed;
            top: 10px;
            right: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .error {
            background-color: #f44336;
        }
    </style>

</head>
<body>
   <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
  <div class="container">
    <a class="navbar-brand" href="/PJ2/">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="themegateeDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Themegatee
          </a>
          <div class="dropdown-menu" aria-labelledby="themegateeDropdown">
            <a class="dropdown-item" href="/PJ2/themegatee.php">Create Post</a>
            <a class="dropdown-item" href="/PJ2/themegatee-editproduct.php?page=1&perpage=10&searchTitle=">Edit product</a>
            <a class="dropdown-item" href="/PJ2/themega-editdraftproduct.php?page=1&perpage=10&sort_by=1&searchTitle=">Edit draft product</a>
            <a class="dropdown-item" href="/PJ2/themega_editdraftproduct.php?page=1&perpage=10&sort_by=1&searchTitle=">Edit draft</a>
            <a class="dropdown-item" href="/PJ2/append_tag_terms.php">Edit terms tags</a>
            <a class="dropdown-item" href="/PJ2/product_type_terms.php">Edit term product type</a>
            <a class="dropdown-item" href="/PJ2/themegatee-setting.php">Setting</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="kacogiftsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kacogifts
          </a>
          <div class="dropdown-menu" aria-labelledby="kacogiftsDropdown">
            <a class="dropdown-item" href="/PJ2/kacogifts-editdraftproduct.php?page=1&perpage=10&searchTitle=">Edit draft product</a>
            <a class="dropdown-item" href="/PJ2/kacogifts-setting.php">Setting</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>


   </div>

    <div class="container mt-5">
        <h2>Add Tag Terms</h2>
        <form id="tagTermForm">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tagTerm" name="tagTerm" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
        <div id="responseMessage"></div>
    </div>

    <div class="container mt-3">
        <h2>Tag Terms in Database:</h2>
        <div id="tagTermsList">
            <?php include 'get_tag_terms.php'; ?>
        </div>
    </div>

    <div id="notification" class="notification">
        <p>Success! Save was completed.</p>
    </div>
    <div id="errorNotification" class="notification error">
        <p>Error! Something went wrong.</p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#tagTermForm").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var tagTermInput = $("#tagTerm");
                $.ajax({
                    type: "POST",
                    url: "process_tag_term.php",
                    data: formData,
                    success: function(response) {
                        tagTermInput.val('');
                        $("#responseMessage").html(response);
                        setTimeout(function() {
                            $("#responseMessage").fadeOut();

                        }, 1000);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function() {
                        alert("Error processing the request.");
                    }
                });
            });
        });

        $('.tag-term').on('dblclick', function() {

            const originalText = $(this).text();
            $(this).attr('contentEditable', 'true').focus();

            $(this).on('blur', function() {
                $(this).attr('contentEditable', 'false');
                const newText = $(this).text();
                
                if (newText !== originalText) {
                    saveToDatabase(newText, originalText);
                }
            });
        });

        function saveToDatabase(newText, originalText) {
            $.ajax({
                type: "POST",
                url: "update_tag_term.php",
                data: {newText:newText,originalText:originalText},
                cache: false,
                success: function(data) {
                   if(data == "1") {
                        showNotification();
                   } else {
                        alert("Edit falied !");
                   }
              }
            });
        }

        function showNotification() {
            const notification = document.getElementById('notification');
            notification.style.display = 'block';

            setTimeout(() => {
                notification.style.display = 'none';
            }, 1500);
        }
        function showErrorNotification() {
            const errorNotification = document.getElementById('errorNotification');
            errorNotification.style.display = 'block';

            setTimeout(() => {
                errorNotification.style.display = 'none';
            }, 1500);
        }

    </script>
</body>
</html>
