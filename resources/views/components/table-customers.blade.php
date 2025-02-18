@props([
    'customers'
])

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
        </tr>
        @foreach ($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->birth_date}}</td>
            <td>{{$customer->cpf}}</td>
            <td>{{$customer->phone}}</td>
            @php
                if($customer->able)
                    $able = 'Sim';
                else{
                    $able = 'Não';
                }
            @endphp
            <td>{{$able}}</td>
            <td>{{$customer->created_at}}</td>
            <td>{{$customer->updated_at}}</td>
        </tr>

        @endforeach
    </table>

</div>

<div class="card-footer text-end">
    <a type="button" href="{{ route('customer.create') }}" class="btn btn-primary">Criar Novo</a>
</div>
