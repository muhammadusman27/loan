<template>
    <div>
        <h3 class="text-center">Edit Loan</h3>
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

<script>
    export default {
        data() {
            return {
                loan: {}
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
                this.axios
                    .put(`http://localhost:8000/api/loan/update/${this.$route.params.id}`, this.loan)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>