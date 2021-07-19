import InteractWithUser from 'Vendor/rapidez/core/resources/js/components/User/mixins/InteractWithUser'

Vue.prototype.registerCallback = async function (changes) {
    await InteractWithUser.methods.login(changes.email, changes.password)
    await InteractWithUser.methods.refreshUser()
}

Vue.prototype.refreshUserInfoCallback = async function (changes) {
    await InteractWithUser.methods.refreshUser()
}
