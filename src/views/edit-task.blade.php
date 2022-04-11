@extends('todo::layouts.nav-layout')

@section('username')
    welcome @{{ userName }}
    <a class="menu-title" @click="logout">Logout</a></span>
@endsection()

@section('content')
    <div class="modal-content mw-650px">
        <form class="form fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="modal-header" id="kt_modal_add_customer_header">
                <h2 class="fw-bolder">Edit Task</h2>
            </div>
            <div class="modal-body py-10 px-lg-17">
                <div class="scroll-y me-n7 pe-7" style="max-height: 446px;">

                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label class="required fs-6 fw-bold mb-2">Title</label>
                        <input type="text" class="form-control form-control-solid" v-model="task.title">
                    </div>

                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label class="fs-6 fw-bold mb-2">
                            <span class="required">Description</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" v-model="task.description">
                    </div>

                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <label class="fs-6 fw-bold mb-2">
                            <span>Labels</span>
                        </label>

                        <div class="form-control">
                            <el-select
                                v-model="selectedLabels"
                                multiple
                                placeholder="Select"
                                style="width: 240px"
                            >
                                <el-option
                                    v-for="item in labels"
                                    :key="item.id"
                                    :label="item.label"
                                    :value="item.id"
                                />
                            </el-select>
                        </div>

                    </div>

                    <div class="fv-row mb-7">
                        <div class="d-flex flex-stack">
                            <div class="me-5">
                                <label class="fs-6 fw-bold">status</label>
                            </div>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input"
                                       type="checkbox"
                                       v-model="task.status">
                                <span class="form-check-label fw-bold text-muted" for="kt_modal_add_customer_billing">open</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-center">
                <div @click="editTask" class="btn btn-primary">
                    <span v-if="isUpdating" class="indicator-progress">
                        Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                    <span v-else class="indicator-label">Save</span>
                </div>
            </div>
        </form>
    </div>
    <script>
        const id = {!! $id !!};

        const app = Vue.createApp({
            data() {
                return {
                    isUpdating: false,
                    userName: '',
                    selectedLabels: [],
                    task: {
                        id: '',
                        title: '',
                        description: '',
                        status: false,
                        labels: []
                    },
                    labels: []
                }
            },
            methods: {
                getLabesl() {

                    axios.get('/get-labels')
                        .then(response => {
                            this.labels = response.data;
                        })
                },
                getTask() {
                    axios.get(`/api/tasks/${id}`)
                        .then(response => {
                            this.task = response.data;
                            this.selectedLabels = response.data.labels.map(label => label.id)
                        })
                },
                logout() {
                    localStorage.clear();
                    window.location.href = '/logout';
                },
                editTask() {
                    this.isUpdating = true;

                    delete this.task.labels;

                    const data = {
                        task: this.task,
                        labels: this.selectedLabels
                    }

                    axios.put(`/api/tasks/${this.task.id}`, data)
                        .then(response => {
                            this.isUpdating = false;
                            parseResponse(response)
                        })
                        .catch(error => {
                            handleErrorValidation(error);
                            apiCheck(error);
                            this.isUpdating = false;
                        })
                }
            },
            created() {
                this.userName = localStorage.getItem('userName');
                this.getLabesl();
                this.getTask();
            }
        });
        app.use(ElementPlus);
        app.mount('#app');
    </script>


@endsection
