<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/addStudentDesign.css">
    <title>Document</title>
</head>

<body>
    <div id="responseMessage">
        <button class="closeAlertBtn">&times;</button>
        <span id="responseText"></span>
    </div>

    <div class="con">

        <form id="addStudentForm">

            <div class="form-group">
                <label for="schoolyear">School Year</label>
                <input type="text" name="schoolyear" id="schoolyear" placeholder="YYYY-YYYY" pattern="\d{4}-\d{4}" title="School year format: YYYY-YYYY" required>
            </div>

            <div class="group-container">

                <div class="form-group-container">

                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" placeholder="Enter here..." required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" placeholder="Enter here..."  required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="lrn">LRN No.</label>
                        <input type="text" name="lrn" id="lrn" placeholder="Enter here..." required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter here..."  required>
                    </div>

                </div>

                <div class="form-group-container">

                    <div class="form-group">
                        <label for="birthdate">Birth of Date</label>
                        <input type="date" name="birthdate" id="birthdate">
                    </div>
                    <div class="form-group">
                        <label for="contactNo">Contact No.</label>
                        <input type="text" name="contactNo" id="contactNo" placeholder="Enter here..." required>
                    </div>
                    <div class="form-group">
                        <label for="className">Class Name</label>
                        <input type="text" name="className" id="className" placeholder="Enter here..." required>
                    </div>
                    <div class="form-group">
                        <label for="gradeLevel">Grade Level</label>
                        <input type="text" name="gradeLevel" id="gradeLevel" placeholder="Enter here..." required>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <input type="text" name="section" id="section" placeholder="Enter here..." required>
                    </div>

                </div>

            </div>
            <button type="submit" class="addStudent-btn">
                <i class="bi bi-save"></i> Save Now
            </button>

        </form>

    </div>

    <script src="../assets/js/jquery.js"></script>

    <script>
        $(document).ready(function(){

            // NOTIFICATION
            $("#responseMessage .closeAlertBtn").click(function () {
                $("#responseMessage").removeClass("display");
            });

            // handling the submission request for adding student
            $('#addStudentForm').submit(function(e){

                e.preventDefault();

                $.ajax({
                    url: '../Controller/addStudentController.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response){
                        $("#responseText").text(response.message);
                        const classType = response.success ? "success" : "error";
                        $("#responseMessage").removeClass("error success").addClass(`display ${classType}`);

                        if(response.success)
                        {
                            $('#addStudentForm')[0].reset();
                        }
                    },
                    error: function () {
                        $("#responseText").text("An error occurred. Please try again.");
                        $("#responseMessage").addClass("display error");
                    }
                });
            });

        });
    </script>
</body>

</html>