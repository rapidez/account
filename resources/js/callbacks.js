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
    response.data.data.reorderItems.userInputErrors.forEach((error) => {
        setTimeout(() => {
            Notify(error.message, 'warning')
        }, 1500)
    })

    await GetCart.methods.refreshCart()
}
