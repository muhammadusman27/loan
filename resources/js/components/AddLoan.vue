<template>
    <div>
        <h3 class="text-center">Loan Request Form</h3>
        <div class="row">
            <div class="col-12">
                <form @submit.prevent="addLoan">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="loan.name">
                    </div>
                    <div class="form-group">
                        <label>Bank</label>
                        <input type="text" class="form-control" v-model="loan.bank">
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control" v-model="loan.amount">
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary">Submit Loan Request</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loan: {}
            }
        },
        methods: {
            addLoan() {
                this.axios
                    .post('http://localhost:8000/api/loan/store', this.loan)
                    .then(response => (
                        this.$router.push({name: 'home'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>