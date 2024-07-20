<template>
    <div>
        <div class="container">
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
            </div>
            <div class="row flex-nowrap justify-content-between  overflow-auto">
                <div class="col-md-3 col-4 col-lg-3 mt-4 min-w-250" v-for="(list,index) in lists">
                    <div class="card p-1 w-100" >
                        {{ index }}
                        <div>
                            <VueDraggable
                                class="flex flex-col gap-2 p-4 w-300px h-300px m-auto bg-gray-500/5 rounded overflow-auto"
                                v-model="lists[index]"
                                animation="150"
                                ghostClass="ghost"
                                group="people"
                                @update="onUpdate"
                                @add="onAdd($event, index)"
                                @remove="remove"
                            >
                                <div
                                    v-for="item in lists[index]"
                                    :key="item.id"
                                    class="cursor-move h-30 bg-gray-500/5 rounded p-0 p-md-3 card cursor-pointer my-2"
                                >
                                    <div class="d-flex flex-wrap justify-content-between">
                                        {{ item.subject }}
                                        <span :class="`badge rounded-pill bg-${item.priority.toLowerCase()}`">{{ item.priority }}</span>
                                    </div>
                                </div>
                            </VueDraggable>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>
<script>

import {VueDraggable} from 'vue-draggable-plus'

export default {
    components: {
        VueDraggable
    },
    data() {
        return {
            enabled: true,
            lists: {},
            dragging: false,
            isLoading: true,
            fullPage: true,
            issues: [],
            statuses: [],
            projects: [],
            searchQuery: {
                id: null,
                status_id: null,
                project_id: null,
                order_by: null
            }
        }
    },
    watch: {
        searchQuery: {
            handler: 'searchData',
            deep: true
        }
    },
    methods: {
        onUpdate(event) {
            console.log(event)
        },
        onAdd(event, index) {
            let statusId = this.statuses.find(status => status.name === index).id;
            this.updateIssue(event.data, statusId)
        },
        remove() {
            console.log('remove')
        },
        updateIssue(issue, status_id) {
            axios.put('issues', {
                id: issue.id,
                status_id: status_id,
                subject: issue.subject,
            })
                .then(response => {
                    console.log(response)
                })
        },
        async searchData() {
            apiCall.showLoader();
            this.issues = await apiCall.searchData(this.searchQuery);
            await this.listData();
            apiCall.hideLoader();
        },
        async listData() {
            let issue = this.issues.data;
            for (let i = 0; i < issue.length; i++) {
                if (!this.lists.hasOwnProperty(issue[i].status)) {
                    this.lists[issue[i].status] = [];
                }
                this.lists[issue[i].status].push(issue[i]);
            }
        },
        async listStatuses() {
            let status = this.statuses;
            for (let i = 0; i < status.length; i++) {
                this.lists[status[i].name] = [];
            }
        }
    },
    async mounted() {
        apiCall.showLoader();
        this.statuses = await apiCall.getData('statuses');
        await this.listStatuses();
        this.issues = await apiCall.getData('issues');
        await this.listData();
        this.projects = await apiCall.getData('projects');
        this.isLoading = false;
        apiCall.hideLoader();
    }
}
</script>
