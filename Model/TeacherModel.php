<?php

class TeacherModel {

    private $conn;

    public function __construct($db){
        return $this->conn = $db;
    }

    public function addStudent($fname, $lname, $gender, $lrn, $birthDate, $contactNo, $email, $className, $gradeLevel, $section, $schoolYear, $userId){

        $addStudentQuery = "INSERT INTO students (first_name, last_name, gender, student_LRN, date_of_birth, contact_number, email, class_name, grade_level, section, school_year, users_id)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($addStudentQuery);
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param(
            'ssssssssissi',
            $fname, $lname, $gender, $lrn, $birthDate, $contactNo, $email, $className, $gradeLevel, $section, $schoolYear, $userId
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function fetchStudentData($user_id, $school_year, $grade_level, $section, $class_name, $quarter) {
        $quarter_table = '';
    
        // Determine the table based on the quarter
        switch ($quarter) {
            case '1st':
                $quarter_table = 'first_quarter_tbl';
                break;
            case '2nd':
                $quarter_table = 'second_quarter_tbl';
                break;
            case '3rd':
                $quarter_table = 'third_quarter_tbl';
                break;
            case '4th':
                $quarter_table = 'fourth_quarter_tbl';
                break;
            default:
                return false;
        }
    
        $query = "SELECT 
                    s.student_id, s.first_name, s.last_name, s.class_name, s.grade_level, s.section, s.school_year,
                    q.ww1, q.ww2, q.ww3, q.ww4, q.ww5, q.ww6, q.ww7, q.ww8, q.ww9, q.ww10, q.wwTotal,
                    q.pt1, q.pt2, q.pt3, q.pt4, q.pt5, q.pt6, q.pt7, q.pt8, q.pt9, q.pt10, q.ptTotal,
                    q.quarterly_assessment, q.quarterly_grade
                  FROM 
                    students AS s
                  INNER JOIN 
                    $quarter_table AS q 
                  ON 
                    s.student_id = q.student_id 
                  WHERE 
                    s.school_year = ? 
                    AND s.grade_level = ? 
                    AND s.section = ? 
                    AND s.class_name = ? 
                    AND s.users_id = ?";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bind_param('sissi', $school_year, $grade_level, $section, $class_name, $user_id);
    
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }
    

    public function editClassRecord($quarter,$id, $ww1, $ww2, $ww3,$ww4,$ww5,$ww6,$ww7,$ww8,$ww9,$ww10,$wwTotal,$pt1,$pt2,$pt3,$pt4,$pt5,$pt6,$pt7,$pt8,$pt9,$pt10,$ptTotal,$quarterly_assessment,$quarterly_grade){

        $quarter_table = '';

        switch ($quarter) {
            case '1st':
                $quarter_table = 'first_quarter_tbl';
                break;
            case '2nd':
                $quarter_table = 'second_quarter_tbl';
                break;
            case '3rd':
                $quarter_table = 'third_quarter_tbl';
                break;
            case '4th':
                $quarter_table = 'fourth_quarter_tbl';
                break;
            default:
                return false;
        }


        $query = "UPDATE $quarter_table SET ww1 = '$ww1', ww2 = '$ww2', ww3 = '$ww3', ww4 = '$ww4', ww5 = '$ww5', ww6 = '$ww6', ww7 = '$ww7', ww8 = '$ww8', ww9 = '$ww9', ww10 = '$ww10', wwTotal = '$wwTotal',
        pt1 = '$pt1', pt2 = '$pt2', pt3 = '$pt3', pt4 = '$pt4', pt5 = '$pt5', pt6 = '$pt6', pt7 = '$pt7', pt8 = '$pt8', pt9 = '$pt9', pt10 = '$pt10', ptTotal = '$ptTotal',
        quarterly_assessment = '$quarterly_assessment', quarterly_grade = '$quarterly_grade' WHERE student_id= '$id'";
        
        $stmt = $this->conn->query($query);

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function getStudData($id){
        $query = "SELECT * FROM students WHERE users_id = '$id'";

        $result = $this->conn->query($query);

        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);
            return $students;
        } else {
            return [];
        }
    }
    
    public function addStudentRecord($id, $quarter) {
        // Determine the table based on the quarter
        $quarter_table = '';
    
        switch ($quarter) {
            case '1st':
                $quarter_table = 'first_quarter_tbl';
                break;
            case '2nd':
                $quarter_table = 'second_quarter_tbl';
                break;
            case '3rd':
                $quarter_table = 'third_quarter_tbl';
                break;
            case '4th':
                $quarter_table = 'fourth_quarter_tbl';
                break;
            default:
                return false;
        }
    
            // If student does not exist, proceed to insert a new record
            $query = "INSERT INTO $quarter_table (
                ww1, ww2, ww3, ww4, ww5, ww6, ww7, ww8, ww9, ww10, 
                wwTotal, pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, 
                pt10, ptTotal, quarterly_assessment, quarterly_grade, student_id
            ) VALUES (
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                0, 0, 0, 0, ?
            )";
        
            $stmt = $this->conn->prepare($query);
        
            // Execute the insert statement with the student ID
            if ($stmt->execute([$id])) {
                return true;
            } else {
                return false;
            }
        
        
    }

    public function getStudentProfile($id, $school_year = null, $grade_level = null, $section = null, $class_name = null){
        // Start with the base query
        $query = "SELECT * FROM students WHERE users_id = '$id'";
        $conditions = [];
    
        // Dynamically add additional conditions based on non-null parameters
        if ($class_name !== null) {
            $conditions[] = "class_name = '$class_name'";
        }
        if ($grade_level !== null) {
            $conditions[] = "grade_level = '$grade_level'";
        }
        if ($section !== null) {
            $conditions[] = "section = '$section'";
        }
        if ($school_year !== null) {
            $conditions[] = "school_year = '$school_year'";
        }
    
        // Append additional conditions to the query
        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
        }
    
        $result = $this->conn->query($query);
    
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getStudentAnalytics($studentId) {
        $sql = "
            SELECT 
                q1.wwTotal AS q1_written_works, 
                q1.ptTotal AS q1_performance_tasks,
                q1.quarterly_assessment AS q1_quarterly_assessment,
                q1.quarterly_grade AS q1_quarterly_grade,
                q2.wwTotal AS q2_written_works, 
                q2.ptTotal AS q2_performance_tasks,
                q2.quarterly_assessment AS q2_quarterly_assessment,
                q2.quarterly_grade AS q2_quarterly_grade,
                q3.wwTotal AS q3_written_works, 
                q3.ptTotal AS q3_performance_tasks,
                q3.quarterly_assessment AS q3_quarterly_assessment,
                q3.quarterly_grade AS q3_quarterly_grade,
                q4.wwTotal AS q4_written_works, 
                q4.ptTotal AS q4_performance_tasks,
                q4.quarterly_assessment AS q4_quarterly_assessment,
                q4.quarterly_grade AS q4_quarterly_grade
            FROM first_quarter_tbl q1
            LEFT JOIN second_quarter_tbl q2 ON q1.student_id = q2.student_id
            LEFT JOIN third_quarter_tbl q3 ON q1.student_id = q3.student_id
            LEFT JOIN fourth_quarter_tbl q4 ON q1.student_id = q4.student_id
            WHERE q1.student_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $studentId);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Return the data as an associative array
        } else {
            return null; // No data found
        }
    }
    
    public function deleteStudent($studentId){
        $deleteQuery = "DELETE FROM students WHERE student_id = '$studentId' ";
        $result = $this->conn->query($deleteQuery);
        return $result;
    }

    public function getStudentDetailsById($id){

        $query = "SELECT * FROM students WHERE student_id = '$id'";
        $result = $this->conn->query($query);
    
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); 
        }
    
        return []; 
    }

    public function saveEditStdentInfo($edit_studentId, $edit_firstName, $edit_lastName, $edit_gender , $edit_LRN, $edit_birthDate , $edit_contactNum, $edit_email, $edit_subject, $edit_gradeLevel, $edit_section, $edit_schoolYear ){

        $query = "UPDATE students SET first_name = '$edit_firstName', 
        last_name = '$edit_lastName',
        gender = '$edit_gender',
        student_LRN = '$edit_LRN',
        date_of_birth = '$edit_birthDate',
        contact_number = '$edit_contactNum',
        email = '$edit_email',
        class_name = '$edit_subject',
        grade_level = '$edit_gradeLevel',
        section = '$edit_section',
        school_year = '$edit_schoolYear'
        WHERE student_id = '$edit_studentId'";

        $result = $this->conn->query($query);

        if ($result)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function retrieveUserData($id){

        $query = "SELECT * FROM users WHERE user_id = '$id'";
        $result = $this->conn->query($query);
    
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); 
        }
    
        return []; 
    }
}