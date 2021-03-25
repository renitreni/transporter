@extends('layouts.app')

@section('title')
    Customer Results
@endsection

@section('content')
    <div id="app" class="card">
        <div class="card-body">
            <span class="fs-1">Details</span>
            <div class="row">
                <div class="col-6 row">
                    <div class="col-auto fw-bold">
                        Name
                    </div>
                    <div class="col-auto">
                        {{ $details->name }}
                    </div>
                </div>
                <div class="col-6 row">
                    <div class="col-auto fw-bold">
                        Temperature
                    </div>
                    <div class="col-auto">
                        {{ $details->temp }}
                    </div>
                </div>
                <div class="col-6 row">
                    <div class="col-auto fw-bold">
                        Gender
                    </div>
                    <div class="col-auto">
                        {{ $details->gender }}
                    </div>
                </div>
                <div class="col-6 row">
                    <div class="col-auto fw-bold">
                        Contact
                    </div>
                    <div class="col-auto">
                        {{ $details->phone }}
                    </div>
                </div>
                <div class="col-6 row">
                    <div class="col-auto fw-bold">
                        Birth Date
                    </div>
                    <div class="col-auto">
                        {{ $details->birthdate }}
                    </div>
                </div>
                <div class="col-12 row">
                    <div class="col-auto fw-bold">
                        Address
                    </div>
                    <div class="col-auto">
                        {{ $details->address }}
                    </div>
                </div>
            </div>
            <span class="fs-1">Answers</span>
            <div class="row">
                <div class="col-12 overflow-scroll">
                    <table class="table">
                        <thead>
                            <th>Question</th>
                            <th>Answer</th>
                        </thead>
                        <tbody>
                            @foreach ($results as $item)
                                <tr>
                                    <td>{!! $item->question !!}</td>
                                    <td>{{ $item->choice == 0? 'No' : 'Yes' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const e = new Vue({
            el: '#app',
            data: {},
            methods: {},
            mounted() {
                var $this = this;
            }
        });

    </script>
@endsection
