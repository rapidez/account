import './callbacks'
import PasswordStrength from './components/Account/PasswordStrength.vue'

document.addEventListener('vue:loaded', function (event) {
    const vue = event.detail.vue;
    vue.component('PasswordStrength', PasswordStrength)
})
