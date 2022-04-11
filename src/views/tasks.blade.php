@extends('todo::layouts.nav-layout')

@section('username')
    welcome @{{ userName }}
    <a class="menu-title" @click="logout">Logout</a></span>
@endsection()

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Tasks</span>
                            <span class="text-muted mt-1 fw-bold fs-7">@{{tasks.length }} tasks</span>
                        </h3>
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                             data-bs-trigger="hover" title="" data-bs-original-title="Click to add a user">
                            <a href="/tasks/create" class="btn btn-sm btn-light btn-active-primary">
                                <span class="svg-icon svg-icon-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                          rx="1" transform="rotate(-90 11.364 20.364)"
                                                          fill="currentColor"></rect>
													<rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                          fill="currentColor"></rect>
												</svg>
											</span>
                                <!--end::Svg Icon-->New Task</a>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-80px">id</th>
                                    <th class="min-w-100px">Title</th>
                                    <th class="min-w-250px">Description</th>
                                    <th class="min-w-250px">Labels</th>
                                    <th class="min-w-50px">Status</th>
                                    <th class="min-w-100px text-end">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="task in tasks" :key="task.id">
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            @{{ task.id }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="d-flex justify-content-start flex-column">
                                                <a class="text-dark fw-bolder text-hover-primary fs-6">
                                                    @{{ task.title }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block fs-7">
                                            @{{ task.description }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-primary" v-for="label in task.labels"
                                              :key="label.id">@{{label.label}}</span>

                                    </td>
                                    <td>
                                        <span v-if="isUpdating && selectedTaskId === task.id"
                                              class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                        <label v-else class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   v-model="task.status"
                                                   @change="statusChanged(task)"
                                            >
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-shrink-0">

                                            <a :href="`/tasks/${task.id}/edit`"
                                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="24" height="24" viewBox="0 0 24 24"
                                                         fill="none">
                                                        <path opacity="0.3"
                                                              d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                              fill="currentColor"></path>
                                                        <path
                                                            d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                            fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    selectedTaskId: '',
                    isUpdating: false,
                    currentTaskId: '',
                    userName: '',
                    tasks: [],
                }
            },
            methods: {
                logout() {
                    localStorage.clear();
                    window.location.href = '/logout';
                },

                statusChanged(task) {
                    this.selectedTaskId = task.id;
                    this.isUpdating = true;
                    axios.post('/api/tasks/change-status', {id: task.id, status: task.status})
                        .then(response => {
                            this.isUpdating = false;
                            parseResponse(response)
                        }).catch(error => {
                        this.isUpdating = false;
                        apiCheck(error);
                    })
                },

                getTasks() {
                    axios.get('/api/tasks')
                        .then(response => {
                            this.tasks = response.data.data;
                        })
                        .catch(error => {
                            apiCheck(error);
                        })

                }
            },
            created() {
                this.getTasks();
                this.userName = localStorage.getItem('userName');
            }
        });
        app.use(ElementPlus);
        app.mount('#app');
    </script>


@endsection
