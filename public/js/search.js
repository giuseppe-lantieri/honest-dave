const SEARCH_BAR = document.getElementById("search-bar");
const DIV_RESULT = document.getElementById("risultati");

const N_COL = 3;

function reduceName(stringa) {
    return stringa.length > 15 ? stringa.substring(0, 15) + "..." : stringa
}

SEARCH_BAR.addEventListener("submit", async (event) => {
    event.preventDefault();

    DIV_RESULT.innerHTML = `
    <div class="loader"></div> 
    `;

    const data = new FormData(event.currentTarget);
    const value_to_search = data.get("search");
    const response = await fetch(`http://www.omdbapi.com/?` + new URLSearchParams({
        s: value_to_search,
        apikey: KEY_OMDB
    }));
    const value_json = await response.json();

    const array_results_from_itunes = value_json.Search;

    const checkIfPresent = async (ele) => {
        const url = "/api/check/items?" + new URLSearchParams({
            imdbID: ele.imdbID,
            collection_id: COLLECTION_ID,
            user_id: USER_ID,
        });
        const text = await fetch(url);
        const result = await text.text();
        if (result) {
            return `<p class="all-width borded">✔️ Inserito</p>`
        } else {
            return `<input class="all-width" type="submit" value="+" />`
        }
    }

    const createComponent = async (ele) => (`
            <form class="card" onsubmit="return submit_controlled(event)">
                <img src="${ele.Poster}" />
                <h3>${reduceName(ele.Title)}</h3>
                <input type="hidden" id="name" name="name" value="${ele.Title}" /> 
                <input type="hidden" id="image" name="image" value="${ele.Poster}" /> 
                <input type="hidden" id="imdbID" name="imdbID" value="${ele.imdbID}" /> 
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
        target.removeChild(target.children[7]);
        const success = document.createElement("p");
        success.textContent = "✔️ Successo";
        target.appendChild(success);
    }).catch((e) => {
        target.removeChild(target.children[7]);
        const error = document.createElement("p");
        error.textContent = "❌ Errore";
        error.classList.add("error-text")
        target.appendChild(error);
    })
    return false;
}

