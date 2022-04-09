@extends('todo::layouts.nav-layout')

@section('username')
    welcome @{{ userName }}
    <a class="menu-title" @click="logout">Logout</a></span>
@endsection()

@section('content')
    <div class="modal-content mw-650px">
        <div class="form fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="modal-header" id="kt_modal_add_customer_header">
                <h2 class="fw-bolder">Add a Label</h2>
            </div>
            <div class="modal-body py-10 px-lg-17">
                <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll"
                     style="max-height: 446px;">

                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label class="required fs-6 fw-bold mb-2">Name</label>
                        <input type="text" class="form-control form-control-solid" placeholder="" name="name"
                               v-model="name"
                        >
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-center">
                <button id="kt_modal_add_customer_submit" class="btn btn-primary" @click="add">
                    <span v-if="isUpdating" class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                    <span v-else class="indicator-label">Add</span>
                </button>
            </div>
            <div></div>
        </div>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    isUpdating: false,
                    userName: '',
                    name: '',
                }
            },
            methods: {
                add() {
                    this.isUpdating = true;
                    axios.post('/api/labels', {label: this.name})
                        .then(response => {
                            this.isUpdating = false;
                            parseResponse(response);
                        }).catch(error => {
                            this.isUpdating = false;
                        handleErrorValidation(error);
                        apiCheck(error);

                    })
                },
                logout() {
                    localStorage.clear();
                    window.location.href = '/logout';
                },
            },
            created() {
                this.userName = localStorage.getItem('userName');
            }
        });
        app.use(ElementPlus);
        app.mount('#app');
    </script>


@endsection
