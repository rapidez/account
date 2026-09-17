<script>
import Login from 'Vendor/rapidez/core/resources/js/components/user/Login.vue'
import { token } from 'Vendor/rapidez/core/resources/js/stores/useUser'
import Jwt from 'Vendor/rapidez/core/resources/js/jwt'
import { useLocalStorage, useTimeAgoIntl } from '@vueuse/core'

let loginTimerId = null

export default {
    mixins: [Login],
    props: {
        warningTime: {
            type: Number,
            default: 900,
        },
    },
    data: () => ({
        email: useLocalStorage('email').value,
        password: '',
        isTokenExpiring: false,
    }),
    computed: {
        expireDate() {
            const tokenJwt = Jwt.isJwt(token.value) ? Jwt.decode(token.value) : false
            if (!tokenJwt) {
                return null;
            }

            return tokenJwt.expDate
        },
        relativeExpireText() {
            if (!this.expireDate) {
                return null;
            }
            return useTimeAgoIntl(this.expireDate)
        }
    },
    watch: {
        expireDate: {
            handler(date) {
                this.isTokenExpiring = false;
                if (loginTimerId) {
                    clearTimeout(loginTimerId)
                    loginTimerId = null
                }

                if (this.warningTime === 0 || !date) {
                    return;
                }

                const expires = date.valueOf() - (this.warningTime * 1000)
                const now = (new Date()).valueOf()
                if (expires <= now) {
                    this.isTokenExpiring = true;
                    return
                }

                loginTimerId = setTimeout(() => this.isTokenExpiring = true, expires - now)
            },
            immediate: true
        }
    },
    methods: {
        successfulLogin() {},
    }
}
</script>
