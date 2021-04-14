@extends('layouts.app')

@section('title')
    Customers
@endsection

@section('content')
    <div id="app" class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 overflow-scroll">
                    <table id="results-table" class="table nowrap"></table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="depModal" tabindex="-1" aria-labelledby="depModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Travel Status</h5>
                        <button @click="depModal.hide()" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                Name of the Passenger: <strong>@{{ overview . name }}</strong>
                            </div>
                            <div class="col-md-12 text-center" v-if="overview.travel_status.length == 0">
                                <h4>No Travel Status Yet</h4>
                                <button class="btn btn-primary mt-4" @click="seTravel('depart')">Set to Depart</button>
                            </div>
                            <div class="col-md-12 text-center" v-if="overview.travel_status.length == 1">
                                <h4>Status is Departed.</h4>
                                <button class="btn btn-success mt-4" @click="seTravel('arrived')">Passenger has
                                    Arrived</button>
                            </div>
                            <div class="col-md-12 text-center" v-if="overview.travel_status.length == 2">
                                <h4>Passenger arrived to destonation.</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
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
                overview: [],
                depModal: null,
                overview: {
                    name: '',
                    travel_status: []
                }
            },
            methods: {
                seTravel(status) {
                    var $this = this;
                    this.overview.status = status;
                    axios.post('{{ route('customers.travel') }}', this.overview)
                        .then(function() {
                            $this.dt.draw()
                            Swal.fire('Success!', 'Update successful!', 'success');
                        });
                    $this.depModal.hide();
                }
            },
            mounted() {
                var $this = this;

                $this.depModal = new bootstrap.Modal(document.getElementById('depModal'), {
                    keyboard: false
                });

                $this.dt = $('#results-table').DataTable({
                    serverSide: true,
                    ajax: {
                        url: '{{ route('customers.table') }}',
                        type: 'POST'
                    },
                    order: [1, 'desc'],
                    columns: [{
                            data: function(params) {
                                if (params.travel_status.length == 0)
                                    return '<button type="button" class="btn btn-info dep-modal">No Status</button>';
                                if (params.travel_status.length == 1)
                                    return '<button type="button" class="btn btn-warning dep-modal">Departed</button>';
                                if (params.travel_status.length == 2)
                                    return '<button type="button" class="btn btn-primary dep-modal">Arrived</button>';
                            },
                            title: 'Travel Status'
                        },
                        {
                            data: 'created_at',
                            title: 'Date Created'
                        },
                        {
                            data: function(params) {
                                return '<a href="' + params.edit_link + '" class="btn btn-link">' +
                                    params.name + '</a>';
                            },
                            title: 'Name'
                        },
                    ],
                    "drawCallback": function(settings) {
                        $('tbody').on('click', 'tr', function() {
                            $this.overview = $this.dt.row(this).data();
                        });

                        $('.dep-modal').click(function(params) {
                            $this.depModal.show();
                        })
                    }
                });
            }
        });

    </script>
@endsection
