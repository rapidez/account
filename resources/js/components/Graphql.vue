<script>
    export default {
        props: [
            'query',
            'check',
            'redirect',
        ],

        data: () => ({
            data: null,
        }),

        render() {
            return this.$scopedSlots.default({
                data: this.data,
            })
        },

        created() {
            this.runQuery()
        },

        methods: {
            async runQuery() {
                try {
                    let options = this.$root.user ? { headers: { Authorization: `Bearer ${localStorage.token}` }} : null
                    let response = await axios.post(config.magento_url+'/graphql', {
                        query: this.query
                    }, options)

                    if (response.data.errors) {
                        alert(response.data.errors[0].message)
                        return
                    }

                    if (this.check) {
                        if (!eval('response.data.' + this.check)) {
                            Turbolinks.visit(this.redirect)
                            return
                        }
                    }

                    this.data = response.data.data
                } catch (e) {
                    alert('Something went wrong, please try again')
                }
            }
        }
    }
</script>
