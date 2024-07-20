<template>
    <div>
        <div class="container">
            <div class="d-flex justify-content-end">
                <a href="/cp/create" class="btn btn-success"> Create </a>
            </div>
            <div class="card p-4 mt-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="searchById">Search By Id</label>
                        <input type="text" v-model="searchQuery.id" id="searchById" class="form-control mt-2"
                               placeholder="Search By Id">
                    </div>
                    <div class="col-md-3">
                        <label for="searchByStatusId">Search By Status</label>
                        <select v-model="searchQuery.status_id" id="searchByStatusId" class="form-control mt-2">
                            <option value="">Select</option>
                            <option v-for="status in statuses" :value="status?.id">
                                {{ status?.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="searchByProjectId">Search By project</label>
                        <select v-model="searchQuery.project_id" id="searchByProjectId" class="form-control mt-2">
                            <option value="">Select</option>
                            <option v-for="project in projects" :value="project?.id">
                                {{ project?.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="orderBy">Order By</label>
                        <select v-model="searchQuery.order_by" id="orderBy" class="form-control mt-2">
                            <option value="">Select</option>
                            <option value="id:asc">Id Ascending</option>
                            <option value="id:desc">Id Descending</option>
                            <option value="status_id:asc">Status Ascending</option>
                            <option value="status_id:desc">Status Descending</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="pagination">Per Page</label>
                        <select v-model="searchQuery.per_page" id="pagination" class="form-control mt-2">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">

                    <div class="card my-4" v-for="issue in issues.data">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="font-weight-bold">Subject:</span> {{ issue.subject }} - {{ issue.id }}

                                </div>
                                <div>
                                    <span class="font-weight-bold">Status:</span> {{ issue.status }}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div>
                                <span class="font-weight-bold">Project:</span> {{ issue.project }}
                            </div>
                            <div>
                                <span class="font-weight-bold">Priority:</span> {{ issue.priority }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <div class="mx-4">
                                    <a class="btn btn-primary" :href="`/cp/edit/${issue.id}`">Edit</a>
                                </div>
                                <div>
                                    <button class="btn btn-danger" @click="deleteIssue(issue.id)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pagination mt-4" v-if="issues.next_page_url">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item" :class="{'cursor-pointer':true, 'disabled': !issues.prev_page_url }">
                                <a class="page-link" @click="searchQuery.page -= 1">Previous</a>
                            </li>
                            <li class="page-item" :class="{'cursor-pointer':true, 'disabled': !issues.next_page_url }">
                                <a class="page-link" @click="searchQuery.page += 1">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isLoading: true,
                fullPage: true,
                issues: [],
                statuses: [],
                projects: [],
                priorities: [],
                searchQuery: {
                    id: null,
                    status_id: null,
                    project_id: null,
                    order_by: null,
                    page: 1,
                    per_page: 5
                }
            }
        },
        watch: {
            searchQuery: {
                handler: function () {
                    this.searchData();
                },
                deep: true
            }
        },
        methods: {
            async getData(url) {
                let data = [];
                await axios.get(`/${url}`)
                    .then(response => {
                        data = response.data.data;
                    });
                return data;
            },
            async searchData() {
                apiCall.showLoader();
                this.issues = await apiCall.searchData(this.searchQuery);
                apiCall.hideLoader();
            },
            async deleteIssue(id) {
                apiCall.showLoader();
                await axios.delete(`issues/${id}`);
                this.issues = await apiCall.getData('issues?per_page=5');
                apiCall.hideLoader();
            }
        },
        async mounted() {
            apiCall.showLoader();
            this.issues = await apiCall.getData('issues?per_page=5');
            this.statuses = await apiCall.getData('statuses');
            this.projects = await apiCall.getData('projects');
            this.priorities = await apiCall.getData('priorities');
            apiCall.hideLoader();
        }
    }
</script>
