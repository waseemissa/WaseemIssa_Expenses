$(document).ready(getCategories);

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
            document.getElementById("category").innerHTML = temp;
        }).catch(error => {
            console.log(error.message);
        })
    }    

