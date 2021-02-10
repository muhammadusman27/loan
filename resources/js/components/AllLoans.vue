<template>
    <div>
        <h3 class="text-center">All Loans</h3><br/>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Bank</th>
                    <th>Amount</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="loan in loans" :key="loan.id">
                    <td>{{ loan.id }}</td>
                    <td>{{ loan.name }}</td>
                    <td>{{ loan.bank }}</td>
                    <td>{{ loan.amount }}</td>
                    <td>{{ loan.created_at | formatDate }}</td>
                    <td>{{ loan.updated_at | formatDate }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'edit', params: { id: loan.id }}" class="btn btn-primary">Edit
                            </router-link>
                            <button class="btn btn-danger" @click="deleteLoan(loan.id)">Delete</button>
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
                loans: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/loans')
                .then(response => {
                    this.loans = response.data;
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
            }
        }
    }
</script>