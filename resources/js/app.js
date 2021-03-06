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

    const resultText = document.getElementById('result-text');

    const route = `/api/fibonacci?from=${x.value}&to=${y.value}`
    const token = document.querySelector('meta[name="csrf-token"]').content

    let req = new XMLHttpRequest()
    req.open("GET", route, true)
    req.setRequestHeader('X-CSRF-TOKEN', token);
    req.setRequestHeader('Accept', 'application/json');

    req.onload = () => {
        if (req.status !== 200) {
            requestError(req, x, y)
            resultText.innerHTML = 'Ошибка'
        } else {
            document.getElementById('result-text').innerHTML = JSON.parse(req.response).data;
        }

        resultElement.classList.remove('loading')
        resultElement.classList.add('show')
    }
    req.send(null)
}

function requestError(req, x, y) {
    const errors = JSON.parse(req.response).errors
    if (Object.keys(errors).length > 0) {
        if (errors.from) {
            setError(x, errors.from[0])
        }
        if (errors.to) {
            setError(y, errors.to[0])
        }
    }
}
