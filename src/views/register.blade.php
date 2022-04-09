@extends('todo::layouts.app')

@section('content')

    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset('/vendor/todo/images/two-girls-back.png')}}">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a class="mb-6">
                    <img alt="Logo" src="{{ asset('/vendor/todo/images/logo.png') }}" class="h-90px">
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                          id="kt_sign_up_form">
                        <div class="mb-10 text-center">
                            <h1 class="text-dark mb-3">Create an Account</h1>
                            <div class="text-gray-400 fw-bold fs-4">Already have an account?
                                <a href="{{route('login')}}" class="link-primary fw-bolder">Sign in here</a></div>
                        </div>
                        <div class="border-bottom border-gray-300 w-100 mb-10"></div>
                        <div class="row fv-row mb-7 fv-plugins-icon-container">
                        </div>
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <label class="form-label fw-bolder text-dark fs-6">name</label>
                            <input
                                class="form-control form-control-lg form-control-solid"
                                type="text"
                                name="name"
                                autocomplete="off"
                                v-model="credentials.name"
                            >
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                            <label class="form-label fw-bolder text-dark fs-6">Email</label>
                            <input
                                class="form-control form-control-lg form-control-solid"
                                type="email"
                                name="email"
                                autocomplete="off"
                                v-model="credentials.email"
                            >
                        </div>
                        <div class="mb-10 fv-row fv-plugins-icon-container" data-kt-password-meter="true">
                            <div class="mb-1">
                                <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                <div class="position-relative mb-3">
                                    <input
                                        class="form-control form-control-lg form-control-solid"
                                        type="password"
                                        name="password"
                                        autocomplete="off"
                                        v-model="credentials.password"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                            <input
                                class="form-control form-control-lg form-control-solid"
                                type="password"
                                name="confirm-password"
                                autocomplete="off"
                                v-model="credentials.password_confirmation"
                            >
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="text-center">
                            <div @click="register" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Submit</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    credentials: {
                        name: '',
                        email: '',
                        password: '',
                        password_confirmation: '',
                    }
                }
            },
            methods: {
                register() {
                    axios.post('/register', this.credentials)
                        .then(response => {
                            console.log(response);
                            parseResponse(response);
                            handleLogin(response);
                        })
                        .catch(error => handleErrorValidation(error))
                }
            }

        });
        app.use(ElementPlus);
        app.mount('#app');
    </script>

@endsection
