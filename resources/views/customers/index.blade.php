<x-blank>

    <div class="container">

        <div class="card">

            <div class="card-header">
                @php
                    $paginations = [10, 20, 30, 50];
                @endphp

                <form class="filter" method="get">
                    <select name="pagination">
                        @foreach ($paginations as $value)
                            <option {{ $value == request()->pagination ? 'selected' : '' }} value="{{ $value }}">
                                {{ $value }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-secondary" type="submit">Filtrar</button>
                </form>

                <h2 class="text-center">Clientes</h2>

                <a type="button" href="{{ route('customer.create') }}" class="btn btn-primary">Criar Novo</a>

            </div>

            <div class="card-body">

                <table class="table table-responsive table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data de Nascimento</th>
                        <th>Cpf</th>
                        <th>Telefone</th>
                        <th>Inadimplência</th>
                        <th>Data de Criação</th>
                        <th>Data de Edição</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ date('d-m-Y', strtotime($customer->birth_date)) }}</td>
                            <td>{{ $customer->cpf }}</td>
                            <td>{{ $customer->phone }}</td>
                            @php
                                if ($customer->able) {
                                    $able = 'Sim';
                                } else {
                                    $able = 'Não';
                                }
                            @endphp
                            <td>{{ $able }}</td>
                            <td>{{ $customer->created_at }}</td>
                            <td>{{ $customer->updated_at }}</td>
                            <td>
                                <div class="table-buttons">

                                    <form action="{{ route('customer.rent.home', $customer->id) }}">
                                        <button type="submit" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-camera-reels" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0M1 3a2 2 0 1 0 4 0 2 2 0 0 0-4 0" />
                                                <path
                                                    d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2zm6 8.73V7.27l-3.5 1.555v4.35zM1 8v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1" />
                                                <path
                                                    d="M9 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6M7 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('customer.formEdit', $customer->id) }}">
                                        <button type="submit" class="btn btn-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path
                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('customer.delete', $customer->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>

            <div class="card-footer text-end">
                {{ $customers }}
            </div>

        </div>


    </div>

</x-blank>
