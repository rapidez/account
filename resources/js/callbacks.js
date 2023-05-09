import 'Vendor/rapidez/core/resources/js/vue'
import InteractWithUser from 'Vendor/rapidez/core/resources/js/components/User/mixins/InteractWithUser'
import GetCart from 'Vendor/rapidez/core/resources/js/components/Cart/mixins/GetCart'

Vue.prototype.registerCallback = async function (variables, response) {
    await InteractWithUser.methods.login(variables.email, variables.password)
    await InteractWithUser.methods.refreshUser()
    if (localStorage.cart && localStorage.mask) {
        await GetCart.methods.linkUserToCart()
    }
}

Vue.prototype.refreshUserInfoCallback = async function (variables, response) {
    await InteractWithUser.methods.refreshUser()
}

Vue.prototype.reorderCallback = async function (variables, response) {
    document.addEventListener('turbo:load', function showReorderErrors() {
        response.data.data.reorderItems.userInputErrors.forEach((error) => {
            Notify(error.message, 'warning')
        })
        document.removeEventListener('turbo:load', showReorderErrors)
    })

    await GetCart.methods.refreshCart()
}

Vue.prototype.sortOrdersCallback = async function (response) {
    response.data.data.customer.orders.items.sort((a,b) => {
        return new Date(b.order_date) - new Date(a.order_date)
    })

    return response.data.data
}
