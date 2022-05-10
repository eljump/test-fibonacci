require('./bootstrap')

let form = document.getElementById('form')
form.addEventListener('submit', function (event) {
    event.preventDefault()
    const x = event.target.elements.X
    const y = event.target.elements.Y

    if (hasEmptyFields([x, y]))
        return false

    request(x, y)
})

function hasEmptyFields(array) {
    let hasErrors = false;
    for (const element of array) {
        if (element.value === '') {
            setError(element, 'Пустое поле')
            hasErrors = true;
        }
    }
    return hasErrors;
}

function setError(element, text) {
    const elementError = element.nextElementSibling.children[0]
    elementError.innerHTML = text
    element.classList.add("input-error")
    element.addEventListener('input', () => clearError(element), {once: true})
}

function clearError(element) {
    const elementError = element.nextElementSibling.children[0]
    elementError.innerHTML = ''
    element.classList.remove("input-error")
}

function request(x, y) {
    const resultElement = document.getElementById('result')
    resultElement.classList.add('loading')

    const route = `/api/slice?x=${x}&y=${y}`

    let req = new XMLHttpRequest();
    req.open("GET", "route", true);
    req.onload = function (){
        alert( req.status);
    }
    req.send(null);
}
