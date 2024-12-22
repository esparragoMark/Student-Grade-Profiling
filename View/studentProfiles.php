<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/studentProfile.css">
    <link rel="stylesheet" href="../assets/css/modalDesign.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Student Profile</title>
</head>

<body>

    <div id="responseMessage">
        <button class="closeAlertBtn">&times;</button>
        <span id="responseText"></span>
    </div>


    <div class="studentProfileCon">

        <div class="studentProfileNav">
            <div class="form-group-studentProfile">
                <label for="schoolYear">School Year:</label>
                <select name="schoolYear" id="schoolYear">
                </select>
            </div>

            <div class="form-group-studentProfile">
                <label for="gradeLevel">Grade Level:</label>
                <select name="gradeLevel" id="gradeLevel">
                </select>
            </div>

            <div class="form-group-studentProfile">
                <label for="section">Section:</label>
                <select name="section" id="section">
                </select>
            </div>

            <div class="form-group-studentProfile">
                <label for="subject">Subject:</label>
                <select name="subject" id="subject">
                </select>
            </div>
        </div>

        <!-- table -->
        <table class="table">
            <thead class="studProf-thead">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>LRN</th>
                    <th>Birth Date</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Grade Level</th>
                    <th>Section</th>
                    <th>School Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data rows will be injected here -->
            </tbody>
        </table>

    </div>

    <!-- Modal for displaying student analytics -->
    <div id="analyticsModal" style="display:none;" class="analytic-modal">
        <div class="analytic-modal-content">
            <!-- Close Button -->
            <button id="closeModal"> <i class="bi bi-x"></i> </button>

            <h2 style="margin-bottom: 1rem">STUDENT DATA ANALYTICS</h2>
            <!-- Grid for 2x2 layout -->
            <div class="chart-container">
                <!-- 1st Quarter -->
                <div class="quarter-chart">
                    <h3>1st Quarter</h3>
                    <canvas id="q1Canvas"></canvas>
                    <p id="q1QuarterlyGrade"></p>
                </div>

                <!-- 2nd Quarter -->
                <div class="quarter-chart">
                    <h3>2nd Quarter</h3>
                    <canvas id="q2Canvas"></canvas>
                    <p id="q2QuarterlyGrade"></p>
                </div>

                <!-- 3rd Quarter -->
                <div class="quarter-chart">
                    <h3>3rd Quarter</h3>
                    <canvas id="q3Canvas"></canvas>
                    <p id="q3QuarterlyGrade"></p>
                </div>

                <!-- 4th Quarter -->
                <div class="quarter-chart">
                    <h3>4th Quarter</h3>
                    <canvas id="q4Canvas"></canvas>
                    <p id="q4QuarterlyGrade"></p>
                </div>
            </div>

        </div>
    </div>

    <!--Delete Modal -->
    <div id="deleteStudentModal" class="modal">

        <div class="modal-content">
            <span class="close" id="closeDeleteModal">&times;</span>
            <h2>Delete Student</h2>
            <p id="deleteMessage"></p>
            <form id="deleteStudentForm">
                <input type="hidden" id="deleteStudentId" name="studentId">
                <div class="modal-actions">
                    <button type="submit" class="delete-modal-btn danger">Delete</button>
                    <button type="button" class="delete-modal-btn cancel" id="cancelDelete">Cancel</button>
                </div>
            </form>
        </div>

    </div>

    <!-- Modal For edit  -->
    <div id="editStudentModal" class="modal">
        <div class="modal-content" style="margin-top: 14rem">
            <span class="close" id="edit_closeModal">&times;</span>
            <h2>Edit Student Information</h2>
            <form id="editStudentForm">
                <input type="hidden" name="studentID" id="edit_studentId">
                <div class="form-group">
                    <label for="edit_firstName">First Name</label>
                    <input type="text" id="edit_firstName" name="edit_firstName" placeholder="Enter First Name..." required>
                </div>
                <div class="form-group">
                    <label for="edit_secondName">Second Name</label>
                    <input type="text" id="edit_lastName" name="edit_lastName" placeholder="Enter Second Name..." required>
                </div>
                <div class="form-group">
                    <label for="edit_gender">Gender</label>
                    <select id="edit_gender" name="edit_gender" required>
                        <option value="" disabled selected>--Select Gender--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_LRN">Student LRN</label>
                    <input type="text" id="edit_LRN" name="edit_LRN" placeholder="Enter LRN..." required>
                </div>
                <div class="form-group">
                    <label for="edit_birthDate">Birth Date</label>
                    <input type="date" id="edit_birthDate" name="edit_birthDate" required>
                </div>
                <div class="form-group">
                    <label for="edit_contactNum">Contact No.</label>
                    <input type="text" id="edit_contactNum" name="edit_contactNum" placeholder="Enter Contact No..." required>
                </div>
                <div class="form-group">
                    <label for="edit_email">Email</label>
                    <input type="email" id="edit_email" name="edit_email" placeholder="Enter Email Addresss..." required>
                </div>
                <div class="form-group">
                    <label for="edit_subject">Subject</label>
                    <input type="text" id="edit_subject" name="edit_subject" placeholder="Enter Subject..." required>
                </div>
                <div class="form-group">
                    <label for="edit_gradeLevel">Grade Level</label>
                    <input type="text" id="edit_gradeLevel" name="edit_gradeLevel" placeholder="Enter Grade Level..." required>
                </div>
                <div class="form-group">
                    <label for="edit_section">Section</label>
                    <input type="text" id="edit_section" name="edit_section" placeholder="Enter Section..." required>
                </div>
                <div class="form-group">
                    <label for="edit_schoolYear">School Year</label>
                    <input type="text" id="edit_schoolYear" name="edit_schoolYear" placeholder="Enter School Year..." required>
                </div>
                <button type="submit" class="modal-btn">
                    <i class="bi bi-save"></i> Save Now
                </button>
            </form>
        </div>
    </div>

    <script src="../assets/js/jquery.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize the table and select filters
        updateTable();
        filterSelectFill("schoolYear", "school_year");
        filterSelectFill("gradeLevel", "grade_level");
        filterSelectFill("section", "section");
        filterSelectFill("subject", "class_name");

        // Event listener for input changes to filter data
        $('#schoolYear, #gradeLevel, #section, #subject').on('change input', function() {
            updateTable();
        });

        // Function to dynamically update the table based on filters
        function updateTable() {
            const school_year = $("#schoolYear").val();
            const grade_level = $("#gradeLevel").val();
            const section = $("#section").val();
            const class_name = $("#subject").val();

            $.ajax({
                url: '../Controller/getStudentProfileController.php',
                type: 'POST',
                data: {
                    school_year: school_year,
                    grade_level: grade_level,
                    section: section,
                    class_name: class_name
                },
                dataType: 'json',
                beforeSend: function() {
                    $('table tbody').html('<tr><td colspan="12">Loading...</td></tr>');
                },
                success: function(response) {
                    let tableBody = $('table tbody');
                    tableBody.empty();

                    if (response.success) {
                        response.data.forEach(function(item) {
                            let content = `
                                    <tr>
                                        <td>${item.first_name}</td>
                                        <td>${item.last_name}</td>
                                        <td>${item.gender}</td>
                                        <td>${item.student_LRN}</td>
                                        <td>${item.date_of_birth}</td>
                                        <td>${item.contact_number}</td>
                                        <td>${item.email}</td>
                                        <td>${item.class_name}</td>
                                        <td>${item.grade_level}</td>
                                        <td>${item.section}</td>
                                        <td>${item.school_year}</td>  
                                        <td class="studentPro-btn">
                                            <button class="btn btn-primary edit" data-id="${item.student_id}">
                                                <i class="bi bi-pencil"></i> 
                                            </button>
                                            <button class="btn btn-info" data-id="${item.student_id}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-danger" data-id="${item.student_id}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            tableBody.append(content);
                        });

                        // Event listener for the "View Analytics" button
                        $('button.btn-info').on('click', function() {
                            const studentId = $(this).data('id');
                            loadStudentAnalytics(studentId);
                        });

                        $('button.btn-danger').on('click', function() {
                            let studID = $(this).data("id");
                            let studName = $(this).closest('tr').find('td:nth-child(1)')
                                .text();

                            console.log(studID);
                            console.log(studName);

                            $('#deleteMessage').text(
                                `Are you sure you want to delete ${studName}?`);
                            $('#deleteStudentId').val(studID);
                            $("#deleteStudentModal").fadeIn();
                        })


                    } else {
                        tableBody.append('<tr><td colspan="12">No data available</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred while fetching the data.");
                }
            });
        }

        // Function to load student analytics data and display in charts
        function loadStudentAnalytics(studentId) {
            // Close and reset modal before showing new data
            $('#analyticsModal').hide(); // Hide modal first
            $('#analyticsModal').find('canvas').each(function() {
                // Reset the canvas for each chart to clear any previous data
                const chart = Chart.getChart(this);
                if (chart) {
                    chart.destroy(); // Destroy the previous chart
                }
            });

            $.ajax({
                url: '../Controller/StudentAnalyticsController.php',
                type: 'POST',
                data: {
                    student_id: studentId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        const data = response.data;

                        // Display the quarterly grades below each chart
                        $('#q1QuarterlyGrade').text('Quarterly Grade: ' + data.q1_quarterly_grade);
                        $('#q2QuarterlyGrade').text('Quarterly Grade: ' + data.q2_quarterly_grade);
                        $('#q3QuarterlyGrade').text('Quarterly Grade: ' + data.q3_quarterly_grade);
                        $('#q4QuarterlyGrade').text('Quarterly Grade: ' + data.q4_quarterly_grade);

                        // 1st Quarter Chart
                        new Chart(document.getElementById('q1Canvas'), {
                            type: 'bar',
                            data: {
                                labels: ['Written Works', 'Performance Tasks',
                                    'Quarterly Assessment', 'Quarterly Grade'
                                ],
                                datasets: [{
                                    label: '1st Quarter',
                                    data: [data.q1_written_works, data
                                        .q1_performance_tasks, data
                                        .q1_quarterly_assessment, data
                                        .q1_quarterly_grade
                                    ],
                                    backgroundColor: ['#FF6384', '#36A2EB',
                                        '#FFCE56', '#FF5733'
                                    ] // Added a color for quarterly grade
                                }]
                            }
                        });

                        // 2nd Quarter Chart
                        new Chart(document.getElementById('q2Canvas'), {
                            type: 'bar',
                            data: {
                                labels: ['Written Works', 'Performance Tasks',
                                    'Quarterly Assessment', 'Quarterly Grade'
                                ],
                                datasets: [{
                                    label: '2nd Quarter',
                                    data: [data.q2_written_works, data
                                        .q2_performance_tasks, data
                                        .q2_quarterly_assessment, data
                                        .q2_quarterly_grade
                                    ],
                                    backgroundColor: ['#FF6384', '#36A2EB',
                                        '#FFCE56', '#FF5733'
                                    ] // Added a color for quarterly grade
                                }]
                            }
                        });

                        // 3rd Quarter Chart
                        new Chart(document.getElementById('q3Canvas'), {
                            type: 'bar',
                            data: {
                                labels: ['Written Works', 'Performance Tasks',
                                    'Quarterly Assessment', 'Quarterly Grade'
                                ],
                                datasets: [{
                                    label: '3rd Quarter',
                                    data: [data.q3_written_works, data
                                        .q3_performance_tasks, data
                                        .q3_quarterly_assessment, data
                                        .q3_quarterly_grade
                                    ],
                                    backgroundColor: ['#FF6384', '#36A2EB',
                                        '#FFCE56', '#FF5733'
                                    ] // Added a color for quarterly grade
                                }]
                            }
                        });

                        // 4th Quarter Chart
                        new Chart(document.getElementById('q4Canvas'), {
                            type: 'bar',
                            data: {
                                labels: ['Written Works', 'Performance Tasks',
                                    'Quarterly Assessment', 'Quarterly Grade'
                                ],
                                datasets: [{
                                    label: '4th Quarter',
                                    data: [data.q4_written_works, data
                                        .q4_performance_tasks, data
                                        .q4_quarterly_assessment, data
                                        .q4_quarterly_grade
                                    ],
                                    backgroundColor: ['#FF6384', '#36A2EB',
                                        '#FFCE56', '#FF5733'
                                    ] // Added a color for quarterly grade
                                }]
                            }
                        });

                        // Show the modal with charts
                        $('#analyticsModal').show();
                    } else {
                        alert(
                            "No analytics data found for the student. Add it First in specific Quarter!");
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred while fetching analytics data.");
                }
            });

            // Open the modal with charts
            $('#analyticsModal').addClass('open');
        }


        // Close the modal
        $('#closeModal').on('click', function() {
            $('#analyticsModal').hide(); // Hide modal on close
        });

        // Function to fill dynamic select options
        function filterSelectFill(selectOptionId, selectValue) {
            $.ajax({
                url: '../Controller/getStudDataController.php',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    let selectOption = $(`#${selectOptionId}`);
                    selectOption.empty();
                    selectOption.append('<option value="" selected disabled>--Select--</option>');

                    if (response.success) {
                        let uniqueVal = new Set();

                        response.data.forEach(function(student) {
                            uniqueVal.add(student[selectValue]);
                        });

                        uniqueVal.forEach(function(value) {
                            let option = `<option value="${value}">${value}</option>`;
                            selectOption.append(option);
                        });
                    } else {
                        selectOption.append('<option value="" disabled>No Data Available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error while loading select options.");
                }

            });
        }


        // delete section
        $('#closeDeleteModal, #cancelDelete').click(function() {
            $("#deleteStudentModal").fadeOut();
        });


        $("#deleteStudentForm").submit(function(e) {

            e.preventDefault();

            const studId = $('#deleteStudentId').val();

            $.ajax({
                url: "../Controller/deleteStudentController.php",
                type: 'POST',
                data: {
                    studId: studId
                },
                dataType: "json",
                success: function(response) {
                    $("#responseText").text(response.message);
                    const classType = response.success ? 'success' : 'error';
                    $("#responseMessage").removeClass("error success").addClass(
                        `display ${classType}`);
                    if (response.success) {
                        $("#deleteStudentModal").fadeOut();
                        updateTable();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Occured error during data processing", error);
                    alert('Something went wrong in data processing!')
                }
            });
        });

        // alert button to close
        $("#responseMessage .closeAlertBtn").click(function() {
            $("#responseMessage").removeClass("display");
        });


        // edit section
        // Handle Edit button click
        $('body').on('click', 'button.edit', function() {
            let studentIdEdit = $(this).data("id");

            console.log('Edit id', studentIdEdit);
            // Fetch student data
            $.ajax({
                url: '../Controller/getStudentDetailsController.php',
                type: 'POST',
                data: { student_id: studentIdEdit },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Populate the modal fields
                        $('#edit_studentId').val(response.data.student_id);
                        $('#edit_firstName').val(response.data.first_name);
                        $('#edit_lastName').val(response.data.last_name);
                        $('#edit_gender').val(response.data.gender);
                        $('#edit_LRN').val(response.data.student_LRN);
                        $('#edit_birthDate').val(response.data.date_of_birth);
                        $('#edit_contactNum').val(response.data.contact_number);
                        $('#edit_email').val(response.data.email);
                        $('#edit_subject').val(response.data.class_name);
                        $('#edit_gradeLevel').val(response.data.grade_level);
                        $('#edit_section').val(response.data.section);
                        $('#edit_schoolYear').val(response.data.school_year);

                        // Show the modal
                        $('#editStudentModal').fadeIn();
                    } else {
                        alert('Failed to fetch student details. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching student details:", error);
                    alert("An error occurred while fetching the student data.");
                }
            });
        });
        $('#edit_closeModal').on('click', function () {
            $('#editStudentModal').fadeOut();
        });

        // handle for form submission for editing student information
        $('#editStudentForm').on('submit', function(e){
            e.preventDefault();
            $.ajax({

                url: '../Controller/saveEditController.php',
                type: 'POST',
                data: $('#editStudentForm').serialize(),
                dataType: 'json',
                success: function(response){
                    $("#responseText").text(response.message);
                    const classType = response.success ? 'success' : 'error';
                    $("#responseMessage").removeClass("error success").addClass(`display ${classType}`);
                    if (response.success) {
                        $("#editStudentModal").fadeOut();
                        filterSelectFill("schoolYear", "school_year");
                        filterSelectFill("gradeLevel", "grade_level");
                        filterSelectFill("section", "section");
                        filterSelectFill("subject", "class_name");
                        updateTable();
                    }
                },
                error: function(xhr, status, error){
                    console.error("Occured error during data processing", error);
                    alert('Something went wrong in data processing!');
                }
  
            });
        });

    });
    </script>
</body>

</html>