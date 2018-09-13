@extends('layouts.app')

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <ul class="aloalerj-breadcrumbs">
                        <li>
                            <a href="{{ route('people.show', ['id' => $person->id]) }}">
                                {{ $person->name }}
                            </a>
                        </li>

                        <li>
                            Protocolo {{ $record->protocol }}
                        </li>
                    </ul>
                </div>

                <div class="col-4">
                        <h5 class="text-right">
                            @if ($record->resolved_at)
                                <span class="badge badge-danger">PROCOLO FINALIZADO</span>
                            @else
                                <span class="badge badge-success">PROCOLO EM ANDAMENTO</span>
                            @endif
                        </h5>
                </div>
            </div>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('records.store') }}" aria-label="Protocolos">
                @csrf

                @if (isset($person))
                <input name="person_id" type="hidden" value="{{ $person->id }}">
                @endif

                @if (isset($record))
                <input name="record_id" type="hidden" value="{{ $record->id }}">
                @endif

                <div class="form-group row">
                    <label for="cpf_cnpj" class="col-sm-4 col-form-label text-md-right">CNPJ/CPF</label>
                    <div class="col-md-6">
                        <input id="cpf_cnpj"
                               class="form-control{{ $errors->has('cpf_cnpj') ? ' is-invalid' : '' }}" name="cpf_cnpj"
                               value="{{is_null(old('cpf_cnpj')) ? $person->cpf_cnpj : old('cpf_cnpj') }}"
                               readonly="readonly">
                        @if ($errors->has('cpf_cnpj'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpf_cnpj') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">Nome Completo</label>
                    <div class="col-md-6">
                        <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{is_null(old('name')) ? $person->name : old('name') }}"
                               readonly="readonly">
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                @if (isset($record) and is_null($record->id))
                    <div class="form-group row">
                        <label for="committee_id" class="col-sm-4 col-form-label text-md-right">Origem</label>

                        <div class="col-md-6">
                            <select id="origin_id"
                                    class="form-control{{ $errors->has('origin_id') ? ' is-invalid' : '' }} select2" name="origin_id"
                                    value="{{is_null(old('origin_id')) ? $record->origin_id : old('origin_id') }}" required
                                    autofocus
                            >
                                <option value="">SELECIONE</option>
                                @foreach ($origins as $key => $origin)
                                    @if(((!is_null($record->id)) && (!is_null($record->origin_id) && $record->origin_id === $origin->id) || (!is_null(old('origin_id'))) && old('origin_id') == $origin->id))
                                        <option value="{{ $origin->id }}" selected="selected">{{ $origin->name }}</option>
                                    @else
                                        <option value="{{ $origin->id }}">{{ $origin->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->has('origins_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('origin_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                @endIf

                <div class="form-group row">
                    <label for="committee_id" class="col-sm-4 col-form-label text-md-right">Comissão</label>

                    <div class="col-md-6">
                        <select id="committee_id"
                                class="form-control{{ $errors->has('committee_id') ? ' is-invalid' : '' }} select2"
                                name="committee_id"
                                value="{{is_null(old('committee_id')) ? $record->committee_id : old('committee_id') }}"
                                required
                                autofocus>
                            <option value="">SELECIONE</option>
                            @foreach ($committees as $key => $committe)
                                @if(((!is_null($record->id)) && (!is_null($record->committee_id) && $record->committee_id === $committe->id) || (!is_null(old('committee_id'))) && old('committee_id') == $committe->id))
                                    <option value="{{ $committe->id }}" selected="selected">{{ $committe->name }}</option>
                                @else
                                    <option value="{{ $committe->id }}">{{ $committe->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('origins_id'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('committee_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="record_type_id" class="col-sm-4 col-form-label text-md-right">Tipo</label>

                    <div class="col-md-6">
                        <select id="record_type_id"
                                class="form-control{{ $errors->has('record_type_id') ? ' is-invalid' : '' }} select2"
                                name="record_type_id"
                                value="{{is_null(old('record_type_id')) ? $record->record_type_id : old('record_type_id') }}"
                                required
                                autofocus>
                            <option value="">SELECIONE</option>
                            @foreach ($recordTypes as $key => $recordType)
                                @if(((!is_null($record->id)) && (!is_null($record->record_type_id) && $record->record_type_id === $recordType->id) || (!is_null(old('record_type_id'))) && old('record_type_id') == $recordType->id))
                                    <option value="{{ $recordType->id }}" selected="selected">{{ $recordType->name }}</option>
                                @else
                                    <option value="{{ $recordType->id }}">{{ $recordType->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('record_type_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('record_type_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

            @if (isset($record) and is_null($record->id))
                <div class="form-group row">
                    <label for="progress_type_id" class="col-sm-4 col-form-label text-md-right">Assunto</label>

                    <div class="col-md-6">
                        <select id="progress_type_id" type="progress_type_id"
                                class="form-control{{ $errors->has('progress_type_id') ? ' is-invalid' : '' }} select2" name="progress_type_id"
                                value="" required autofocus>
                            <option value="">SELECIONE</option>
                            @foreach ($progressTypes as $key => $progressType)
                                    <option value="{{ $progressType->id }}">{{ $progressType->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('progress_type_id'))
                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('progress_type_id') }}</strong>
                                                    </span>
                        @endif
                    </div>
                </div>
            @endIf

            <div class="form-group row">
                <label for="area_id" class="col-sm-4 col-form-label text-md-right">Área</label>

                    <div class="col-md-6">
                        <select id="area_id" type="area_id"
                                class="form-control{{ $errors->has('area_id') ? ' is-invalid' : '' }} select2" name="area_id"
                                value="{{is_null(old('area_id')) ? $record->area_id : old('area_id') }}" required autofocus>
                            <option value="">SELECIONE</option>
                            @foreach ($areas as $key => $area)
                                @if(((!is_null($record->id)) && (!is_null($record->area_id) && $record->area_id === $area->id) || (!is_null(old('area_id'))) && old('area_id') == $area->id))
                                    <option value="{{ $area->id }}" selected="selected">{{ $area->name }}</option>
                                @else
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('area_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('area_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                @if (isset($record) and is_null($record->id))
                    <div class="form-group row">
                        <label for="original" class="col-sm-4 col-form-label text-md-right">Solicitação</label>
                        <div class="col-md-6">
                                <textarea id="original"
                                          class="form-control{{ $errors->has('original') ? ' is-invalid' : '' }}"
                                          name="original"
                                          value="{{is_null(old('original')) ? $record->original : old('original') }}"
                                          required rows="15">{{$record->original}}</textarea>
                            @if ($errors->has('original'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('original') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <label for="send_answer_by_email" class="col-sm-4 col-form-label text-md-right">Resposta por e-mail</label>
                    <div class="col-md-6">

                        <button type="button" class="btn btn-sm btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>

                        {{--<input id="send_answer_by_email" type="hidden" name="send_answer_by_email" value="0">
                        <input id="send_answer_by_email" type="checkbox" name="send_answer_by_email" {{old('send_answer_by_email')
                        || $record->send_answer_by_email ? 'checked="checked"' : ''}} >--}}
                    </div>
                </div>

                @if (!$workflow && $record->created_at_formatted)
                    <div class="form-group row">
                        <label for="identification" class="col-sm-4 col-form-label text-md-right">
                            Criado em
                        </label>

                        <div class="col-md-4">


                            <input id="identification"
                                   class="form-control"
                                   value="{{ $record->created_at_formatted ?? '' }}"
                                   disabled
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="identification" class="col-sm-4 col-form-label text-md-right">
                            Alterado em
                        </label>

                        <div class="col-md-4">
                            <input id="identification"
                                   class="form-control"
                                   value="{{ $record->updated_at_formatted ?? '' }}"
                                   disabled
                            >
                        </div>
                    </div>
                @endif

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        @if($workflow)
                            <button type="submit" class="btn btn-danger">
                                    Próximo passo >>
                            </button>
                        @elseif(is_null($record->committee))
                            <button type="submit" class="btn btn-danger">
                                Gravar
                            </button>
                        @else
                             @foreach ($committees as $key => $committee)
                                 @if(!is_null($record->committee) && $record->committee->id == $committee->id)
                                     @can('committee-'.$committee->slug, \Auth::user())
                                        <button type="submit" class="btn btn-danger">
                                            Gravar
                                        </button>
                                     @endcan
                                @endIf
                             @endforeach
                        @endIf
                    </div>
                </div>

            </form>
        </div>
    </div>

    @if (isset($progresses))
        @include('callcenter.progress.index')
    @endif
@endsection
