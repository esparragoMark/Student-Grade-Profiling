<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/modalDesign.css">
    <link rel="stylesheet" href="../assets/css/classRecord.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <title>Document</title>
</head>
<body>

    <div id="responseMessage">
        <button class="closeAlertBtn">&times;</button>
        <span id="responseText"></span>
    </div>

    <div class="classRecordCon">


        <div class="classRecordNav">

            <div class="form-group-classRecord">
                <label for="schoolYear">School Year:</label>
                <select name="schoolYear" id="schoolYear">
                    <option value="" selected disabled>--Select--</option>
                    <!-- it should be dynamic option -->
                    <option value="2023-2024">2023-2024</option> 
                    <option value="2024-2025">2024-2025</option> 
                </select>
            </div>

            <div class="form-group-classRecord">
                <label for="gradeLevel">Grade Level:</label>
                <select name="gradeLevel" id="gradeLevel">
                    <option value="" selected disabled>--Select--</option>
                    <!-- it should be dynamic option -->
                    <option value="12">12</option> 
                </select>
            </div>

            <div class="form-group-classRecord">
                <label for="section">Section:</label>
                <select name="section" id="section">
                    <option value="" selected disabled>--Select--</option>
                    <!-- it should be dynamic option -->
                    <option value="A">A</option> 
                    <option value="B">B</option> 
                </select>
            </div>

            <div class="form-group-classRecord">
                <label for="subject">Subject:</label>
                <select name="subject" id="subject">
                    <option value="" selected disabled>--Select--</option>
                    <!-- it should be dynamic option -->
                    <option value="Statistics">Statistics</option> 
                </select>
            </div>

            <div class="form-group-classRecord">
                <label for="quarter">Quarter:</label>
                <select name="quarter" id="quarter">
                    <option value="" selected disabled>--Select--</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                    <option value="4th">4th</option>
                </select>
            </div>

            <div class="form-group-classRecord">
                <button class="addClassRecord-btn" onclick="getElementById('addClassRecordModal').style.display = 'block'">
                    <i class="bi bi-plus"></i>
                </button>
            </div>
        </div>

        <!-- table desing -->
        <div class="table-classRecord">
            <table class="classRecordTable">
                <thead>
                    <tr class="thead-tr">
                        <th class="tablehead">Student Name</th>
                        <th class="tablehead" colspan="11">Written Works</th>
                        <th class="tablehead" colspan="11">Performance Task</th>
                        <th class="tablehead">Quarterly Assessment</th>
                        <th class="tablehead">Quarterly Grade</th>
                        <th class="tablehead">Action</th>
                    </tr>
                    <tr>
                        <th></th>
                        <!-- WRITTEN WORKS Subheaders -->
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>Total</th>
                        <!-- PERFORMANCE TASKS Subheaders -->
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <!-- <tr>
                        <th class="label-th" colspan="26">Male</th>
                    </tr> -->
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>

    </div>

    <!-- Add Class Record Form Modal -->
    <div id="addClassRecordModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Add Student Record</h2>
            <form id="addStudentRecord">
                <div class="form-group">
                    <label for="quarter">Choose a Quarter</label>
                    <select id="quarterModal" name="quarter" required>
                        <option value="" disabled selected>--Select Student--</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="studentName">Choose Student to Add</label>
                    <select id="studentName" name="studentId" required>
                    </select>
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

            updateTable();
            dynamicFillSelect()
            filterSelectFill("schoolYear", "school_year");
            filterSelectFill("gradeLevel", "grade_level");
            filterSelectFill("section", "section");
            filterSelectFill("subject", "class_name");


            $('#schoolYear, #gradeLevel, #section, #subject, #quarter').on('change input', function () {
                updateTable();
            });

            // Dynamic table data #######################################################################################################
            function updateTable() {

                let school_year = $('#schoolYear').val();
                let grade_level = $('#gradeLevel').val();
                let section = $('#section').val();
                let subject = $('#subject').val();
                let quarter = $('#quarter').val();

                console.log(school_year);
                console.log(grade_level);
                console.log(section);
                console.log(subject);
                console.log(quarter);

                $.ajax({
                    url: '../Controller/fetchStudentData.php',
                    type: 'POST',
                    data: {
                            school_year : school_year,
                            grade_level : grade_level,
                            section : section,
                            subject : subject,
                            quarter : quarter
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            let tableBody = $("table tbody");
                            tableBody.empty();

                            response.data.forEach(function(student) {
                                let row = `<tr>
                                            <td class="td-data td-studentName">${student.first_name} ${student.last_name}</td>
                                            <td class="td-data"><input type="text" id="ww1-${student.student_id}" value="${student.ww1}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww2-${student.student_id}" value="${student.ww2}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww3-${student.student_id}" value="${student.ww3}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww4-${student.student_id}" value="${student.ww4}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww5-${student.student_id}" value="${student.ww5}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww6-${student.student_id}" value="${student.ww6}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww7-${student.student_id}" value="${student.ww7}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww8-${student.student_id}" value="${student.ww8}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww9-${student.student_id}" value="${student.ww9}" readonly></td>
                                            <td class="td-data"><input type="text" id="ww10-${student.student_id}" value="${student.ww10}" readonly></td>
                                            <td class="td-data"><input type="text" id="wwTotal-${student.student_id}" value="${student.wwTotal}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt1-${student.student_id}" value="${student.pt1}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt2-${student.student_id}" value="${student.pt2}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt3-${student.student_id}" value="${student.pt3}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt4-${student.student_id}" value="${student.pt4}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt5-${student.student_id}" value="${student.pt5}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt6-${student.student_id}" value="${student.pt6}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt7-${student.student_id}" value="${student.pt7}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt8-${student.student_id}" value="${student.pt8}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt9-${student.student_id}" value="${student.pt9}" readonly></td>
                                            <td class="td-data"><input type="text" id="pt10-${student.student_id}" value="${student.pt10}" readonly></td>
                                            <td class="td-data"><input type="text" id="ptTotal-${student.student_id}" value="${student.ptTotal}" readonly></td>
                                            <td class="td-data"><input type="text" id="quarterly_assessment-${student.student_id}" value="${student.quarterly_assessment}" readonly></td>
                                            <td class="td-data"><input type="text" id="quarterly_grade-${student.student_id}" value="${student.quarterly_grade}" readonly></td>
                                            <td class="td-data td-btn">
                                                <button class="classRecord-edit-btn" data-id="${student.student_id}">Edit</button>
                                                <button class="classRecord-save-btn" style="margin-left: 3px">Save</button>
                                            </td>
                                        </tr>`;

                                tableBody.append(row);
                            });

                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error status:", status); 
                        console.log("Error details:", error); 
                        console.log("Response text:", xhr.responseText); 
                        alert("Something went wrong. Check console for details.");
                    }
                });
            }

            // edit button ############################################################################################################
            $(document).on('click', '.classRecord-edit-btn', function() {
                const saveBtn = $(this).closest('tr').find('.classRecord-save-btn');
                const inputField = $(this).closest('tr').find('input');

                $(this).css('display', 'none');
                saveBtn.css('display', 'block');
                inputField.removeAttr('readonly');
            });

            $(document).on('click', '.classRecord-save-btn', function (){

                const editBtn = $(this).closest('tr').find('.classRecord-edit-btn');
                const inputField = $(this).closest('tr').find('input');

                let studentID = $(this).closest('tr').find('.classRecord-edit-btn').data('id'); //getting the id of specific student store in edit button
                let quarter = $('#quarter').val();

                // these are the input value for written works
                let ww1 = $(`#ww1-${studentID}`).val();
                let ww2 = $(`#ww2-${studentID}`).val();
                let ww3 = $(`#ww3-${studentID}`).val();
                let ww4 = $(`#ww4-${studentID}`).val();
                let ww5 = $(`#ww5-${studentID}`).val();
                let ww6 = $(`#ww6-${studentID}`).val();
                let ww7 = $(`#ww7-${studentID}`).val();
                let ww8 = $(`#ww8-${studentID}`).val();
                let ww9 = $(`#ww9-${studentID}`).val();
                let ww10 = $(`#ww10-${studentID}`).val();
                let wwTotal = $(`#wwTotal-${studentID}`).val();

                // these are the input value for performance tasks
                let pt1 = $(`#pt1-${studentID}`).val();
                let pt2 = $(`#pt2-${studentID}`).val();
                let pt3 = $(`#pt3-${studentID}`).val();
                let pt4 = $(`#pt4-${studentID}`).val();
                let pt5 = $(`#pt5-${studentID}`).val();
                let pt6 = $(`#pt6-${studentID}`).val();
                let pt7 = $(`#pt7-${studentID}`).val();
                let pt8 = $(`#pt8-${studentID}`).val();
                let pt9 = $(`#pt9-${studentID}`).val();
                let pt10 = $(`#pt10-${studentID}`).val();
                let ptTotal = $(`#ptTotal-${studentID}`).val();

                // these are the input value for quarterly assessment and grade

                let quarterly_assessment = $(`#quarterly_assessment-${studentID}`).val();
                let quarterly_grade = $(`#quarterly_grade-${studentID}`).val();


                // Console logs after all variable declarations
                console.log('quarter', quarter);
                console.log("Student ID:", studentID);
                console.log("WW1:", ww1);
                console.log("WW2:", ww2);
                console.log("WW3:", ww3);
                console.log("WW4:", ww4);
                console.log("WW5:", ww5);
                console.log("WW6:", ww6);
                console.log("WW7:", ww7);
                console.log("WW8:", ww8);
                console.log("WW9:", ww9);
                console.log("WW10:", ww10);
                console.log("WW Total:", wwTotal);

                console.log("PT1:", pt1);
                console.log("PT2:", pt2);
                console.log("PT3:", pt3);
                console.log("PT4:", pt4);
                console.log("PT5:", pt5);
                console.log("PT6:", pt6);
                console.log("PT7:", pt7);
                console.log("PT8:", pt8);
                console.log("PT9:", pt9);
                console.log("PT10:", pt10);
                console.log("PT Total:", ptTotal);

                console.log("Quarterly Assessment:", quarterly_assessment);
                console.log("Quarterly Grade:", quarterly_grade);

                $.ajax({

                    url: '../Controller/editClassRecordController.php',
                    type: 'POST',
                    data: {
                            quarter: quarter,
                            studentID: studentID,
                            ww1 : ww1,
                            ww2 : ww2,
                            ww3 : ww3,
                            ww4 : ww4,
                            ww5 : ww5,
                            ww6 : ww6,
                            ww7 : ww7,
                            ww8 : ww8,
                            ww9 : ww9,
                            ww10  : ww10,
                            wwTotal : wwTotal,

                            pt1 : pt1,
                            pt2 : pt2,
                            pt3 : pt3,
                            pt4 : pt4,
                            pt5 : pt5,
                            pt6 : pt6,
                            pt7 : pt7,
                            pt8 : pt8,
                            pt9 : pt9,
                            pt10 :pt10,
                            ptTotal : ptTotal,

                            quarterly_assessment : quarterly_assessment,
                            quarterly_grade : quarterly_grade
                        },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            // alert('Class record updated successfully!');
                            updateTable();
                        } else {
                            alert('Failed to update class record: ' + response.message);
                        }

                        $(this).css('display', 'none');
                        editBtn.css('display', 'block');
                        inputField.attr('readonly');
                        
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating class record:", error);
                        alert('An error occurred. Please check the console for details.');
                    }
                });
            });


            // modal click events  ############################################################################################################
            $(".addClassRecord-btn").click(function () {
                $("#addClassRecordModal").fadeIn();
            });
            $("#closeModal").click(function () {
                $("#addClassRecordModal").fadeOut();
            });

            // dynamic fill select in modal  ############################################################################################################
            function dynamicFillSelect() {
                $.ajax({
                    url: '../Controller/getStudDataController.php',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            let studentSelect = $('#studentName'); 
                            studentSelect.empty(); 

                            studentSelect.append('<option value="" disabled selected>--Select Student--</option>');

                            
                            response.data.forEach(function(student) {
                                let fullName = student.first_name + ' ' + student.last_name; 
                                let option = `<option value="${student.student_id}">${fullName}</option>`;
                                studentSelect.append(option); 

                                $("#addClassRecordModal").fadeOut();
                            });
                        } else {
                            alert('Failed to load student data.' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching student data:", error);
                        alert('An error occurred while fetching student data.');
                    }
                });
            }

            // function for for filter select option in the table
            function filterSelectFill(selectOptionId, selectValue){

                $.ajax({
                    
                    url: '../Controller/getStudDataController.php',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response){
                        
                        let selectOption =  $(`#${selectOptionId}`);
                        selectOption.empty();
                        selectOption.append('<option value="" selected disabled>--Select--</option>');

                        if(response.success){

                            let uniqueVal = new Set();

                            response.data.forEach(function(student){
                                uniqueVal.add(student[selectValue]);
                            });

                            uniqueVal.forEach(function(value){
                                let option = `<option value="${value}">${value}</option>`;
                                selectOption.append(option);
                            }); 

                        }
                        else{
                            selectOption.append('<option value="" disabled>No Student Data</option>');
                        }
                    },
                    error: function(xhr, status, error){
                        console.error("Error in fetching student data", error);
                        alert("An Error occur in fetching processing data");

                    }
                });


            }

           //add student record ###############################################################################################################
            $('#addStudentRecord').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: '../Controller/addStudRecordController.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        
                        $("#responseText").text(response.message);
                        
                        const classType = response.success ? "success" : "error";
                        $("#responseMessage")
                            .removeClass("error success")
                            .addClass(`display ${classType}`);
                        if (response.success) {
                            $("#addClassRecordModal").fadeOut();
                            $("#addStudentRecord")[0].reset();
                            updateTable();
                        }else{
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error adding student record:", error);
                        alert('An error occurred while adding the student record.');
                   }
                });
            });

            // NOTIFICATION
            $("#responseMessage .closeAlertBtn").click(function () {
                $("#responseMessage").removeClass("display");
            });

        });

    </script>
</body>
</html>