<x-blank>

    <div class="container">

        <div class="card">

            <div class="card-header">

                <h2 class="text-center">Clientes</h2>

            </div>

            @include('components.table-customers', [
                'customers' => $customers
            ])

        </div>

    </div>

</x-blank>
