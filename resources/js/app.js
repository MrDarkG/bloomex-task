/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css'
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

app.use(LoadingPlugin);
import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import IssuesComponent from './components/Issues.vue';
app.component('issues-component', IssuesComponent);

import CreateIssueComponent from './components/Managment/CreateIssue.vue';
app.component('create-issue-component', CreateIssueComponent);

import ListIssueComponent from './components/Managment/ListIssue.vue';
app.component('list-issue', ListIssueComponent);
app.mount('#app');
