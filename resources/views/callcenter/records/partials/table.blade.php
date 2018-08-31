<div class="card mt-4">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-4">
                <h5>
                    {{ __('Protocolos') }}

                    @if (isset($onlyNonResolved))
                        {{ __('Não Resolvidos') }}
                    @endif
                </h5>
            </div>

            <div class="col-8 text-right">
                @if(isset($person))
                    <a id="buttonAndamentos"
                       href="{{ route('records.create',['person_id'=>$person->id]) }}"
                       class="btn btn-primary btn-sm pull-right"
                    >
                        <i class="fa fa-plus"></i>
                        Novo Protocolo
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="card-body">
        <table id="recordsTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Protocolos</th>
                <th>Comissão</th>
                <th>Tipo de Protocolo</th>
                <th>Área</th>
            </tr>
            </thead>

            @forelse ($records as $record)
                <tr>
                    <td><a href="{{ route('records.show',['id' => $record->id]) }}">{{ $record->protocol }}</a></td>
                    <td>{{ $record->committee->name or '' }}</td>
                    <td>{{ $record->recordType->name or '' }}</td>
                    <td>{{ $record->area->name or '' }}</td>
                </tr>
            @empty
                <p>Nenhum Protocolo encontrado</p>
            @endforelse
        </table>

        {{ $records->links() }}
    </div>
</div>
