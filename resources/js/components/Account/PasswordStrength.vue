<script>

export default {
    props: {
        password: {
            type: String,
            default: ''
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
            errors: [],
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
            for (const check in this.checks) {
                if (Object.prototype.hasOwnProperty.call(this.checks, check)) {
                    if (new RegExp(this.checks[check].regex).test(this.password)) {
                        this.strengths.push(this.checks[check].text)
                    } else {
                        this.errors.push(this.checks[check].text)
                    }
                }
            }
            let satisfiedClasses = Object.keys(this.checks).length - this.errors.length
            if (satisfiedClasses >= this.minClasses) {
                this.errors = []
                if (!this.strengths.includes(this.checks.length.text)) {
                    this.errors.push(this.checks.length.text)
                }
            }
        }
    },
}
</script>
