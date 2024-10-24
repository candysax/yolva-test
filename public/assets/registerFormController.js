class RegisterFormController {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector)
    }

    handle() {
        this.form.addEventListener('submit',  (e) => {
            e.preventDefault()
            this.#send()
        })
    }

    #send() {
        let formData = this.#collectDataFromForm()

        let xhr = new XMLHttpRequest()
        xhr.open(this.#method(), this.form.action)
        xhr.setRequestHeader('Content-Type', 'application/json')
        xhr.send(JSON.stringify(formData))

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200 || xhr.status === 201 || xhr.status === 204) {
                    this.#displaySuccess('Регистрация прошла успешно')
                    this.#clearErrors()
                    this.#clearFieldData()
                } else if (xhr.status === 422) {
                    this.#clearErrors()
                    this.#displayErrors(JSON.parse(xhr.responseText).errors)
                } else {
                    this.form.querySelector('#global-error')
                        .innerText = 'При отправке данных произошла ошибка'
                }
            }
        }
    }

    #collectDataFromForm() {
        return Object.fromEntries(new FormData(this.form))
    }

    #method() {
        return this.form['_method']
            ? this.form['_method'].value
            : this.form.method
    }

    #displayErrors(errors) {
        for (let [field, error] of Object.entries(errors)) {
            let errorTextEl = this.form.querySelector(`[name="${field}"] + .error`)
            errorTextEl.innerText = error[0]
        }
    }

    #clearErrors() {
        this.form.querySelector('#global-error').innerText = ''
        this.form.querySelectorAll('.error').forEach(error => error.innerText = '')
    }

    #clearFieldData() {
        this.form.querySelectorAll('input:not([type="hidden"]), textarea')
            .forEach(input => input.value = '')
    }

    #displaySuccess(successMessage) {
        let notificationEl = document.querySelector('#success-notification')
        notificationEl.innerText = successMessage
        notificationEl.style.display = 'block'

        setInterval(() => {
            notificationEl.style.display = 'none'
        }, 5000)
    }
}

export default RegisterFormController

