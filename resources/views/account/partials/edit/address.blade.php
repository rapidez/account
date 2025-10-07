<graphql query="@include('rapidez::account.partials.queries.overview')">
    <div v-if="data" slot-scope="{ data }">
        @include('rapidez::account.partials.addresses')
    </div>
</graphql>