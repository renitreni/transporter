@extends('layouts.external')

@section('content')
    <div id="app" class="mx-auto">
        <div class="app-auth-branding mb-2 mt-4">
            <a class="app-logo" href="{{ route('home') }}">
                <img class="logo-icon" src="{{ asset('images/logo/te-logo.png') }}" alt="logo">
            </a>
        </div>
        <h2 class="auth-heading text-center mb-2">Health Assessment Form</h2>
        <div class="row text-left mt-4">
            <div class="col-sm-6 col-12">
                <div>
                    <label class="form-label">Name</label>
                    <input class="form-control" v-model="overview.name">
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div>
                    <label class="form-label">Temperature</label>
                    <input type="number" class="form-control" v-model="overview.temp">
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div>
                    <label class="form-label">Gender</label>
                    <select class="form-control" v-model="overview.gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div>
                    <label class="form-label">Birthdate</label>
                    <input type="date" class="form-control" v-model="overview.birthdate">
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div>
                    <label class="form-label">Phone</label>
                    <input class="form-control" v-model="overview.phone">
                </div>
            </div>
            <div class="col-12">
                <div>
                    <label class="form-label">Address</label>
                    <input class="form-control" v-model="overview.address">
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-9 fw-bold">Questions</div>
                            <div class="col-3 fw-bold">Answer</div>
                        </div>
                    </div>
                    <div class="col-12 overflow-scroll" v-for="item in questions" :key="item.id">
                        <div class="row mb-2">
                            <div class="col-9 fs-6">@{{ item . question }}</div>
                            <div class="col-3 row">
                                <div class="col-auto p-0 pr-2">No</div>
                                <div class="col-auto p-0">
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input" type="checkbox" v-model="item.choice">
                                    </div>
                                </div>
                                <div class="col-auto p-0">Yes</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary btn-block text-white" @click="save">Submit</button>
            </div>
        </div>
    </div>
    <!--//auth-body-->
    <script>
        const e = new Vue({
            el: '#app',
            data: {
                overview: {
                    name: '',
                    address: '',
                    birhtdate: '',
                    temp: '',
                    gender: 'male',
                    phone: '',
                },
                questions: {!! $questions !!}
            },
            methods: {
                save() {
                    var $this = this;
                    axios.post('{{ route('assesment.submit') }}', {
                            overview: this.overview,
                            questions: this.questions
                        })
                        .then(function(params) {
                            $this.overview = {
                                name: '',
                                address: '',
                                birhtdate: '',
                                temp: '',
                                gender: 'male',
                                phone: '',
                            };
                            Swal.fire(
                                'Submitted!',
                                'Thank You.',
                                'success'
                            );
                        });
                }
            }
        });

    </script>
@endsection
