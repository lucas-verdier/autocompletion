'use strict'

document.addEventListener('DOMContentLoaded', function loaded() {

    var input = document.querySelector('.row input')
    // console.log(input)
    var form = document.querySelector('form')
    // console.log(form)
    var sectionUp = document.querySelector('main section:first-of-type')
    var sectionDown = document.querySelector('main section:last-of-type')
    // console.log(sectionDown)

    input.addEventListener('input', function() {
        if (input.value.length == 0) {
            var items = document.querySelectorAll('a')
            items.forEach(element => element.remove())
        } else {
            var data = new FormData()

            data.append('input', input.value)

            fetch("traitement.php?search="+input.value, {
                method: 'GET',
                body: null
            })
                .then(function(response) {
                    return response.json();
                })
                .then(function(response) {
                    console.log(response)

                    var items = document.querySelectorAll('a')
                    items.forEach(element => element.remove())

                    for (let i = 0; i<response['start'].length; i++) {
                        let a = document.createElement('a')
                        a.innerText = response['start'][i]["slug"]+' ('+response['start'][i]["symbole"]+')'
                        a.href = 'element.php?id='+response['start'][i]["slug"]
                        sectionUp.appendChild(a)
                    }

                    for (let i = 0; i<response['contain'].length; i++) {
                        // if (response['start'][i]['slug'] != response['contain'][i]["slug"]) {
                            let a = document.createElement('a')
                            a.innerText = response['contain'][i]["slug"]+' ('+response['contain'][i]["symbole"]+')'
                            a.href = 'element.php?id='+response['contain'][i]["slug"]
                            sectionDown.appendChild(a)
                        // }
                    }
                })
        }

    })
    //
    // input.addEventListener('keypress', function(e) {
    //     console.log(e.key)
    //     if (e.key == 'Shift' || e.key == 'Down') {
    //
    //     }
    // })
    //
    document.addEventListener('keypress', function(e) {
        console.log(e)
        if (e.key == 'Enter') {
            e.preventDefault()
            document.location.href = 'recherche.php?search='+input.value
            console.log(input.value)
        }
    })

})