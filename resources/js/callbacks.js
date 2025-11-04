import { login, refresh as refreshUser } from 'Vendor/rapidez/core/resources/js/stores/useUser'

document.addEventListener('vue:loaded', function (event) {
    const vue = event.detail.vue;
    vue.config.globalProperties.registerCallback = async function (variables, response) {
        await login(variables.email, variables.password)
    }

    vue.config.globalProperties.refreshUserInfoCallback = async function (variables, response) {
        await refreshUser()
    }

    vue.config.globalProperties.reorderCallback = async function (variables, response) {
        document.addEventListener('vue:loaded', function showReorderErrors() {
            response.data.reorderItems.userInputErrors.forEach((error) => {
                Notify(error.message, 'warning')
            })
            document.removeEventListener('vue:loaded', showReorderErrors)
        })

        await vue.config.globalProperties.updateCart(variables, response)
    }

    vue.config.globalProperties.sortOrdersCallback = async function (data, response) {
        response.data.customer.orders.items.sort((a,b) => {
            return new Date(b.order_date) - new Date(a.order_date)
        })

        return response.data
    }
})
