@extends('todo::layouts.app')

@section('content')
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain"
            style="background-image: url({{ asset('/vendor/todo/images/two-girls-back.png') }})">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a class="mb-6">
                    <img alt="Logo" src="{{ asset('/vendor/todo/images/logo.png') }}" class="h-90px">
                </a>
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <div class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework">
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">Sign In to ToDo</h1>
                            <div class="text-gray-400 fw-bold fs-4">New Here?
                                <a href="{{route('register')}}"
                                   class="link-primary fw-bolder">Create an Account</a></div>
                        </div>
                        <div class="fv-row mb-10 fv-plugins-icon-container">
                            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                            <input
                                class="form-control form-control-lg form-control-solid" type="text" name="email"
                                v-model="credentials.email"
                                autocomplete="off">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="fv-row mb-10 fv-plugins-icon-container">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            </div>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                   v-model="credentials.password"
                                   name="password" autocomplete="off">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="text-center">
                            <div class="btn btn-lg btn-primary w-100 mb-5" @click="login">
                                <span class="indicator-label">Continue</span>
                                <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </div>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    credentials: {
                        email: '',
                        password: '',
                    }
                }
            },
            methods: {
                login() {
                    axios.post('/login', this.credentials)
                        .then(response => {
                            parseResponse(response);
                            handleLogin(response);
                        })
                }
            }

        });
        app.use(ElementPlus);
        app.mount('#app');
    </script>
@endsection
