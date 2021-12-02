import InteractWithUser from 'Vendor/rapidez/core/resources/js/components/User/mixins/InteractWithUser'
import GetCart from 'Vendor/rapidez/core/resources/js/components/Cart/mixins/GetCart'

Vue.prototype.registerCallback = async function (changes, variables, response) {
    await InteractWithUser.methods.login(changes.email, changes.password)
    await InteractWithUser.methods.refreshUser()
}

Vue.prototype.refreshUserInfoCallback = async function (changes, variables, response) {
    await InteractWithUser.methods.refreshUser()
}

Vue.prototype.reorderCallback = async function (changes, variables, response) {
    document.addEventListener('turbolinks:load', function showReorderErrors() {
        response.data.data.reorderItems.userInputErrors.forEach((error) => {
            Notify(error.message, 'warning')
        })
        document.removeEventListener('turbolinks:load', showReorderErrors)
    })

    await GetCart.methods.refreshCart()
}
