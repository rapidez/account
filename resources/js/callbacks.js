import InteractWithUser from 'Vendor/rapidez/core/resources/js/components/User/mixins/InteractWithUser'
import GetCart from 'Vendor/rapidez/core/resources/js/components/Cart/mixins/GetCart'

Vue.prototype.registerCallback = async function (variables, response) {
    await InteractWithUser.methods.login(variables.email, variables.password)
    await InteractWithUser.methods.refreshUser()
    await GetCart.methods.linkUserToCart()
}

Vue.prototype.refreshUserInfoCallback = async function (variables, response) {
    await InteractWithUser.methods.refreshUser()
}

Vue.prototype.reorderCallback = async function (variables, response) {
    document.addEventListener('turbolinks:load', function showReorderErrors() {
        response.data.data.reorderItems.userInputErrors.forEach((error) => {
            Notify(error.message, 'warning')
        })
        document.removeEventListener('turbolinks:load', showReorderErrors)
    })

    await GetCart.methods.refreshCart()
}

Vue.prototype.sortOrdersCallback = async function (response) {
    response.data.data.customer.orders.items.reverse()
    return response.data.data
}
