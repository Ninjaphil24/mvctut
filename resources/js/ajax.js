import { header } from './components/header.js'
import { single } from './components/single.js'

document.addEventListener("DOMContentLoaded", loadlist)
function loadlist() {
    const xhr = new XMLHttpRequest()
    xhr.open("GET", "/listusers")
    xhr.send()
    xhr.onload = function () {
        // No type declaration = global variable
        var html = header()
        var users = JSON.parse(this.responseText)
        for (var i = 0; i < users.length; i++) {
            html += `<tr>
                        <td>${users[i].first_name}</td>
                        <td>${users[i].last_name}</td>
                        <td>${users[i].email}</td>
                        <td><a data-id="${users[i].id}" data-button="WildCard" class="myButton ajaxButton">Wild Card</a></td>
                        <td><a data-id="${users[i].id}" data-button="FetchAPI" class="myButton ajaxButton">Fetch API</a></td>
                        <td><a data-id="${users[i].id}" data-button="QueryString" class="myButton ajaxButton">Query String</a></td>
                    </tr>`
        }
        var tags = document.getElementsByTagName('table')[0].innerHTML = html
        Array.from(document.getElementsByClassName('ajaxButton')).forEach(button => {
            button.addEventListener('click', function () {

                switch (this.getAttribute('data-button')) {
                    case "WildCard":
                        loadsingle(this.getAttribute('data-id'))
                        break
                    case "FetchAPI":
                        loadsingleQ(this.getAttribute('data-id'))
                        break
                    case "QueryString":
                        loadsingleFetchAPI(this.getAttribute('data-id'))
                        break
                } //switch
            } // addEventListener Callback
            )// addEventListener
        } //ForEach Callback
        ) //ForEach
    }
} // loadlist
    function loadsingle(id) {
        const xhr = new XMLHttpRequest()
        xhr.open("GET", "/listuser/" + id)
        xhr.send()
        xhr.onload = function () {
            var html = header()
            var users = JSON.parse(this.responseText)
            html += single(users)
            var tags = document.getElementsByTagName('table')[0].innerHTML = html
            document.getElementById("listButton").addEventListener("click",loadlist)
        }
    }
    // Query String
    function loadsingleQ(id) {
        const xhr = new XMLHttpRequest()
        xhr.open("GET", "/listuser?id=" + id)
        xhr.send()
        xhr.onload = function () {
            var html = header()
            var users = JSON.parse(this.responseText)
            html += single(users)
            var tags = document.getElementsByTagName('table')[0].innerHTML = html
            document.getElementById("listButton").addEventListener("click",loadlist)
        }
    }
    // Fetch API
    function loadsingleFetchAPI(id) {

        fetch("/listuser/" + id)
            .then(function (response) {
                return response.json()
            })
            .then(function (users) {
                var html = header()
                html += single(users)
            var tags = document.getElementsByTagName('table')[0].innerHTML = html
            document.getElementById("listButton").addEventListener("click",loadlist)
            })
    }

