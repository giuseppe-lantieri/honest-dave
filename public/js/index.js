const SEARCH_BAR = document.getElementById("search-bar");
const DIV_ELEMENTS = document.getElementById("elements");
const DIV_RESULT = document.getElementById("risultati");
let state_elements = true;

const N_COL = 5;

function reduceName(stringa) {
    return stringa.length > 10 ? stringa.substring(0, 10) + "..." : stringa
}


DIV_ELEMENTS.addEventListener("click", async (event) => {
    if (state_elements)
        event.currentTarget.classList.add("hidden-child");
    else
        event.currentTarget.classList.remove("hidden-child");
    state_elements = !state_elements;
})

SEARCH_BAR.addEventListener("submit", async (event) => {
    event.preventDefault();

    DIV_RESULT.innerHTML = `
    <div class="loader"></div> 
    `;

    const data = new FormData(event.currentTarget);
    const value_to_search = data.get("search");
    const response = await fetch(`https://itunes.apple.com/search?media=movie&term=${value_to_search}`);
    const value_json = await response.json();

    const array_results_from_itunes = value_json.results;

    const checkIfPresent = async (ele) => {
        const url = "/api/check/items?" + new URLSearchParams({
            name: ele.trackName,
            image: ele.artworkUrl100,
            collection_id: COLLECTION_ID,
            user_id: USER_ID,
        });
        const result = await (await fetch(url)).json()

        if (result) {
            return `<p>Inserito</p>`
        } else {
            return `<input type="submit" value="+" />`
        }
    }

    const createComponent = async (ele) => (`
        <form onsubmit="return submit_controlled(event)">
            <img src="${ele.artworkUrl100}" />
            <h3>${reduceName(ele.trackName)}</h3>
            <input type="hidden" id="name" name="name" value="${ele.trackName}" /> 
            <input type="hidden" id="image" name="image" value="${ele.artworkUrl100}" /> 
            <input type="hidden" id="collection_id" name="collection_id" value="${COLLECTION_ID}" /> 
            <input type="hidden" id="user_id" name="user_id" value="${USER_ID}" /> 
            ${await checkIfPresent(ele)}
        </form>`
    )

    const a_string_for_table = array_results_from_itunes.map(async (ele, index) => {
        switch (index % N_COL) {
            case 0:
                return `
                <tr>
                    <td>
                    ${await createComponent(ele)}
                    </td>`
            case (N_COL - 1):
                return `
                    <td>
                    ${await createComponent(ele)}
                    </td>
                </tr>`
            default:
                return `
                    <td>
                    ${await createComponent(ele)}
                    </td>`
        }
    });

    const string_for_table = (await Promise.all(a_string_for_table)).join("");

    DIV_RESULT.innerHTML = `
    <table class="esponi-risultati">
        ${string_for_table}
    </table>
    `
})

function submit_controlled(event) {
    event.preventDefault();
    const target = event.currentTarget;
    const data = new FormData(event.currentTarget);
    fetch("/api/items", {
        method: "POST",
        body: data
    }).then(() => {
        target.removeChild(target.children[6]);
        const success = document.createElement("p");
        success.textContent = "Successo";
        target.appendChild(success);
    }).catch((e) => {
        target.removeChild(target.children[6]);
        const error = document.createElement("p");
        error.textContent = "Errore";
        target.appendChild(error);
    })
    return false;
}

