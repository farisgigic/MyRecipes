let fetchedData = [];

const allRecipes = document.querySelector(".all-recipes");

$(document).ready(() => {
    getItems("json/recipes.json");
})

storeId = (id) => {
    localStorage.setItem("product-id", id);
}

getItems = (dataUrl) => {
    $.get(dataUrl, (response) => {
        response.forEach(instance => {
            fetchedData.push(instance);
        })
        callRecipes(fetchedData);
    });
}

callRecipes = (recipesArray) => {
    $(".all-recipes").empty();

    const itemsPerRow = 3;
    let row = null;

    recipesArray.forEach((instance, index) => {
        // Create a new row for every multiple of itemsPerRow
        if (index % itemsPerRow === 0) {
            if (index > 0) {
                const spacer = document.createElement("div");
                spacer.classList.add("spacer");
                allRecipes.append(spacer);
            }
            row = document.createElement("div");
            row.classList.add("row");
            allRecipes.append(row);
        }

        const item = document.createElement("div");
        item.classList.add("col-xl-4", "col-lg-4", "col-md-4");
        item.innerHTML = `
            <div class="single_recepie text-center" style ="padding-top": 200px>
                <div class="recepie_thumb">
                    <img src="${instance.image}" style="width: 50%; height: 75%; max-height: 30%;">
                </div>
                <h3>${instance.name}</h3>
                <span></span>
                <p>Time Needs: ${instance.rating}</p>
                <a href="#recipe1" class="line_btn">${"See recipe"}</a>
            </div>
        `;
        row.append(item);
    });
}
