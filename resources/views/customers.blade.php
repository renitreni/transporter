@extends('layouts.app')

@section('title')
    Customers
@endsection

@section('content')
    <div id="app" class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 overflow-scroll">
                    <table id="results-table" class="table"></table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const e = new Vue({
            el: '#app',
            data: {
                dt: null,
                overview:[]
            },
            methods: {
            },
            mounted() {
                var $this = this;

                $this.dt = $('#results-table').DataTable({
                    serverSide: true,
                    ajax: {
                        url: '{{ route('customers.table') }}',
                        type: 'POST'
                    },
                    order: [0, 'desc'],
                    columns: [
                        {
                            data: 'created_at',
                            title: 'Date Created'
                        },
                        {
                            data: function(params) {
                                return '<a href="' + params.edit_link + '" class="btn btn-link">' + params.name + '</a>';
                            },
                            title: 'Name'
                        },
                    ],
                    "drawCallback": function(settings) {
                        $('tbody').on('click', 'tr', function() {
                            $this.overview = $this.dt.row(this).data();
                        });
                    }
                });
            }
        });

    </script>
@endsection
