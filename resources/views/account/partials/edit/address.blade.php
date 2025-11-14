<graphql query="@include('rapidez::account.partials.queries.overview')" v-slot="{ data }">
    <div v-if="data">
        @include('rapidez::account.partials.addresses')
    </div>
</graphql>