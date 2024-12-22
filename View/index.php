
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>System</title>
</head>
<body>
     
<div class="text-wrapper">

    <div class="h1_holder">

        <h1 id="text1"></h1>
        <h1 id="text2"></h1>
        <h1 id="text3"></h1>
        <h1 id="text4"></h1>

    </div>
   
    <div class="btn-wrapper">
        <button class="start_btn">Get Started</button>
    </div>
   
</div>

<img src="../assets/image/epsgp_logo.jpg" alt="logo" id="logo" class="logo">

<div class="login-wrapper">

    <form id="loginForm">
        <p id="responseMessage" class=""></p>
        <h1>Login</h1>

        <div class="input-field">
            <label for="username">Username</label>
            <input type="email" id="username" name="username" placeholder="Enter here..." required>
        </div>

        <div class="input-field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter here..." required>
        </div>

        <div class="btn-wrapper">
            <button type="submit" class="login_btn">Login</button>
        </div>
    </form>

   
</div>

<script src="../assets/js/script.js"></script>
<script src="../assets/js/jquery.js"></script>

<script>
        $(document).ready(function () {
            $("#loginForm").submit(function (e) {
                e.preventDefault(); 

                $.ajax({
                    url: "../Controller/LoginController.php", 
                    type: "POST",
                    data: $(this).serialize(), 
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            window.location.href = "dashboard.php?token=" + response.token; 
                        } else {
                            $("#responseMessage").text(response.message); 
                            $("#responseMessage").addClass("displayMessage");
                        }
                    },
                    error: function () {
                        $("#responseMessage").text("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
</script>
</body>
</html>