<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ id ? 'Update' : 'Create'}} Issue
            </div>
            <div class="card-body">
                <form @submit.prevent="doAction">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" v-model="issue.subject" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select v-model="issue.status_id" id="status" class="form-control">
                            <option value="">Select</option>
                            <option v-for="status in statuses" :value="status?.id">
                                {{ status?.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project">Project</label>
                        <select v-model="issue.project_id" id="project" class="form-control">
                            <option value="">Select</option>
                            <option v-for="project in projects" :value="project?.id">
                                {{ project?.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select v-model="issue.priority_id" id="priority" class="form-control">
                            <option value="">Select</option>
                            <option v-for="priority in priorities" :value="priority?.id">
                                {{ priority?.name }}
                            </option>
                        </select>
                    </div>

                    <button class="btn btn-primary mt-2">
                        {{ id ? 'Update' : 'Create'}}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        id: {
            type: Number,
            required: false
        }
    },
    data() {
        return {
            issue: {
                subject: '',
                status_id: '',
                project_id: '',
                priority_id: '',
            },
            statuses: [],
            projects: [],
            priorities: [],
        }
    },
    methods: {
        async createIssue() {
            axios.post('/issues', this.issue)
                .then(response => {
                    window.location.href = '/cp';
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
        doAction(){
            if (this.id) {
                this.updateIssue();
            } else {
                this.createIssue();
            }
        },
        updateIssue() {
            axios.put('/issues/', this.issue)
                .then(response => {
                    window.location.href = '/cp';
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
        getIssueData()
        {
            axios.get('/issues/' + this.id)
                .then(response => {
                    this.issue = response.data.data;
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        }
    },
    async mounted() {
        apiCall.showLoader();
        if (this.id) {
            this.getIssueData();
        }
        this.statuses = await apiCall.getData('statuses');
        this.projects = await apiCall.getData('projects');
        this.priorities = await apiCall.getData('priorities');
        apiCall.hideLoader();
    }
}
</script>
