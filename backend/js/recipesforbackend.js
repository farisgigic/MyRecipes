let dataFetched = [];

$(document).ready(() => {
    getRecipes("http://localhost/Web%20Programming/backend/get_recipes.php");
    // getRecipes("json/recipes1.json");
});

const storeId = (id) => {
    localStorage.setItem("recipe-id", id);
};

const getRecipes = (dataUrl) => {
    $.get(dataUrl, (data) => {
        // console.log(data); 

        try {
            const parsedData = JSON.parse(data);


            if (Array.isArray(parsedData)) {

                dataFetched = parsedData;
                renderItems(dataFetched);
            } else {

                console.error("Parsed data is not an array:", parsedData);
            }
        } catch (error) {
            console.error("Error parsing data:", error);
        }
    });
};

const renderItems = (itemsArray) => {
    $("#tbl_recipes tbody").empty();

    itemsArray.forEach(instance => {
        const row = document.createElement("tr");
        row.innerHTML = `
            
            <td>${instance.name}</td>
            <td>${instance.time_taken}</td>
            <td>${instance.category}</td>
            <td>${instance.user_id}</td>
            <td>
                <div class="btn-group" role="group" aria-label="Actions"> 
                    <button type="button" class="btn btn-danger">Delete</button> 
                </div>
        </td>
        `;
        $("#tbl_recipes tbody").append(row);
    });

    $("#tbl_recipes").DataTable({
        info: false,
    });
};
