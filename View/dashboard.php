<?php
include("../middleware/middleware.php");

// $id = $_SESSION['user_id'];
// $username = $_SESSION['user_name'];
// $role = $_SESSION['user_role'];
// $token = $_SESSION['user_token'];

// echo $id;
// echo "<br>";
// echo $username;
// echo "<br>";
// echo $role;
// echo "<br>";
// echo $token;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/modalDesign.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="topnav">
                <h2 style="color:#FFFFFF">EPSGP</h2>
                <button id="btn-humberger">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <?php
                if($_SESSION['user_role'] == 'Admin')
                {
             ?>
                <!-- admin contol panel-->
                <a href="#" class="btn active">
                    <i class="bi bi-speedometer2 link-icon"></i><span>Dashboard</span>
                </a>
                <a href="#" class="btn">
                    <i class="bi bi-lock link-icon"></i><span>Account</span>
                </a>
                <a href="#" class="btn">
                    <i class="bi bi-people link-icon"></i><span>Student</span>
                </a>
                <a href="#" class="btn">
                    <i class="bi bi-person-circle link-icon"></i><span>Admin Account</span>
                </a>
        
            <?php
                 }
                 else{
            ?>
                <!-- teacher control panel -->
                
                <a href="#" class="btn active">
                    <i class="bi bi-journal-text link-icon"></i><span>Class Records</span>
                </a>
                <a href="#" class="btn">
                    <i class="bi bi-person-plus link-icon"></i><span>Add Student</span>
                </a>
                <a href="#" class="btn">
                    <i class="bi bi-people link-icon"></i><span>Student Profiles</span>
                </a>
                <a href="#" class="btn ">
                    <i class="bi bi-person-circle link-icon"></i><span>Teacher Account</span>
                </a>
                <!-- <a href="#" class="btn">
                    <i class="bi bi-file-earmark-bar-graph link-icon"></i><span>Reports</span>
                </a> -->

            <?php
                 }
            ?>
           
            <a href="#" id="logout" style="position: absolute; bottom: 0px; width: 100%">
                <i class="bi bi-box-arrow-right link-icon"></i><span>Logout</span>
            </a>
        </div>

        <div class="main">
            <div class="navbar">
                <h2 id="topNav-text">Dashboard</h2>
                <img src="../assets/image/epsgp_logo.jpg" alt="profile">
            </div>
            <div class="content" id="content"></div>
        </div>
    </div>


    <!-- logout Modal -->

    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closelogoutModal">&times;</span>
            <h2>Logout</h2>
            <p>Are you sure you want to Logout?</p>
            <div class="modal-actions">
                <button type="submit" class="delete-modal-btn danger" id="confirmLogout">Yes</button>
                <button type="button" class="delete-modal-btn cancel" id="cancelLogout">Cancel</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.js"></script>
    <script>

        var userRole = "<?php echo $_SESSION['user_role']; ?>"; 

        $(document).ready(function () {

            // Object of file paths
            const contentFiles = {
                // ADMIN ROUTES
                "Dashboard": "adminDashboard.php",
                "Account": "account.php",         
                "Student": "student.php",          
                "Admin Account": "adminAccount.php",          

                // TEACHER ROUTES      
                "Class Records": "classrecord.php", 
                "Add Student": "addStudent.php",
                "Student Profiles": "studentProfiles.php",   
                "Teacher Account": "teacherAccount.php",
                // "Reports": "reports.php" 
            };

             // Set default file based on user role
            let defaultPath;
            let defaultText;

            if (userRole === 'Admin') {
                defaultPath = contentFiles['Dashboard'];
                defaultText = "Dashboard";
            } else if (userRole === 'Teacher') {
                defaultPath = contentFiles['Class Records'];
                defaultText = "Class Records";
            }

            // Load the default content based on user role
            $("#content").load(defaultPath);
            $("#topNav-text").text(defaultText);


            // default load file
            // const defaultPath = contentFiles['Class Records'];
            // $("#content").load(defaultPath);
            // $("#topNav-text").text("Class Records");

            // /side bar click button
            $(".sidebar .btn").on("click", function () {
                $(".sidebar .btn").removeClass("active");
                $(this).addClass("active");

                const selectedText = $(this).find("span").text();
                $("#topNav-text").text(selectedText);

                const filePath = contentFiles[selectedText];
                if (filePath) {
                    $("#content").load(filePath);
                }
            });


            // button humberger
            $('#btn-humberger').on('click', function() {
                const sidebar = document.querySelector('.sidebar');
                const sidebarSpans = document.querySelectorAll('.sidebar a span'); // Select all <span> elements
                const sidebarLinks = document.querySelectorAll('.sidebar a');
                const topnavText = document.querySelector('.topnav h2');

                if (sidebar.style.width === '260px') {

                    sidebar.style.width = '60px'; 

                    sidebarSpans.forEach(function(span) {
                        span.style.display = "none";
                    });

                    topnavText.style.display = "none"; 
                } else {

                    sidebar.style.width = '260px'; 

                    setTimeout(function() {
                        sidebarSpans.forEach(function(span) {
                            span.style.display = "inline"; 
                        });
                        topnavText.style.display = "inline"; 
                    }, 190)
                }
            });


            // event for handling the logout

            $("#logout").click(function(){  
                $("#logoutModal").fadeIn();
            });

            $("#closelogoutModal, #cancelLogout").click(function () {
                $("#logoutModal").fadeOut();
            });

            $("#confirmLogout").click(function(){
                $.ajax({
                    url: '../Controller/logout.php',
                    method: 'POST',  
                    success: function (response) {
                        window.location.href = '../View/index.php';
                    },
                    error: function () {
                        alert('Error logging out. Please try again.');
                    }
                });
            });

        });

    </script>
</body>

</html>
