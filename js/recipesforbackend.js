let dataFetched = [];

$(document).ready(() => {
    getRecipes("recipes");
});

const storeId = (id) => {
    localStorage.setItem("recipe-id", id);
};

const getRecipes = (url) => {
    RestClient.get(url, (data) => {
        try {
            if (Array.isArray(data.data)) {
                dataFetched = data.data;
                renderItems(dataFetched);
            } else {
                console.error("Parsed data is not an array:", data);
            }
        } catch (error) {
            console.error("Error processing data:", error);
        }
    }, (error) => {
        console.error("Error fetching data:", error);
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
                    <button type="button" class="btn btn-danger" onclick="RecipeService.delete_recipe(${instance.id})">Delete</button> 
                </div>
            </td>
        `;
        $("#tbl_recipes tbody").append(row);
    });

    $("#tbl_recipes").DataTable({
        info: false,
    });
};
