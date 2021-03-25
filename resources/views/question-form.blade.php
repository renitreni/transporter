@extends('layouts.app')

@section('title')
    Question Form
@endsection

@section('content')
    <div id="app" class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3 visually-hidden">
                    <label class="form-label">Type of Question</label>
                    <select class="form-control" v-model="overview.answer">
                        <option value="YesNo">Yes or No</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Question</label>
                    <textarea class="form-control" style="height: 80px" v-model="overview.question"></textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Details</label>
                    <textarea class="form-control" style="height: 80px" v-model="overview.details"></textarea>
                </div>
                @isset($question)
                    <div class="text-center">
                        <div class="btn-group btn-block" role="group" aria-label="Basic example">
                            <button type="button" @click="update()" class="btn btn-primary btn-block mx-auto shadow-sm">
                                Update
                            </button>
                            <button type="button" @click="destroy()" class="btn btn-danger btn-block mx-auto shadow-sm m-0">
                                Delete
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <button class="btn btn-block btn-primary" @click="save">Save</button>
                    </div>
                @endisset
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
                myModal: null,
                @isset($question)
                    overview: {!! $question !!},
                @else
                    overview: {
                        answer: 'YesNo',
                        question: '',
                        details: ''
                    },
                @endisset
            },
            methods: {
                @isset($question)
                    update() {
                        axios.put('{{ route('questions.update', ['question' => $question->id]) }}', this.overview)
                            .then(function(params) {
                                window.location = "{{ route('questions.index') }}"
                            });
                    },
                    destroy() {
                        axios.delete('{{ route('questions.destroy', ['question' => $question->id]) }}', this.overview)
                            .then(function(params) {
                                window.location = "{{ route('questions.index') }}"
                            });
                    }
                @else
                    save() {
                        axios.post('{{ route('questions.store') }}', this.overview).then(function(params) {
                            window.location = "{{ route('questions.index') }}"
                        });
                    },
                @endisset
            },
            mounted() {
                var $this = this;
            }
        });

    </script>
@endsection
