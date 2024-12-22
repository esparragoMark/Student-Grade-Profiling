<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/teacherAccount.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <title>Document</title>
</head>
<body>
    <div id="responseMessage">
        <button class="closeAlertBtn">&times;</button>
        <span id="responseText"></span>
    </div>
    <div class="teacherAccountCon">

        <div class="account_wrapper">
            <div class="image-wrapper">
                <img src="" id="image" alt="profile">
                <button id="imageButtonEdit"> <i class="bi bi-arrow-repeat"></i></button>
                <input type="file" id="imageUpload" style="display: none;">
            </div>

            <div class="input_wrapper">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" readonly required>
                </div>
                <div class="form-group">
                    <p>Change Username or Password?</p>
                    <label for="username">Username</label>
                    <input type="email" id="email" readonly required>
                    <label for="password">Password</label>
                    <input type="password" id="password" readonly required>
                </div>

                <div class="btn_wrapper">
                    <button id="edit_button"><i class="bi bi-pencil"></i> Edit</button>
                    <button id="save_button"><i class="bi bi-save"></i> Save</button>
                </div>
            </div>

        </div>
    </div>



    <script src="../assets/js/jquery.js"></script>

    <script>
    $(document).ready(function() {

        retrieveData();

        function retrieveData() {
            $.ajax({
                url: '../Controller/retriveUserData.php',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#name').val(response.data.name);
                        $('#email').val(response.data.username);
                        $('#password').val(response.data.password);

                        let image = response.data.image;
                        if (image == null) {
                            $('#image').attr('src', '../assets/image/profile.jpg');
                        } else {
                            $('#image').attr('src', image);
                        }
                    } else {
                        alert("Failed to fetch user data.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error retrieving user data:", error);
                    alert("An error occurred while fetching the data. Please try again later.");
                }
            });
        }

        $('#edit_button').click(function() {
            $('#name, #email, #password').prop('readonly', false);
            $('#save_button').show();
            $(this).hide();
        });

        // handles the saving the data
        $('#save_button').click(function() {
            // Get the updated data from the input fields
            let updatedName = $('#name').val();
            let updatedEmail = $('#email').val();
            let updatedPassword = $('#password').val();

            // Validate data (optional, you can add more validation checks)
            if (updatedName === "" || updatedEmail === "" || updatedPassword === "") {
                alert("All fields are required.");
                return;
            }

            // Prepare the data to send
            let formData = {
                name: updatedName,
                email: updatedEmail,
                password: updatedPassword
            };

           
            $.ajax({
                url: '../Controller/updateUserData.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $("#responseText").text(response.message);
                    const classType = response.success ? "success" : "error";
                    $("#responseMessage").removeClass("error success").addClass(`display ${classType}`);

                    if (response.success) {
                        // Optionally hide the edit and save buttons
                        $('input').prop('readonly', true);
                        $('#edit_button').show();
                        $('#save_button').hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error updating user data:", error);
                    alert("An error occurred while updating the data.");
                }
            });
        });


        // image upload 
        $('#imageButtonEdit').click(function() {
            $('#imageUpload').click(); 
        });

        // Handle the image file selection
        $('#imageUpload').change(function(e) {
            var formData = new FormData();
            var file = e.target.files[0];

            if (file) {
                formData.append('image', file);

                // Send the image file to the server via AJAX
                $.ajax({
                    url: '../Controller/uploadImage.php',  // Your upload PHP script
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#responseText").text(response.message);
                        const classType = response.success ? "success" : "error";
                        $("#responseMessage").removeClass("error success").addClass(`display ${classType}`);
                        if (response.success) {
                            // Update the image preview
                            $('#image').attr('src', response.data.image);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error uploading image:", error);
                        alert("An error occurred while uploading the image.");
                    }
                });
            }
        });


        // NOTIFICATION
        $("#responseMessage .closeAlertBtn").click(function () {
                $("#responseMessage").removeClass("display");
        });
    });
</script>

</body>
</html>