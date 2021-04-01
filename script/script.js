function geting() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("getElement").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "database.php?q=", true);
    xmlhttp.send();
}

geting();

function myFunction() {
    let form = document.querySelector('#regForm');
    const data = new URLSearchParams();
    for (const p of new FormData(form)) {
        data.append(p[0], p[1]);
    }
    fetch('database.php', {
        method: 'POST',
        body: data
    }).then(response => response.text()).catch(error => console.log(error)).then(geting())
}
