import './callbacks'
import PasswordStrength from './components/Account/PasswordStrength.vue'
import ExpireLogin from './components/Account/ExpireLogin.vue'

document.addEventListener('vue:loaded', function (event) {
    const vue = event.detail.vue;
    vue.component('PasswordStrength', PasswordStrength)
    vue.component('ExpireLogin', ExpireLogin)
})
