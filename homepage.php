<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Expense Manager</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-pie.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>

<body>
    <!-- Top Nav -->
    <div class="topnav" id="myTopnav">
        <a href="#home" class="active">Expense Tracker</a>
        <a href="#add-expense-form" rel="modal:open">Add Expense</a>
        <a id="add_category">Add Category<button hidden id="user_id_button"
                value="<?php echo $_SESSION['user_id']; ?>"></button></a>
        <a href="php/logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <!-- Table of Data -->

    <br><br><br>
    <table class="table" id="expenses_table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="data">
        </tbody>
    </table>

    <center>
        <div id="container" style="width: 500px; height: 400px;"></div>
    </center>


    <!-- Add an Expense  -->
    <form id="add-expense-form" class="modal">
        <input hidden id="user" value="<?php echo $_SESSION['user_id']; ?>"></input>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Amount</label>
            <input type="text" name="amount" id="amount" class="form-control" id="exampleFormControlInput1"
                placeholder="Amount in USD">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Date</label>
            <input type="text" name="date" id="date" class="form-control" id="exampleFormControlInput1"
                placeholder="Y-m-d">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category</label>
            <select name="category" id="category" class="form-select" aria-label="Default select example">
                <option selected>Select a Category</option>
            </select>
        </div>
        <div class="mb-3">
            <center><button id="add_expense_button" type="submit" class="btn btn-light">Add Expense</button></center>
        </div>
    </form>

    <!-- Edit an Expense -->
    <form id="edit-expense-form" class="modal">
        <input hidden id="user1" value="<?php echo $_SESSION['user_id']; ?>"></input>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Amount</label>
            <input type="text" name="amount" id="amount1" class="form-control" id="exampleFormControlInput1"
                placeholder="Amount in USD">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Date</label>
            <input type="text" name="date" id="date1" class="form-control" id="exampleFormControlInput1"
                placeholder="Y-m-d">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category</label>
            <select name="category" id="category1" class="form-select" aria-label="Default select example">
                <option selected>Select a Category</option>
            </select>
        </div>
        <div class="mb-3">
            <center><button id="edit_expense_button" value="" type="submit" class="btn btn-light">Edit Expense</button>
            </center>
        </div>
    </form>


    <script src="js/get_expenses.js"></script>
    <script src="js/get_categories.js"></script>
    <script src="js/add_expense.js"></script>
    <script src="js/add_category.js"></script>
</body>

</html>