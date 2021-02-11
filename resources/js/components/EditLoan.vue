<template>
    <div>
        <h3 class="text-center">Edit Loan</h3>
        <p v-if="success" class="success">{{ success }}</p>
        <div v-if="errors.length" class="danger">
            <p>The following fields are required to submit the loan request.</p>
            <ul>
                <li v-for="error in errors" > {{ error }}</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                <form @submit.prevent="updateLoan">
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
                    <button type="submit" class="btn btn-primary">Update Loan</button>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
    .danger {
        color: #842029;
        background-color: #f8d7da;
        padding-left: 5px;
    }
    .success {
        color: #0f5132;
        background-color: #d1e7dd;
        padding-left: 5px;
    }
</style>

<script>
    export default {
        data() {
            return {
                loan: {},
                errors: [],
                success: ''
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/loan/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.loan = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updateLoan() {
                if (this.loan.name != '' && this.loan.bank != '' && this.loan.amount != '') {
                    this.axios.put(`http://localhost:8000/api/loan/update/${this.$route.params.id}`, this.loan)
                    this.loading = false;
                    this.success = 'Loan request edit successfully.';
                    this.errors = [];
                }
                else {
                    // Empty the erros array if there is any message that already exist.
                    this.errors = []; 
                    // Check if loan items (name, bank, amount) is empty.
                    if (this.loan.name ===  '') {
                        this.errors.push('Name is required.');
                    }
                    if (this.loan.bank ===  '') {
                        this.errors.push('Bank is required.');
                    }
                    if (this.loan.amount ===  '') {
                        this.errors.push('Amount is required.');
                    }
                }

            }
        }
    }
</script>