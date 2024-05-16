let dataFetched = [];

$(document).ready(() => {
    // getRecipes("http://localhost/Web%20Programming/backend/get_recipes.php?search=&start=1&draw=1&length=20&order?name=id&dir=asc");
    // getRecipes("http://localhost/Web%20Programming/backend/get_recipes.php?search=&start=1&draw=1&length=20&order?name=id&dir=desc");
    // getRecipes("http://localhost/Web%20Programming/backend/get_recipes.php");
    getRecipes("json/recipes1.json");
});

const storeId = (id) => {
    localStorage.setItem("recipe-id", id);
};

const getRecipes = (dataUrl) => {
    $.get(dataUrl, (data) => {
        console.log(data);
        data.forEach(instance => {
            dataFetched.push(instance);
            // console.log("FETCHED DATA = ", dataFetched);
        });
        // console.log(dataFetched);
        renderItems(dataFetched);
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
        `;
        $("#tbl_recipes tbody").append(row);
    });


    $("#tbl_recipes").DataTable({
        info: false,
        // ordering: false,
        // paging: false
    });
};