@extends('layouts.app')

@section('title')
    Questions
@endsection

@section('content')
    <div id="app" class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-3">
                    <a href="{{ route('questions.create') }}" class="btn text-white btn-success">
                        <i class="fa fa-plus"></i> Add New Question
                    </a>
                </div>
                <div class="col-12 overflow-scroll">
                    <table id="questions-table" class="table"></table>
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
                published(overview) {
                    var $this = this;
                    axios.post('{{ route('questions.published') }}', overview);
                }
            },
            mounted() {
                var $this = this;

                $this.dt = $('#questions-table').DataTable({
                    serverSide: true,
                    ajax: {
                        url: '{{ route('questions.table') }}',
                        type: 'POST'
                    },
                    order: [0, 'desc'],
                    columns: [{
                            data: function(params) {
                                return '<a href="questions/' + params.id +
                                    '" class="btn btn-sm btn-link text-truncate" style="max-width: 350px;">' + params.question + '</a>'
                            },
                            title: 'Question'
                        },
                        {
                            data: function(params) {
                                var checked = ''
                                if(params.is_published == 1)
                                    checked = 'checked'

                                return '<div class="form-check form-switch">' +
                                    '<input class="form-check-input" type="checkbox" ' + checked + '>' +
                                    '</div>';
                            },
                            title: 'Published'
                        },
                        {
                            data: 'created_at',
                            title: 'Date Created'
                        },
                    ],
                    "drawCallback": function(settings) {
                        $('tbody').on('click', 'tr', function() {
                            $this.overview = $this.dt.row(this).data();
                            $this.published($this.dt.row(this).data());

                        });
                    }
                });
            }
        });

    </script>
@endsection
