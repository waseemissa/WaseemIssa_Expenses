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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    </head>
    <body>
        <!-- Top Nav -->
    <div class="topnav" id="myTopnav">
        <a href="#home" class="active">Expense Tracker</a>
        <a href="#add-expense-form" rel="modal:open">Add Expense</a>
        <a href="php/logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
    </div>

    <!-- Table of Data -->
    <table class="table">
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

  
    <!-- Add an Expense  -->
    <form id="add-expense-form" class="modal">
        <input hidden id="user" value="<?php echo $_SESSION['user_id']; ?>" ></input>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Amount</label>
            <input type="text" name="amount" id="amount" class="form-control" id="exampleFormControlInput1" placeholder="Amount in USD">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Date</label>
            <input type="text" name="date" id="date" class="form-control" id="exampleFormControlInput1" placeholder="Y-m-d">
        </div>
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Category</label>
        <select name = "category" id = "category" class="form-select" aria-label="Default select example">
            <option selected>Select a Category</option>
        </select>
        </div>
        <div class="mb-3">
        <center><button id = "add_expense_button" type="submit" class="btn btn-light">Add Expense</button></center>
        </div>
    </form>


    <script>

        async function fetchCategoriesAPI(){
            const response = await fetch('http://localhost/WaseemIssa_Expenses/php/get_categories.php');
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const data = await response.json();
				return data; 
			}
    

        async function fetchAPI(){
				const response = await fetch('http://localhost/WaseemIssa_Expenses/php/get_expenses.php');
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const data = await response.json();
				return data; 
			}
        
        async function deleteAPI(){
            var id = $(".delete").val();
            const response = await fetch('http://localhost/WaseemIssa_Expenses/php/delete_expense.php?id='+id);
            if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const data = await response.json();
				return data; 
        }

        $(document).on('submit','#add-expense-form',function(e){
        e.preventDefault();
        var id = $("#category").val();
        var user_id = $("#user").val();
        var date = $("#date").val();
        var amount = $("#amount").val();
        var category = $("#category").innerHTML;
       
        $.ajax({
        method:"POST",
        url: "http://localhost/WaseemIssa_Expenses/php/add_expense.php",
        data:{
            id : id,
            user_id : user_id,
            date : date,
            amount : amount
        },
        success: function(data){
        $('#add-expense-form').find('input').val('');
        $('#data').innerHTML += "<tr id="+id+">";
        $('#data').innerHTML += "<td class='product-category'><span class='categories'>"+id+"</span></td>";
        $('#data').innerHTML += "<td class='product-category'><span class='categories'>"+category+"</span></td>";
        $('#data').innerHTML += "<td class='product-category'><span class='categories'>"+amount+"$</span></td>";
        $('#data').innerHTML += "<td class='product-category'><span class='categories'>"+date+"</span></td>";
        $('#data').innerHTML += "<td class='action' data-title='Action'>";
        $('#data').innerHTML += "<div class=''><ul class='list-inline justify-content-center'>";
        $('#data').innerHTML += "<li class='list-inline-item'><button class='edit' data-toggle='tooltip' value='"+id+"' data-placement='top' title='Edit'><i class='fa fa-pencil'></i></button></li>";
        $('#data').innerHTML += "<li class='list-inline-item'><button class='delete' data-toggle='tooltip' value='"+id+"' data-placement='top' title='Delete' href=''><i class='fa fa-trash'></i></button></li>";
        $('#data').innerHTML += "</ul></div></td></tr>";

    }});
});

            

		$(document).ready(getData);
        $(document).ready(getCategories);
        $(".delete").click(deleteExpense);
       // $(".edit").click(editExpense);
        
		function getData(){
			fetchAPI().then(data => {
				console.log(data);
                if(data.length > 0){
                    var temp="";
                    data.forEach((u)=>{
                        temp+="<tr id="+u.id+">";
                        temp+="<td class='product-category'><span class='categories'>"+u.id+"</span></td>";
                        temp+="<td class='product-category'><span class='categories'>"+u.category+"</span></td>";
                        temp+="<td class='product-category'><span class='categories'>"+u.amount+"$</span></td>";
                        temp+="<td class='product-category'><span class='categories'>"+u.date+"</span></td>";
                        temp+="<td class='action' data-title='Action'>";
                        temp+="<div class=''><ul class='list-inline justify-content-center'>";
                        temp+="<li class='list-inline-item'><button class='edit' data-toggle='tooltip' value='"+u.id+"' data-placement='top' title='Edit'><i class='fa fa-pencil'></i></button></li>";
                        temp+="<li class='list-inline-item'><button class='delete' data-toggle='tooltip' value='"+u.id+"' data-placement='top' title='Delete' href=''><i class='fa fa-trash'></i></button></li>";
                        temp+="</ul></div></td></tr>";
                    });
                    document.getElementById("data").innerHTML = temp;
                }
			}).catch(error => {
				console.log(error.message);
			})
		}

        function getCategories(){
            fetchCategoriesAPI().then(data =>{
                console.log(data);
                if(data.length>0){
                    var temp="";
                    data.forEach((u)=>{
                        temp+= "<option value="+u.category_id+">"+u.category_name+"</option>";
                    });

                }
                document.getElementById("category").innerHTML = temp;
            }).catch(error => {
				console.log(error.message);
			})
        }

        function deleteExpense(){
            var id = $(".delete").val();
            deleteAPI().then(data =>{
                console.log(data);
                if(data.length!=-1){
                    document.getElementById(id).remove();
                }
            }).catch(error => {
				console.log(error.message);
			})
        }

    </script>
    </body>    
</html>