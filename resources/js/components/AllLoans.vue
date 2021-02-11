<template>
    <div>
        <h3 class="text-center">All Loans</h3>
        <p v-if="message">{{ message }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Bank</th>
                    <th>Amount</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="loan in loans" :key="loan.id">
                    <td>{{ loan.name }}</td>
                    <td>{{ loan.bank }}</td>
                    <td>{{ loan.amount }}</td>
                    <td>{{ loan.created_at | formatDate }}</td>
                    <td>{{ loan.updated_at | formatDate }}</td>
                    <td>
                        <span v-if="loan.status === null ">Pending</span>
                        <span v-if="loan.status === 0 ">Decline</span>
                        <span v-if="loan.status === 1 ">Approve</span>
                    </td>
                    <td>
                        <div class="btn-group" role="group" v-if="loan.status === null ">
                            <router-link :to="{name: 'edit', params: { id: loan.id }}" class="btn btn-primary">Edit
                            </router-link>
                            <button class="btn btn-danger" @click="deleteLoan(loan.id)">Delete</button>
                            <button class="btn btn-success" @click="statusApprove(loan.id)">Approve</button>
                            <button class="btn btn-dark" @click="statusDecline(loan.id)">Decline</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Vue from 'vue'

/*import * as moment from "moment";*/
window.moment = require('moment')
import moment from 'moment'
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY, hh:mm a')
  }
});

    export default {
        data() {
            return {
                loans: [],
                message: null
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/loans')
                .then(response => {
                    this.loans = response.data;
/*                    console.log(this.loans[0].status === null);*/
                });
        },
        methods: {
            deleteLoan(id) {
                this.axios
                    .delete(`http://localhost:8000/api/loan/delete/${id}`)
                    .then(response => {
                        let i = this.loans.map(item => item.id).indexOf(id); // find index of your object
                        this.loans.splice(i, 1)
                    });
                    this.message = 'The Loan request is deleted successfully.';
            },
            statusApprove(id) {
                this.axios.get(`api/loan/approve/${id}`);
                let i = this.loans.map(item => item.id).indexOf(id); // find index of your object
                this.loans[i].status = 1;
                this.message = 'The Loan request is approved successfully.';
            },
            statusDecline(id) {
                this.axios.get(`api/loan/decline/${id}`);
                let i = this.loans.map(item => item.id).indexOf(id); // find index of your object
                this.loans[i].status = 0;
                this.message = 'The Loan request is declined successfully.';
            }
        }
    }
</script>