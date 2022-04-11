@extends('todo::layouts.nav-layout')

@section('username')
    welcome @{{ userName }}
    <a class="menu-title" @click="logout">Logout</a></span>
@endsection()

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid justify-content-center" id="kt_post">
            <div >
                <div id="kt_content_container" class="container-xxl">
                    <div class="card mb-5 mb-xl-6">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Labels</span>
                                <span class="text-muted mt-1 fw-bold fs-7">@{{labels.length}} labesl</span>
                            </h3>
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                                 data-bs-trigger="hover" title="" data-bs-original-title="Click to add a user">
                                <a href="/labels/create" class="btn btn-sm btn-light btn-active-primary">
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
                                    <!--end::Svg Icon-->New Label</a>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="min-w-80px">Id</th>
                                        <th class="min-w-200px">Name</th>
                                        <th class="min-w-300px text-end">Tasks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="label in labels" :key="label.id">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a class="text-dark fw-bolder text-hover-primary fs-6">
                                                        @{{label.id}}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a class="text-dark fw-bolder text-hover-primary fs-6">
                                                        @{{label.label}}
                                                    </a>
                                                    <span
                                                        class="text-muted fw-bold text-muted d-block">@{{label.tasks.length}} Tasks</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge badge-light-primary" v-for="task in label.tasks"
                                                  :key="task.id">@{{task.title}}</span>
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
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    userName: '',
                    labels: []
                }
            },
            methods: {
                logout() {
                    localStorage.clear();
                    window.location.href = '/logout';
                },
                getLabels() {
                    axios.get('/api/labels')
                        .then(response => {
                            console.log(response);
                            this.labels = response.data.data;
                        })
                        .catch(error => {
                            apiCheck(error);
                        })
                }
            },
            created() {
                this.getLabels();
                this.userName = localStorage.getItem('userName');
            }
        });
        app.use(ElementPlus);
        app.mount('#app');
    </script>


@endsection
