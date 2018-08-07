@extends('layouts.app')

@section('content')
    <div id="vue-search">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <h5>{{ __('Pesquisar pessoas') }}</h5>
                    </div>

                    <div class="col-8 text-right" v-if="form.search && tables.people.length === 0">
                        <a href="{{ route('persons.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fa fa-plus"></i>
                            Cadastrar novo cidadão
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <form action="{{ route('persons.index') }}" id="searchForm">
                                <div class="form-group">
                                    <label for="pesquisa">Pesquisar</label>

                                    <input
                                        type="text" class="form-control"
                                        name="pesquisa"
                                        placeholder="digite CPF, CNPJ ou nome"
                                        v-model="form.search"
                                        @keyup="typeKeyUp"
                                    >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card" v-if="form.search">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <h5>{{ __('Resultado') }}</h5>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12" v-if="tables.people.length == 0">
                        <h1 class="text-center">Nenhum resultado encontrado</h1>
                    </div>

                    <div class="col-12" v-if="tables.people.length > 0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Endereços</th>
                                    <th scope="col">Contatos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="person in tables.people">
                                    <td v-html="person.name"></td>

                                    <td v-html="person.cpf_cnpj"></td>

                                    <td>
                                        <p v-for="address in person.addresses">
                                            @{{ address.street }}
                                        </p>
                                    </td>

                                    <td>
                                        <p v-for="contact in person.contacts">
                                            @{{ contact.contact }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
