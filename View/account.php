<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/tableDesign.css">
    <link rel="stylesheet" href="../assets/css/modalDesign.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <title>Account</title>
    <style>
        td.role.admin {
            color: #007bff;
            font-weight: bold;
        }

        td.role.teacher {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="responseMessage">
        <button class="closeAlertBtn">&times;</button>
        <span id="responseText"></span>
    </div>

    <div class="con">
        <div class="row-top">
            <button id="openModalBtn" onclick="document.querySelector('.modal').style.display='block'">
                <i class="bi bi-plus-circle"></i>Add Account
            </button>
        </div>
        <div class="row-bottom" id="refresh-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>User Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add User Form Modal -->
    <div id="addAccountModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Add New Account</h2>
            <form id="addAccountForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter email address" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label for="userRole">User Role</label>
                    <select id="userRole" name="userRole" required>
                        <option value="" disabled selected>Select role</option>
                        <option value="Admin">Admin</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                </div>
                <button type="submit" class="modal-btn">
                    <i class="bi bi-save"></i> Save Now
                </button>
            </form>
        </div>
    </div>

    <!--Delete Modal -->
    <div id="deleteAccountModal" class="modal">

        <div class="modal-content">
            <span class="close" id="closeDeleteModal">&times;</span>
            <h2>Delete Account</h2>
            <p id="deleteMessage"></p>
            <form id="deleteAccountForm">
                <input type="hidden" id="deleteAccountId" name="accountId">
                <div class="modal-actions">
                    <button type="submit" class="delete-modal-btn danger">Delete</button>
                    <button type="button" class="delete-modal-btn cancel" id="cancelDelete">Cancel</button>
                </div>
            </form>
        </div>

    </div>


    
    <script src="../assets/js/jquery.js"></script>

    <script>
        $(document).ready(function () {

            updateAccountTable();
        
            // NOTIFICATION
            $("#responseMessage .closeAlertBtn").click(function () {
                $("#responseMessage").removeClass("display");
            });

            // Submitting the form to add User
            $("#addAccountForm").submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: "../Controller/addAccountController.php",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        $("#responseText").text(response.message);
                        const classType = response.success ? "success" : "error";
                        $("#responseMessage").removeClass("error success").addClass(`display ${classType}`);
                        if (response.success) {

                            $("#addAccountModal").hide();
                            $("#addAccountForm")[0].reset();

                            updateAccountTable();
                        }
                    },
                    error: function () {
                        $("#responseText").text("An error occurred. Please try again.");
                        $("#responseMessage").addClass("display error");
                    }
                });
            });

            $("#openModalBtn").click(function () {
                $("#addAccountModal").fadeIn();
            });
            $("#closeModal").click(function () {
                $("#addAccountModal").fadeOut();
            });
            window.onclick = function (event) {
                const modal = document.getElementById('addAccountModal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };


            //Opening the modal by clicking specific button
            $('table').on('click', '.delete-btn', function(){

                let accountID = $(this).data("id");
                let accountName = $(this).closest('tr').find('td:nth-child(2)').text();

                console.log(accountID);
                console.log(accountName);

                $('#deleteMessage').text(`Are you sure you want to delete the account of ${accountName}?`);
                $('#deleteAccountId').val(accountID); //id comes from the dynamic button in the table and store it in input field with #deleteAccountId
                $("#deleteAccountModal").fadeIn();

            });

            $('#closeDeleteModal, #cancelDelete').click(function(){
                $("#deleteAccountModal").fadeOut();
            });

            window.onclick = function(event){
                const deleteModal = document.getElementById('deleteAccountModal');
                if(even.target === deleteModal){
                    deleteModal.styl.diplay = 'none';
                }
            };
            

           // For handling the form submission for delete 
            $("#deleteAccountForm").submit(function(e) {
                e.preventDefault();

                const accountId = $('#deleteAccountId').val();

                $.ajax({
                    url: "../Controller/deleteAccountController.php",
                    type: 'POST',
                    data: { accountId: accountId }, // this will use in PHP code to get the data
                    dataType: "json",
                    success: function(response) {
                        $("#responseText").text(response.message);
                        const classType = response.success ? 'success' : 'error';
                        $("#responseMessage").removeClass("error success").addClass(`display ${classType}`);

                        if (response.success) {
                            $("#deleteAccountModal").fadeOut();
                            updateAccountTable();
                        }
                    },
                    error: function() {
                        $("#responseText").text("An error occurred. Please try again.");
                        $("#responseMessage").addClass("display error");
                    }
                });
            });

        });

        // Dynamic Table Rendering
        function updateAccountTable() {
            $.ajax({
                url: "../Controller/getAllAccountController.php",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    let tableBody = $("table tbody");
                    tableBody.empty();

                    let counter = 1;

                    response.data.forEach(account => {
                        let roleClass = account.role.toLowerCase();
                        let row = `
                            <tr>
                                <td>${counter}</td> <!-- Natural numbering -->
                                <td>${account.name}</td>
                                <td>${account.username}</td>
                                <td>${account.password}</td>
                                <td class="role ${roleClass}">${account.role}</td>
                                <td>
                                    <button class="btn-table  btn-sm btn-danger delete-btn" data-id="${account.user_id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                        counter++;
                    });
                },
                error: function () {
                    alert("Failed to load updated data.");
                }
            });
        }

    </script>

</body>

</html>
