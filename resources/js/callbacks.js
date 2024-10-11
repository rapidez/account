import 'Vendor/rapidez/core/resources/js/vue'
import InteractWithUser from 'Vendor/rapidez/core/resources/js/components/User/mixins/InteractWithUser'
import { mask } from 'Vendor/rapidez/core/resources/js/stores/useMask'
import { cart, linkUserToCart, refresh as refreshCart } from 'Vendor/rapidez/core/resources/js/stores/useCart'

Vue.prototype.registerCallback = async function (variables, response) {
    await InteractWithUser.methods.login(variables.email, variables.password)
}

Vue.prototype.refreshUserInfoCallback = async function (variables, response) {
    await InteractWithUser.methods.refreshUser()
}

Vue.prototype.reorderCallback = async function (variables, response) {
    document.addEventListener('turbo:load', function showReorderErrors() {
        response.data.reorderItems.userInputErrors.forEach((error) => {
            Notify(error.message, 'warning')
        })
        document.removeEventListener('turbo:load', showReorderErrors)
    })

    await refreshCart()
}

Vue.prototype.sortOrdersCallback = async function (data, response) {
    response.data.customer.orders.items.sort((a,b) => {
        return new Date(b.order_date) - new Date(a.order_date)
    })

    return response.data
}
