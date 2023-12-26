
document.addEventListener("DOMContentLoaded", loadlist)
function loadlist() {
    const xhr = new XMLHttpRequest()
    xhr.open("GET", "/listusers")
    xhr.send()
    xhr.onload = function () {
        html = `<tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Click to User</th>
                </tr>`
        var users = JSON.parse(this.responseText)
        for (var i = 0; i < users.length; i++) {
            html += `<tr>
                        <td>${users[i].first_name}</td>
                        <td>${users[i].last_name}</td>
                        <td>${users[i].email}</td>
                        <td><a onclick="loadsingle(${users[i].id})" class="myButton">Wild Card</a></td>
                    </tr>`
        }
        var tags = document.getElementsByTagName('table')[0].innerHTML = html
    }
}
function loadsingle(id) {
    const xhr = new XMLHttpRequest()
    xhr.open("GET", "/listuser/" + id)
    xhr.send()
    xhr.onload = function () {
        html = `<tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Click to User</th>
            </tr>`
        var users = JSON.parse(this.responseText)
        html += `<tr>
                    <td>${users.first_name}</td>
                    <td>${users.last_name}</td>
                    <td>${users.email}</td>
                    <td><a onclick="loadlist()" class="myButton">List</a></td>
                </tr>`

        var tags = document.getElementsByTagName('table')[0].innerHTML = html
    }
}
