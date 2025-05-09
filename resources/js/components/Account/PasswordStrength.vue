<script>

export default {
    props: {
        password: {
            type: String,
            default: ''
        },
        minLength: {
            type: Number,
            default: null
        },
        minClasses: {
            type: Number,
            default: null
        },
        checks: {
            type: Object,
            default: null
        },
    },

    data() {
        return {
            strengths: [],
            errors: []
        }
    },

    render() {
        return this.$scopedSlots.default(this)
    },

    mounted() {
        this.validate()
    },
    watch: {
        password: {
            handler: function () {
                this.validate()
            }
        }
    },

    methods: {
        validate() {
            this.errors = []
            this.strengths = []
            if (!/[a-z]/.test(this.password)) {
                this.errors.push(this.checks.lowercase)
            } else {
                this.strengths.push(this.checks.lowercase)
            }
            if (!/[A-Z]/.test(this.password)) {
                this.errors.push(this.checks.uppercase)
            } else {
                this.strengths.push(this.checks.uppercase)
            }
            if (!/\d/.test(this.password)) {
                this.errors.push(this.checks.number)
            } else {
                this.strengths.push(this.checks.number)
            }
            if (!/[^a-zA-Z0-9]/.test(this.password)) {
                this.errors.push(this.checks.special)
            } else {
                this.strengths.push(this.checks.special)
            }
            let satisfiedClasses = 4 - this.errors.length
            if (satisfiedClasses >= this.minClasses) {
                this.errors = []
            }
            if (this.password.length < this.minLength) {
                this.errors.push(this.checks.length)
            } else {
                this.strengths.push(this.checks.length)
            }
        }
    },
}
</script>
