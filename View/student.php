<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/adminStudent.css">
    <title>Admin Dashboard</title>

</head>
<body>
    <div class="adminStudentContainer">
        <!-- Search Bar -->
        <div class="adminStudentRowTop">
            <input type="text" id="searchInput" placeholder="Search for records...">
        </div>

        <!-- Table Container -->
        <div class="adminStudentRowBottom">
            <div class="table-responsive">
                <table class="adminStudentTable" id="adminStudentTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Student LRN</th>
                            <th>Date of Birth</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Class Name</th>
                            <th>Grade Level</th>
                            <th>Section</th>
                            <th>School Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be dynamically populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch student data
            function fetchStudents() {
                $.ajax({
                    url: '../Controller/fetchAll_students.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let tableBody = $('#adminStudentTable tbody');
                        tableBody.empty();
                        if (response.success) {
                            response.data.forEach(function(student) {
                                let tr = `
                                    <tr>
                                        <td>${student.first_name}</td>
                                        <td>${student.last_name}</td>
                                        <td>${student.gender}</td>
                                        <td>${student.student_LRN}</td>
                                        <td>${student.date_of_birth}</td>
                                        <td>${student.contact_number}</td>
                                        <td>${student.email}</td>
                                        <td>${student.class_name}</td>
                                        <td>${student.grade_level}</td>
                                        <td>${student.section}</td>
                                        <td>${student.school_year}</td>
                                    </tr>
                                `;
                                tableBody.append(tr);
                            });
                        } else {
                            tableBody.html('<tr><td colspan="12">No records found</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', status, error);
                        alert('Failed to fetch student data. Please try again later.');
                    }
                });
            }

            // Initial fetch
            fetchStudents();

            // Search functionality
            $('#searchInput').on('keyup', function () {
                let value = $(this).val().toLowerCase();
                let isVisible = false;

                $('#adminStudentTable tbody tr').each(function () {
                    if ($(this).text().toLowerCase().indexOf(value) > -1) {
                        $(this).show();
                        isVisible = true;
                    } else {
                        $(this).hide();
                    }
                });

                if (!isVisible) {
                    // Add a temporary row to indicate no matching records
                    if ($('#adminStudentTable tbody tr.no-records').length === 0) {
                        $('#adminStudentTable tbody').append(
                            '<tr class="no-records"><td colspan="12">No matching records found</td></tr>'
                        );
                    }
                } else {
                    // Remove the temporary row if matches are found
                    $('#adminStudentTable tbody tr.no-records').remove();
                }
            });

        });
    </script>
</body>
</html>
