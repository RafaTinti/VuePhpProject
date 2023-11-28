
<template>
  <div class="mt-5 container">
    <div class="card mx-auto">
      <div class="card-header py-3 d-flex align-center justify-content-between">
        <h4>
          Customers
        </h4>
        <RouterLink class="btn btn-primary" to="/customers/create">Add Customer</RouterLink>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-responsive table-hover">
          <thead class="bg-light">
            <tr>
              <th class="fw-bold">ID</th>
              <th class="fw-bold">First Name</th>
              <th class="fw-bold">Last Name</th>
              <th class="fw-bold">Date of Birth</th>
              <th class="fw-bold">Username</th>
              <th class="fw-bold">Password</th>
              <th class="fw-bold text-center">Actions</th>
            </tr>
          </thead>
          <tbody v-if="this.customers.length > 0">
            <tr v-for="(customer, index) in this.customers" :key="index">
              <td>{{ customer.ID }}</td>
              <td>{{ customer.FirstName }}</td>
              <td>{{ customer.LastName }}</td>
              <td>{{ formatDate(customer.DateOfBirth) }}</td>
              <td>{{ customer.Username }}</td>
              <td>{{ customer.Password }}</td>
              <td class="d-flex justify-content-evenly">
                <RouterLink :to="{ path: `/customers/${customer.ID}/edit` }" class="btn btn-sm btn-primary">Edit</RouterLink>
                <button type="button" @click="deleteCustomer(customer.ID)" class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="7">Loading...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
  
<script>
import axios from "axios";
import { curPage } from '../../main.js';
import Swal from "sweetalert2";
export default {
  name: "customers",
  data() {
    return {
      customers: [],
    }
  },

  mounted() {
    curPage.setPage("Customers");
    this.getCustomers();
  },

  methods: {
    getCustomers() {
      axios.get("http://localhost/vuephpproject/backend/api/customer/readAll.php").then(res => {
        this.customers = res.data.data;
        console.log(this.customers);
      }).catch(err =>{
        console.log(err);
      })
    },
    deleteCustomer(id) {
      Swal.fire({
        icon: "warning",
        title: "Are you sure you want to delete this item?",
        showCancelButton: true,
        cancelButtonColor: '#dd6b55',
        showConfirmButton: true,
      }).then(res => {
        if (res.isConfirmed){
          console.log(id);
          axios({method: "DELETE",
                url: "http://localhost/vuephpproject/backend/api/customer/delete.php",
                data: {ID: id}}).then(res => {
            Swal.fire({
              title: 'Success',
              icon: "success",
              text: res.data.message,
            })
            this.getCustomers();
          }).catch(err =>{
            console.log(err);
            Swal.fire({
              title: 'Error',
              icon: "error",
              text: err.response.data.message,
            })
            this.getCustomers();
          })
        }
      })
    },
    formatDate(d){
      const parts = d.split("-");
      return `${parts[2]}/${parts[1]}/${parts[0]}`;

    }
  }
}
</script>

<style scoped>
.card {
  max-width: 998px;
}
</style>