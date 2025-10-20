<script>

export default {
    props: {
        password: {
            type: String,
            default: '',
        },
        minClasses: {
            type: Number,
            default: null,
        },
        classes: {
            type: Array,
            default: null,
        },
        extraChecks: {
            type: Array,
            default: null,
        }
    },

    data() {
        return {
            strengths: [],
            errors: [],
        }
    },

    render() {
        return this.$slots && this.$slots.default ? this.$slots.default(this) : null
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

            this.runChecks(this.classes)

            let satisfiedClasses = this.classes.length - this.errors.length
            if (satisfiedClasses >= this.minClasses) {
                this.errors = []
            }

            this.runChecks(this.extraChecks)
        },

        runChecks(checks) {
            checks.forEach((check) => {
                if (new RegExp(check.regex).test(this.password)) {
                    this.strengths.push(check.text)
                } else {
                    this.errors.push(check.text)
                }
            })
        }
    },
}
</script>
