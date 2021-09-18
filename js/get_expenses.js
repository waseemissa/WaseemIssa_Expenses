$(document).ready(getExpenses);
$(document).ready(getCategories);

$(document).on('submit','#edit-expense-form',function(e){
    var id = $("#edit_expense_button").val();
    e.preventDefault();
    editExpense(id);
    $.modal.close();
    
    
    
});

async function getExpensesAPI(){
    var user_id = $("#user_id_button").val();
    const response = await fetch('http://localhost/WaseemIssa_Expenses/php/get_expenses.php?id='+user_id);
    if(!response.ok){
        const message = "An Error has occured";
        throw new Error(message);
    }
    
    const expenses = await response.json();
    return expenses; 
}

function getExpenses(){
    getExpensesAPI().then(expenses => {
        $.each(expenses, function(index, expense){
            var $tr = $("<tr id='"+expense.id+"'>").append(
                $('<td>').text(expense.id),
                $('<td>').text(expense.category),
                $('<td>').text(expense.amount),
                $('<td>').text(expense.date),
                $('<td>').append("<button type='button' id = 'delete' value='" + expense.id + "' class='btn btn-danger delete_expense'>Delete</button><button type='button' id='edit' value='" + expense.id + "' href='#edit-expense-form' rel='modal:open' class='btn btn-success edit_expense' style='margin: 1%;'>Edit</button>"),
            ).appendTo("#expenses_table");
        });
        $(".delete_expense").on('click', function(){
            var id = $(this).val();
            deleteExpense(id);
        });
        $(".edit_expense").on('click', function(){
            var id = $(this).val();
            getExpenseData(id);
        });
    }).catch(error => {
        console.log(error.message);
    });
}





function deleteExpense(id){
deleteExpenseAPI(id).then(response =>{
    $('#'+id).hide();
})
}


async function deleteExpenseAPI(id){
const delete_response = await fetch("http://localhost/WaseemIssa_Expenses/php/delete_expense.php?id="+id);
    
    if(!delete_response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const response = await delete_response.json();
    return response;

}

function getExpenseData(id){
    getExpenseDataAPI(id).then(expense=>{
        $('#user1').val(expense.user_id);
        $('#amount1').val(expense.amount);
        $('#date1').val(expense.date);
        $('#edit_expense_button').val(id);
        $("#category1").val(expense.category_id).change();
    });
    $('#edit-expense-form').modal();

}

async function getExpenseDataAPI(id){
    const response = await fetch("http://localhost/WaseemIssa_Expenses/php/get_expense_data.php?id="+id);
    
    if(!response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const expense = await response.json();
    return expense;

}

function editExpense(id){
    var category_id = $("#category1").val();
    var user_id = $("#user1").val();
    var date = $("#date1").val();
    var amount = $("#amount1").val();
    EditExpenseAPI(id, user_id, category_id, amount, date).then(expense=>{
        var newRow = "tr id='"+expense.id+"'><td>"+expense.id+"</td><td>"+expense.category_name+"</td><td>"+expense.amount+"</td><td>"+expense.date+"</td><td><button type='button' id = 'delete' value='" + expense.id + "' class='btn btn-danger delete_expense'>Delete</button><button type='button' id='edit' value='" + expense.id + "' href='#edit-expense-form' rel='modal:open' class='btn btn-success edit_expense' style='margin: 1%;'>Edit</button></td></tr>";
        $('#'+id).replaceWith(newRow);

    });

}

async function EditExpenseAPI(id, user_id, category_id, amount, date){
    const response = await fetch("http://localhost/WaseemIssa_Expenses/php/edit_expense.php", {
        method: 'POST',
        body: new URLSearchParams({
            "id" : id,
            "user_id" : user_id,
            "category_id" : category_id,
            "amount" : amount,
            "date" : date
        })
    });
    
    if(!response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const expense = await response.json();
    return expense;
}

async function fetchCategoriesAPI(){
    const response = await fetch('http://localhost/WaseemIssa_Expenses/php/get_categories.php');
        if(!response.ok){
            const message = "An Error has occured";
            throw new Error(message);
        }
        
        const data = await response.json();
        return data; 
}

function getCategories(){
        fetchCategoriesAPI().then(data =>{
            if(data.length>0){
                var temp="";
                data.forEach((u)=>{
                    temp+= "<option value="+u.category_id+">"+u.category_name+"</option>";
                });

            }
            document.getElementById("category1").innerHTML = temp;
        }).catch(error => {
            console.log(error.message);
        })
} 



anychart.onDocumentLoad(function () {
        var chart = anychart.pie();
    
        var user_id = $("#user_id_button").val();
        var data = [];
        getChartDataAPI(user_id).then(stats =>{
            $.each(stats, function(index,stat){
            data[index]=[stat.name,  stat.total];
            });
        
        chart = anychart.pie(data);

        chart.title("Expenses' Stats");

        chart.container("container");

        chart.draw();
    });
});






async function getChartDataAPI(user_id){
    const response = await fetch("http://localhost/WaseemIssa_Expenses/php/get_chart_data.php?id="+user_id);
    
    if(!response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const stats = await response.json();
    return stats;

}

