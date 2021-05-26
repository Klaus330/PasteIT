<div class="flex">
    <section class="section">
        <div class="row">
            <h4 class="section-title mb-2 h4">My Pastes</h4>
            <div class="grid">
                <div class="settings-content col-12" id="session-content">

                </div>
            </div>
        </div>

    </section>

</div>


<script>
    let page = 1;

    function getUserPastes(page) {
        let request = new XMLHttpRequest();
        let url = "/user/my-pastes/paginate";
        request.open("POST", url, true);
        request.responseType = "json";

        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let cardContainer = document.getElementById("session-content");


                request.response.data.forEach((paste) => {
                    let card = document.createElement("div");
                    card.innerHTML = `
                        <div class="cards-container">

                            <div class="card">
                        <span class="card-blocks">

                        </span>
                                <div class="card-content">
                                    <h2 class="card-title h2">${paste.title}</h2>
                                    <p class="card-author">${paste.syntax.name}
                                        (${paste.exposure === "1" ? "Private" : "Public"})</p>
                                    <a class="btn btn-light btn-sm" href="/paste/view/${paste.slug}">Read More</a>
                                </div>
                            </div>
                        </div>

                    `;
                    cardContainer.appendChild(card);
                });
                return;
            }
        }

        let payload = new FormData();
        payload.append("user_id", <?= auth()->id ?>);
        payload.append("page_nr", page);
        request.send(payload);
    }

    getUserPastes(page);
    page++;


    window.addEventListener('scroll', () => {
        if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight) {
            getUserPastes(page++);
        }
    });


</script>