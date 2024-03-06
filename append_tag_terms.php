<?php
    session_start();
      if(isset($_SESSION['PJ2_loggedin']) && $_SESSION['PJ2_loggedin'] === true) {
          
      } else {
          header("location: login.php");
          exit;
      }


      // Xử lý logout nếu người dùng bấm nút "Đăng xuất"
      if(isset($_POST['logout'])) {
          // Xóa tất cả các biến session
          session_unset();
          // Hủy phiên
          session_destroy();
          // Chuyển hướng người dùng đến trang đăng nhập
          header("location: login.php");
          exit;
      }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tag Terms</title>
    <link rel="icon" href="/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/PJ2/custom_css.css">

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
   <?php include 'topbar.php'; ?>
<!-- Bootstrap row -->
<div class="row" id="body-row">
    <!-- Sidebar -->
    <?php include 'slider_bar.php'; ?>
    <!-- sidebar-container END -->
    <!-- MAIN -->
    <div class="col p-4">


    
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
   
  
        <h2>Tag Terms in Database:</h2>
        <div id="tagTermsList">
            <?php include 'get_tag_terms.php'; ?>
        </div>
   

    <div id="notification" class="notification">
        <p>Success! Save was completed.</p>
    </div>
    <div id="errorNotification" class="notification error">
        <p>Error! Something went wrong.</p>
    </div>
</div>
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
