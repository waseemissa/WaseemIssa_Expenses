$("#add_category").click(function(){
    addCategory();
});

function addCategory(){
    var category_name = prompt("What is the name of the new category?");
    var user_id = $("#user_id_button").val();
    addCategoryAPI(category_name, user_id).then(category=>{
        $('#category').append("<option value='"+category.id+"'>"+category.name+"</option>");
    });
    

}

async function addCategoryAPI(name, user_id){
    const response = await fetch("http://localhost/WaseemIssa_Expenses/php/add_category.php", {
        method: 'POST',
        body: new URLSearchParams({
            "user_id" : user_id,
            "name" : name
        })
    });
    
    if(!response.ok){
        const message = "ERROR OCCURED";
        throw new Error(message);
    }
    
    const category = await response.json();
    return category;
}